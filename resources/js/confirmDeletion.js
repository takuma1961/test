document.addEventListener('DOMContentLoaded', function () {
    //全ての削除ボタンにイベントリスナーを追加
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            const productName = this.dataset.productName;
            const confirmation = confirm(`Are you sure you want to delete ${productName}?`);
            if (!confirmation) {
                event.preventDefault();
            }
        })
    })
})