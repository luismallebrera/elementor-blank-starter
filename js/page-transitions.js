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
        if (!goTo || goTo === '' || goTo === '#' || goTo === 'javascript:void(0)' || goTo === 'javascript:;' || goTo.startsWith('#')) {
            return; // Let default behavior handle it
        }
        
        // Check if it's an external link
        var currentDomain = window.location.hostname;
        var linkElement = document.createElement('a');
        linkElement.href = goTo;
        
        // Only apply transition to internal links
        if (linkElement.hostname !== currentDomain && linkElement.hostname !== '') {
            return; // Let external links open normally
        }
        
        e.preventDefault();

        // Trigger transition animation
        $('body').removeClass('active').addClass('close');
        $('.transition-pannel-bg').addClass('active');

        // Navigate after animation completes
        setTimeout(function() {
            window.location = goTo;
        }, settings.duration);
    });

    // Remove transition classes on page load
    $(document).ready(function() {
        $('.transition-pannel-bg').removeClass('active');
        $('body').removeClass('close');
    });

})(jQuery);
