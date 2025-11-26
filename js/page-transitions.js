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
        $('body').addClass('close').removeClass('active');
        $('.transition-pannel-bg').addClass('active');
        $('.transition-borders-bg').addClass('active');

        // Navigate after animation completes
        setTimeout(function() {
            window.location.href = goTo;
        }, parseInt(settings.duration));
    });

    // Remove transition classes on page load
    $(document).ready(function() {
        // Remove initial-load class after brief delay
        setTimeout(function() {
            $('.transition-pannel-bg').removeClass('initial-load');
            
            // Immediately add page-loaded to start entrance animation
            if (settings.enableEntrance) {
                $('body').addClass('page-loaded');
            }
        }, 50);
        
        // Check if entrance animation is enabled
        if (!settings.enableEntrance) {
            // No entrance animation, just remove classes immediately
            $('.transition-pannel-bg').removeClass('active');
            $('.transition-borders-bg').removeClass('active');
            $('body').removeClass('close');
            return;
        }
        
        // Wait for entrance to complete before removing active class
        setTimeout(function() {
            $('.transition-pannel-bg').removeClass('active');
            $('.transition-borders-bg').removeClass('active');
            $('body').removeClass('close');
        }, parseInt(settings.duration) + 50);
    });
    
    // Also handle pageshow event (for back/forward navigation)
    $(window).on('pageshow', function(event) {
        if (event.originalEvent.persisted) {
            // Page was loaded from cache (back button)
            
            // Check if entrance animation is enabled
            if (!settings.enableEntrance) {
                $('.transition-pannel-bg').removeClass('active');
                $('.transition-borders-bg').removeClass('active');
                $('body').removeClass('close');
                return;
            }
            
            if (settings.animation === 'fade') {
                // For fade animation, trigger fade out
                $('body').addClass('page-loaded');
                
                setTimeout(function() {
                    $('.transition-pannel-bg').removeClass('active');
                    $('.transition-borders-bg').removeClass('active');
                    $('body').removeClass('close');
                }, parseInt(settings.duration));
            } else {
                // For slide animations, trigger entrance
                $('body').addClass('page-loaded');
                
                setTimeout(function() {
                    $('.transition-pannel-bg').removeClass('active');
                    $('.transition-borders-bg').removeClass('active');
                    $('body').removeClass('close');
                }, parseInt(settings.duration));
            }
        }
    });

})(jQuery);
