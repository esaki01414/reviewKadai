const products = [
    {
        "name": "商品1",
        "image": "./images/画像1.jpg"
    },
    {
        "name": "商品2",
        "image": "./images/画像2.jpg"
    },
    {
        "name": "商品3",
        "image": "./images/画像3.jpg"
    }
];

const productListContainer = document.getElementById('product-list-container');

function displayProducts() {
    products.forEach(product => {
        const productItem = document.createElement('div');
        productItem.classList.add('product-item');

        const productImage = document.createElement('img');
        productImage.src = product.image;
        productImage.alt = product.name; // アクセシビリティ向上のためにalt属性は残しておく

        // 商品名は追加しない
        // productItem.appendChild(document.createTextNode(product.name)); // この行を削除

        productItem.appendChild(productImage);
        productListContainer.appendChild(productItem);
    });
}

// ページがロードされたときに商品を表示
window.onload = loadProducts;
window.onload = displayProducts;
function toggleMenu() {
    const navMenu = document.getElementById('nav-menu');
    navMenu.classList.toggle('hidden'); // hiddenクラスをトグル
}
function searchProducts() {
    // 検索ボックスのテキストを取得
    const searchText = document.getElementById("search-input").value;
    if (searchText) {
        alert("検索内容: " + searchText);
        // ここに実際の検索機能や処理を追加できます
    } else {
        alert("検索内容を入力してください。");
    }
}