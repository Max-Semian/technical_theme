(function($) {
    'use strict';

    // Recommended Pages Block Frontend Scripts
    $(document).ready(function() {
        
        // Initialize recommended pages functionality
        function initRecommendedPages() {
            var $recommendedPageItems = $('.recommended-page-item');
            
            if ($recommendedPageItems.length === 0) {
                return;
            }

            // Add hover effects and analytics tracking
            $recommendedPageItems.each(function() {
                var $item = $(this);
                var pageTitle = $item.find('.recommended-page-title').text();
                
                // Add click tracking
                $item.on('click', function(e) {
                    // Track page click event
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'click', {
                            'event_category': 'Recommended Pages',
                            'event_label': pageTitle,
                            'value': 1
                        });
                    }
                    
                    console.log('Recommended page clicked:', pageTitle);
                });

                // Add enhanced hover effects
                $item.on('mouseenter', function() {
                    $(this).addClass('is-hovered');
                }).on('mouseleave', function() {
                    $(this).removeClass('is-hovered');
                });
            });

            // Add lazy loading for background images
            $recommendedPageItems.each(function() {
                var $item = $(this);
                var backgroundImage = $item.css('background-image');
                
                if (backgroundImage && backgroundImage !== 'none') {
                    $item.addClass('has-background-image');
                }
            });

            // Add intersection observer for animations
            if ('IntersectionObserver' in window) {
                var observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            $(entry.target).addClass('in-view');
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '50px'
                });

                $recommendedPageItems.each(function() {
                    observer.observe(this);
                });
            }

            console.log('Recommended Pages Block: Initialized ' + $recommendedPageItems.length + ' page items');
        }

        // Run initialization
        initRecommendedPages();

        // Re-initialize on dynamic content load (for AJAX, etc.)
        $(document).on('acf-blocks:updated', function() {
            initRecommendedPages();
        });
    });

})(jQuery);
