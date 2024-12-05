function showLoginModal() {
    const modal = document.getElementById('login-modal');
    modal.classList.remove('hidden'); // モーダルを表示
}

function closeLoginModal() {
    const modal = document.getElementById('login-modal');
    modal.classList.add('hidden'); // モーダルを非表示
}
