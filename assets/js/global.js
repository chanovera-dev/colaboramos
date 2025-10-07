if (/^((?!chrome|android).)*safari/i.test(navigator.userAgent)) {
  document.body.classList.add('is-safari');
}

const body = document.body;

// IIFE para encapsular la funcionalidad y evitar variables globales
(() => {
  let lastScroll = 0;
  let ticking = false;
  
  // Usar RAF para optimizar performance
  window.addEventListener('scroll', () => {
    if (!ticking) {
      requestAnimationFrame(() => {
        const currentScroll = window.scrollY; // más eficiente que pageYOffset
        
        // closeMenuMobile();

        if (currentScroll <= 0) {
          body.classList.remove('scroll-up', 'scroll-down');
        } else {
          const scrollingDown = currentScroll > lastScroll;
          // Actualizar clases solo si cambia la dirección
          if (scrollingDown !== body.classList.contains('scroll-down')) {
            body.classList.toggle('scroll-down', scrollingDown);
            body.classList.toggle('scroll-up', !scrollingDown);
          }
        }

        lastScroll = currentScroll;
        ticking = false;
      });
      
      ticking = true;
    }
  }, { passive: true }); // Optimización para eventos táctiles
})();