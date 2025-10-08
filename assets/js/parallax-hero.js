function initHeroParallax() {
    const parallaxImage = document.querySelector(".background-hero");

    if (!parallaxImage) return;

    window.addEventListener("scroll", function () {
        let scrollY = window.scrollY;
        let speed = parseFloat(parallaxImage.dataset.speed) || 0.5;

        parallaxImage.style.transform = `translateY(${scrollY * speed}px)`;
    });
}
document.addEventListener("DOMContentLoaded", initHeroParallax);