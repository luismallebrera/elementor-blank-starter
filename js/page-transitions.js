/**
 * Page Transitions
 * Smooth transitions between page navigation
 */
(function($) {
    'use strict';

    // Get settings from PHP
    var settings = window.elementorBlankPageTransitions || {};
    
    if (!settings.enabled) {
        return; // Exit if transitions are disabled
    }

    // Click handler for page transitions
    $(document).on('click', settings.selectors, function(e) {
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
        }, parseInt(settings.duration));
    });

    // Remove transition classes on page load
    $(document).ready(function() {
        // Remove enter class after brief delay
        setTimeout(function() {
            $('.transition-pannel-bg').removeClass('enter');
            $('.transition-borders-bg').removeClass('enter');
        }, 100);
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
