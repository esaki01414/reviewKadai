// 商品データを取得して表示する関数
function loadProducts() {
    fetch('data/products.json')
        .then(response => response.json())
        .then(products => {
            const productList = document.getElementById('product-list');
            products.forEach(product => {
                const productCard = document.createElement('div');
                productCard.className = 'product-card';
                productCard.innerHTML = `
                    <img src="images/${product.image}" alt="${product.name}" />
                    <h2>${product.name}</h2>
                    <p>${product.price}円</p>
                    <button>カートに追加</button>
                `;
                productList.appendChild(productCard);
            });
        });
}

// ページがロードされたときに商品を表示
window.onload = loadProducts;
