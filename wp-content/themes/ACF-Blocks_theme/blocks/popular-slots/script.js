/**
 * Popular Slots Block Frontend JavaScript
 */

(function($) {
    'use strict';

    // Wait for document ready
    $(document).ready(function() {
        // Initialize popular slots block functionality
        initPopularSlotsBlock();
    });

    function initPopularSlotsBlock() {
        var $popularSlotsBlocks = $('.popular-slots-block');
        
        if ($popularSlotsBlocks.length === 0) {
            return;
        }

        $popularSlotsBlocks.each(function() {
            var $block = $(this);
            var $slotItems = $block.find('.popular-slot-item');
            
            // Add hover animations and interactions
            $slotItems.each(function() {
                var $item = $(this);
                var $buttons = $item.find('.slot-btn');
                
                // Button hover effects
                $buttons.on('mouseenter', function() {
                    $(this).addClass('btn-hover');
                });
                
                $buttons.on('mouseleave', function() {
                    $(this).removeClass('btn-hover');
                });
                
                // Slot item hover effects
                $item.on('mouseenter', function() {
                    $(this).addClass('slot-hover');
                });
                
                $item.on('mouseleave', function() {
                    $(this).removeClass('slot-hover');
                });
            });
            
            // Handle button clicks with analytics (if needed)
            $block.find('.slot-btn-demo').on('click', function(e) {
                var $btn = $(this);
                var $item = $btn.closest('.popular-slot-item');
                var slotTitle = $item.find('.popular-slot-title').text();
                
                // Add click effect
                $btn.addClass('btn-clicked');
                setTimeout(function() {
                    $btn.removeClass('btn-clicked');
                }, 200);
                
                // You can add analytics tracking here
                console.log('Demo clicked for slot:', slotTitle);
            });
            
            $block.find('.slot-btn-play').on('click', function(e) {
                var $btn = $(this);
                var $item = $btn.closest('.popular-slot-item');
                var slotTitle = $item.find('.popular-slot-title').text();
                
                // Add click effect
                $btn.addClass('btn-clicked');
                setTimeout(function() {
                    $btn.removeClass('btn-clicked');
                }, 200);
                
                // You can add analytics tracking here
                console.log('Play clicked for slot:', slotTitle);
            });
        });
        
        // Add scroll animation if slots are in viewport
        if (typeof window.IntersectionObserver !== 'undefined') {
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        var $target = $(entry.target);
                        $target.addClass('slots-visible');
                        
                        // Animate slot items with delay
                        var $items = $target.find('.popular-slot-item');
                        $items.each(function(index) {
                            var $item = $(this);
                            setTimeout(function() {
                                $item.addClass('slot-animated');
                            }, index * 100);
                        });
                        
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });
            
            $popularSlotsBlocks.each(function() {
                observer.observe(this);
            });
        }
    }

})(jQuery);
