"use strict";
// 商品データを取得して表示する関数
function loadProducts() {
    fetch('products.json')
        .then(response => response.json())
        .then(products => {
            const productList = document.querySelector('.product-list');
            products.forEach(product => {
                const productCard = document.createElement('div');
                productCard.className = 'product-card';
                productCard.innerHTML = `
                    <img src="${product.image}" alt="${product.name}" />
                    <h2>${product.name}</h2>
                    <p>価格: ${product.price}円</p>
                    <p>${product.description}</p>
                    <button onclick="editProduct(${product.id})">編集</button>
                    <button onclick="deleteProduct(${product.id})">削除</button>
                `;
                productList.appendChild(productCard);
            });
        });
}

// 商品を編集する関数
function editProduct(id) {
    alert(`商品ID: ${id} の編集機能はまだ実装されていません。`);
}

// 商品を削除する関数
function deleteProduct(id) {
    alert(`商品ID: ${id} を削除する機能はまだ実装されていません。`);
}

// ページがロードされたときに商品を表示
window.onload = loadProducts;
