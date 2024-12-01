document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');
    const slideshow = document.querySelector('.slideshow');

    const adjustSlideshowPosition = () => {
        const headerHeight = header.offsetHeight; // ヘッダーの高さを取得
        slideshow.style.marginTop = `${headerHeight}px`; // スライドショーを調整
    };

    adjustSlideshowPosition(); // 初期調整
    window.addEventListener('resize', adjustSlideshowPosition); // ウィンドウサイズ変更時にも再調整
});
