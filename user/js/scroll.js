document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');
    let lastScrollY = window.scrollY;

    window.addEventListener('scroll', () => {
        if (window.scrollY > lastScrollY) {
            // 下にスクロールした場合
            header.classList.add('hidden');
        } else {
            // 上にスクロールした場合
            header.classList.remove('hidden');
        }
        lastScrollY = window.scrollY; // 現在のスクロール位置を更新
    });
});
