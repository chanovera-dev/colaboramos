// Add safari class (feature-detection preferred, but keep UA check if required)
if (/^((?!chrome|android).)*safari/i.test(navigator.userAgent)) {
  document.documentElement.classList.add('is-safari');
}

(() => {
    let lastScroll = 0;
    let ticking = false;
    const body = document.body || document.documentElement;

    // Named handler so we can remove it later
    const onScroll = () => {
        if (ticking) return;

        ticking = true;
        requestAnimationFrame(() => {
            const currentScroll = window.scrollY || window.pageYOffset || 0;

            if (currentScroll <= 0) {
            body.classList.remove('scroll-up', 'scroll-down');
            } else {
            const scrollingDown = currentScroll > lastScroll;
            // Only change classes when direction actually changes
            if (scrollingDown !== body.classList.contains('scroll-down')) {
                body.classList.toggle('scroll-down', scrollingDown);
                body.classList.toggle('scroll-up', !scrollingDown);
            }
            }

            lastScroll = currentScroll;
            ticking = false;
        });
    };

    // Add the listener with passive option
    window.addEventListener('scroll', onScroll, { passive: true });

    // Cleanup on unload (helps with SPA or HMR during development)
    const cleanup = () => {
        window.removeEventListener('scroll', onScroll, { passive: true });
        window.removeEventListener('beforeunload', cleanup);
    };
    window.addEventListener('beforeunload', cleanup);

    // Optional: expose cleanup globally for frameworks to call
    window.__colaboramos_scroll_cleanup = cleanup;
})();

function closeMenuMobile() {
    const button = document.querySelector('.menu-mobile__button');
    const menu = document.querySelector('.main-navigation');
    const body = document.body;

    if ( button ) {
        button.classList.remove('active');
    }
    if ( menu ) {
        menu.classList.remove('show');
        menu.classList.remove('open');
    }

    if ( body ) {
        body.style.overflow = '';
    }
}

function toggleMenuMobile() {
    if ( window.innerWidth > 1365 ) return;

    const body = document.body;
    const button = document.querySelector( '.menu-mobile__button' );
    const menu = document.querySelector( '.main-navigation' );
    const header = document.getElementById( 'main-header' ) || document.querySelector( 'header' );

    if ( ! button || ! menu ) return;

    // Toggle state
    const isOpen = menu.classList.toggle( 'show' );
    button.classList.toggle( 'active', isOpen );
    body.style.overflow = isOpen ? 'hidden' : '';

    // Click outside handler should call closeMenuMobile()
    const handleClickOutside = ( e ) => {
        const target = e.target;
        const clickedInsideMenu = menu.contains( target );
        const clickedInsideHeader = header && header.contains( target );
        const clickedToggleButton = button.contains( target );

        if ( ! clickedInsideMenu && ! clickedInsideHeader && ! clickedToggleButton ) {
            closeMenuMobile();
            document.removeEventListener( 'click', handleClickOutside );
        }
    };

    // Ensure we don't register multiple identical handlers
    document.removeEventListener( 'click', handleClickOutside );
    if ( isOpen ) {
        document.addEventListener( 'click', handleClickOutside );
    }
}

function menuWithChildren() {
    const menuItems = document.querySelectorAll('.menu-item-has-children');
  
    menuItems.forEach(item => {
        item.addEventListener('click', function (e) {

            if (e.target.tagName === 'A') {
                return;
            }

            e.preventDefault();

            item.classList.toggle('open');

            const subMenu = item.querySelector('.sub-menu');
            if (subMenu) {
                const childrenCount = subMenu.children.length;
                const transitionTime = childrenCount * 0.1; // Calculate transition time based on number of children
                subMenu.style.transition = `max-height ${transitionTime}s cubic-bezier(0.73, 0.32, 0.34, 1.5)`;
                subMenu.classList.toggle('open');
            }
        });
    });
}
document.addEventListener('DOMContentLoaded', menuWithChildren);