let currentSlide = 0; // 現在のスライドインデックス
const slides = document.querySelectorAll(".slide"); // 全てのスライドを取得
const totalSlides = slides.length; // スライド数を取得

// スライドを切り替える関数
function showNextSlide() {
    slides[currentSlide].style.display = "none"; // 現在のスライドを隠す
    currentSlide = (currentSlide + 1) % totalSlides; // 次のスライドに移動（ループ）
    slides[currentSlide].style.display = "block"; // 次のスライドを表示
}

// 初期化: 最初のスライド以外を非表示
slides.forEach((slide, index) => {
    slide.style.display = index === 0 ? "block" : "none";
});

// 一定時間ごとにスライドを切り替え
setInterval(showNextSlide, 3000); // 3秒ごとに切り替え
