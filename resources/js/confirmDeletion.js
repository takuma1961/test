document.addEventListener('DOMContentLoaded', function () {
    // 全ての削除ボタンにイベントリスナーを追加
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            const productName = this.dataset.productName;
            const confirmation = confirm(`Are you sure you want to delete ${productName}?`);
            if (!confirmation) {
                event.preventDefault();
            }
        });
    });

    // 注文履歴削除ボタンにイベントリスナーを追加
    const history_deleteButtons = document.querySelectorAll('.delete-to-history-button');
    history_deleteButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            const confirmation = confirm(`Are you sure you want to delete it?`);
            if (!confirmation) {
                event.preventDefault();
            }
        });
    });

    const addToCartButtons = document.querySelectorAll('.add-to-cart-button');
    addToCartButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // フォームのデフォルト送信を防ぐ

            const $button = button; // クリックされたボタンを取得

            $button.classList.add('animate-cart'); // アニメーションを追加

            // アニメーションが終わった後にクラスを削除
            setTimeout(function () {
                $button.classList.remove('animate-cart');
            }, 500); // 500ms後にアニメーションをリセット

            // フォームを送信してカートに商品を追加
            const form = button.closest('form');
            if (form) {
                form.submit(); // フォームが見つかった場合のみ送信
            } else {
                console.error('Form not found for button:', $button);
            }
        });
    });
});
