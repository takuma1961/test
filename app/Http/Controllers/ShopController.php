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
        //セッションidに対応するcartがなければからの配列を返す
        $cart = session()->get('cart'[]);
        //HTTPリクエストから product_id の値を取得し、変数 $productId に格納
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $product = Product::find($productId);
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->route('shop.index');
    }
    public function viewCart()
    {
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

    //商品追加画面に遷移するためのメソッド
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
}
