/**
 * Page Transitions - HARDCODED
 */
(function($) {
    'use strict';

    // Click handler for page transitions
    $(document).on('click', '.menu-item a, .elementor-widget-image > a, .soda-post-nav-next a, .soda-post-nav-prev a', function(e) {
        // Get target URL
        var goTo = this.getAttribute('href');
        
        // Validate URL before proceeding
        if (!goTo || goTo === '' || goTo === 'null') {
            return; // Let default behavior handle it
        }
        
        // Skip anchors
        if (goTo.startsWith('#')) {
            return;
        }
        
        // Skip javascript: links
        if (goTo.startsWith('javascript:')) {
            return;
        }
        
        // Check if it's an external link (has http/https and different domain)
        if (goTo.match(/^https?:\/\//)) {
            var currentDomain = window.location.hostname;
            var linkDomain = goTo.split('/')[2];
            if (linkDomain !== currentDomain) {
                return; // External link, skip transition
            }
        }
        
        e.preventDefault();
        e.stopPropagation();

        // Trigger transition animation
        $('body').addClass('close');
        $('.transition-pannel-bg').addClass('close');
        $('.transition-borders-bg').addClass('close');

        // Navigate after animation completes
        setTimeout(function() {
            window.location.href = goTo;
        }, 1100);
    });

    // Remove transition classes on page load
    $(document).ready(function() {
        // Remove enter class after brief delay
        setTimeout(function() {
            $('.transition-pannel-bg').removeClass('enter');
            $('.transition-borders-bg').removeClass('enter');
        }, 50);
    });
    
    // Also handle pageshow event (for back/forward navigation)
    $(window).on('pageshow', function(event) {
        if (event.originalEvent.persisted) {
            // Page was loaded from cache (back button)
            $('.transition-pannel-bg').removeClass('enter close');
            $('.transition-borders-bg').removeClass('enter close');
            $('body').removeClass('close');
        }
    });

})(jQuery);
