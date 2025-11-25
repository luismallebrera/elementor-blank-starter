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
        e.preventDefault();

        // Trigger transition animation
        $('body').removeClass('active').addClass('close');
        $('.transition-pannel-bg').addClass('active');

        // Get target URL
        var goTo = this.getAttribute('href');

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
