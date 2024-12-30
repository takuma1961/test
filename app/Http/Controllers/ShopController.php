<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('shop.index', compact('products'));
    }

    public function addToCart(Request $request)
    {
        // セッションIDに対応するカートがなければ空の配列を返す
        $cart = session()->get('cart', []);

        // HTTPリクエストから product_id の値を取得し、変数 $productId に格納
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // カート内に同じ商品が既に存在する場合、数量を増やす
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // 商品をデータベースから取得し、カートに追加
            $product = Product::find($productId);
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
            ];
        }

        // カートをセッションに保存
        session()->put('cart', $cart);

        // ショップインデックスページにリダイレクト
        return redirect()->route('shop.index');
    }

    public function viewCart()
    {
        // カートをセッションから取得し、ビューに渡す
        $cart = session()->get('cart', []);
        return view('shop.cart', compact('cart'));
    }


    public function placeOrder(Request $request)
    {
        $order = new Order();
        $order->customer_name = $request->input('customer_name');
        $order->customer_email = $request->input('customer_email');
        $order->payment_method = $request->input('payment_method');
        $order->total = array_sum(array_column(session()->get('cart', []), 'price'));
        $order->save();
        //$id（キー値） => $details（値）
        foreach (session()->get('cart', []) as $id => $details) {
            $order->products()->attach($id, ['quantity' => $details['quantity']]);
        }
        session()->forget('cart');
        return redirect()->route('shop.index')->with('success', 'Order placed successfully!');
    }

    //管理者画面へ移動
    public function administrator()
    {
        $products = product::all();
        return view('shop.administrator', compact('products'));
    }
    //管理者→商品登録画面
    public function create()
    {
        return view('shop.create');
    }


    //商品登録メソッド
    public function store(Request $request)
    {
        //バリデーションチェックメソッド
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);
        //DBに商品を登録
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        return redirect()->route('shop.index')->with('success', 'Product added successfully');
    }

    //登録している商品を削除
    public function delete($id)
    {
        //指定されたIDに基づいてデータベースからレコードを検索
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('shop.administrator')->with('success', 'Product deleted successfully');
    }

    public function checkout()
    {
        return view('shop.checkout');
    }

    public function removeFromCart(Request $request)
    {
        //バリデーションチェック
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        //カートセッションが空の場合、からの配列を入れる
        $cart = session()->get('cart', []);

        // HTTPリクエストから削除対象の商品IDを取得
        $productId = $request->input('product_id');
        $removeQuantity = $request->input('quantity', 1); // デフォルトで1個削除

        // カートに該当商品が存在すれば削除
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] -= $removeQuantity;

            // 個数が0以下になった場合はカートから削除
            if ($cart[$productId]['quantity'] <= 0) {
                unset($cart[$productId]);
            }
            //カートを更新
            session()->put('cart', $cart); //カートセッションを更新
        }
        return redirect()->route('shop.cart')->with('success', 'Product quantity updated successfully!');
    }

    //注文履歴画面に移動
    public function order_history()
    {
        $orders = Order::all();
        return view('shop.order_history', compact('orders'));
    }

    //注文履歴削除メソッド
    public function order_delete(Request $request , $id)
    {
        //指定されたIDに基づいてデータベースからレコードを検索
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('shop.order_history')->with('success', 'deleted successfully');
    }
}
