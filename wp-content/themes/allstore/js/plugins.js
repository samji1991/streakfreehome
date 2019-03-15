"use strict";

function allstore_getGridSize_discounts () {
	return (window.innerWidth < 600) ? 1 :
	(window.innerWidth < 1200) ? 2 : 3;
}
function allstore_getGridSize_pop () {
	return (window.innerWidth < 480) ? 1 :
	(window.innerWidth < 650) ? 2 :
	(window.innerWidth < 992) ? 3 :
	(window.innerWidth < 1200) ? 3 : 4;
}
function allstore_getGridSize_postrel (type) {
	var count = 3;
	if (type == 'type-2') {
		count = 2;
	}
	return (window.innerWidth < 480) ? 1 :
	(window.innerWidth < 650) ? 2 : count;
}
function allstore_getGridSize_brands () {
	return (window.innerWidth < 400) ? 1 :
	(window.innerWidth < 550) ? 2 :
	(window.innerWidth < 650) ? 3 :
	(window.innerWidth < 992) ? 4 :
	(window.innerWidth < 1200) ? 5 : 6;
}
function allstore_catalog_images_carousel_init() {
	if (jQuery('.prod-i-img.prod-i-carousel:not(.brazzers-daddy)').length > 0) {
		jQuery(".prod-i-img.prod-i-carousel:not(.brazzers-daddy)").brazzersCarousel();
	}
	if (jQuery('.prodlist-i-img.prodlist-i-carousel:not(.brazzers-daddy)').length > 0) {
		jQuery(".prodlist-i-img.prodlist-i-carousel:not(.brazzers-daddy)").brazzersCarousel();
	}
	if (jQuery('.prod-tb .list-img-carousel:not(.brazzers-daddy)').length > 0) {
		jQuery(".prod-tb .list-img-carousel:not(.brazzers-daddy)").brazzersCarousel();
	}
}
function htmlspecialchars_decode (string, quoteStyle) {
	var optTemp = 0
	var i = 0
	var noquotes = false
	if (typeof quoteStyle === 'undefined') {
		quoteStyle = 2
	}
	string = string.toString()
	.replace(/&lt;/g, '<')
	.replace(/&gt;/g, '>')
	var OPTS = {
		'ENT_NOQUOTES': 0,
		'ENT_HTML_QUOTE_SINGLE': 1,
		'ENT_HTML_QUOTE_DOUBLE': 2,
		'ENT_COMPAT': 2,
		'ENT_QUOTES': 3,
		'ENT_IGNORE': 4
	}
	if (quoteStyle === 0) {
		noquotes = true
	}
	if (typeof quoteStyle !== 'number') {
		quoteStyle = [].concat(quoteStyle)
		for (i = 0; i < quoteStyle.length; i++) {
			if (OPTS[quoteStyle[i]] === 0) {
				noquotes = true
			} else if (OPTS[quoteStyle[i]]) {
				optTemp = optTemp | OPTS[quoteStyle[i]]
			}
		}
		quoteStyle = optTemp
	}
	if (quoteStyle & OPTS.ENT_HTML_QUOTE_SINGLE) {
		string = string.replace(/&#0*39;/g, "'")
	}
	if (!noquotes) {
		string = string.replace(/&quot;/g, '"')
	}
	string = string.replace(/&amp;/g, '&')
	return string
}

jQuery(document).ready(function ($) {

// Modal Images
$('.fancy-img').fancybox({
	padding: 0,
	helpers: {
		overlay: {
			locked: false
		},
		thumbs: {
			width: 60,
			height: 60
		}
	}
});

// Footer Modal Blocks
if ($('.f-block-btn').length > 0) {
	$('body').on('click', '.f-block-btn', function () {
		var data = $(this).parent().find('.f-block-cont');
		if ($(data).find('div.wpcf7 > form').length) {
			var has_form = true;
		}

		$.fancybox({
			content: data,
			wrapCSS : 'f-block-modal-wrap',
			padding: 0,
			helpers : {
				overlay : {
					locked  : false
				}
			},
			beforeLoad: function () {
				if (!has_form) {
					this.content["0"].innerHTML = htmlspecialchars_decode(this.content["0"].innerHTML);
				}
			},
		});

		return false;
	});
}


// Product Related
if ($('#prod-related-car-top').length > 0) {
	$('#prod-related-car-top').flexslider({
		animation: "slide",
		controlNav: true,
		slideshow: false,
		selector: '.slides > li',
	});
}
if ($('#prod-related-car').length > 0) {
	$('#prod-related-car').flexslider({
		animation: "slide",
		controlNav: true,
		slideshow: false,
		selector: '.slides > li',
	});
}
if ($('#prod-related-car2').length > 0) {
	$('#prod-related-car2').flexslider({
		animation: "slide",
		controlNav: true,
		slideshow: false,
		selector: '.slides > li',
	});
}

// Counters | Progress bar
if ($('.facts-i-percent').length > 0) {
	var waypoints = $('.facts-i-percent').eq(1).waypoint({
		handler: function(direction) {
			$('.facts-i-percent').each(function () {

				var bar = new ProgressBar.Circle('#' + $(this).attr('id'), {
					strokeWidth: 4,
					trailWidth: 1,
					easing: 'easeInOut',
					duration: 1400,
					text: {
						autoStyleContainer: false
					},
					from: { color: '#dddddd', width: 1 },
					to: { color: '#3a89cf', width: 4 },
					step: function(state, circle) {
						circle.path.setAttribute('stroke', state.color);
						circle.path.setAttribute('stroke-width', state.width);

						var value = Math.round(circle.value() * 100);
						if (value === 0) {
							circle.setText('');
						} else {
							circle.setText(value + '<span>%</span>');
						}

					}
				});

bar.animate($(this).data('num'));  // Number from 0.0 to 1.0

});

			this.disable();
		},
		offset: 'bottom-in-view'
	});
}

// Counters
if ($('.facts-i-num').length > 0) {
	var waypoints = $('.facts-i-num').eq(1).waypoint({
		handler: function(direction) {
			$('.facts-i-num').each(function () {
				$(this).prop('Counter',0).animate({
					Counter: $(this).data('num')
				}, {
					duration: 3000,
					step: function (now) {
						$(this).text(Math.ceil(now));
					}
				});
			});
			this.disable();
		},
		offset: 'bottom-in-view'
	});
}

// Catalog Images Carousel
allstore_catalog_images_carousel_init();


	// Sticky sidebar Catalog
	if ($('#section-sticky-sb').length > 0 && $('#section-sticky-cont').length > 0) {
		$('#section-sticky-sb, #section-sticky-cont').theiaStickySidebar({
			additionalMarginTop: 30
		});
	}

	// Sticky sidebar Blog
	if ($('#blog-sticky-sb').length > 0 && $('#blog-sticky-cont').length > 0) {
		$('#blog-sticky-sb, #blog-sticky-cont').theiaStickySidebar({
			additionalMarginTop: 30
		});
	}

});


(function($) {
	jQuery(window).load(function(){

// Reviews Carousel
if ($('.reviewscar').length > 0) {
	$('.reviewscar').each(function () {
		var galleryTop = new Swiper($(this), {
			roundLengths: true,
			loop:true,
			autoHeight:true,
loopedSlides: 9, //looped slides should be the same
spaceBetween: 10
});
		var galleryThumbs = new Swiper($(this).next('.reviewscar-thumbs'), {
			spaceBetween: 10,
			centeredSlides: true,
			slidesPerView: 'auto',
			touchRatio: 0.2,
			roundLengths: true,
			loop:true,
loopedSlides: 9, //looped slides should be the same2
slideToClickedSlide: true
});
		galleryTop.params.control = galleryThumbs;
		galleryThumbs.params.control = galleryTop;
	});
}

// Images Carousel
if ($('.images-carousel').length > 0) {
	$('.images-carousel').each(function () {
		var carousel = $(this);

		if (carousel.find('.swiper-button-next').length > 0) {
			var nextButton = '.swiper-button-next';
			var prevButton = '.swiper-button-prev';
		} else {
			var nextButton = null;
			var prevButton = null;
		}
		if (carousel.find('.swiper-pagination').length > 0) {
			var pagination = '.swiper-pagination';
		} else {
			var pagination = null;
		}
		if (carousel.find('.swiper-scrollbar').length > 0) {
			var scrollbar = '.swiper-scrollbar';
		} else {
			var scrollbar = null;
		}

		var images_carousel = new Swiper(carousel, {
			roundLengths: true,
			loop: carousel.data('loop'),
			autoHeight: carousel.data('auto_height'),
			nextButton: nextButton,
			prevButton: prevButton,
			pagination: pagination,
			paginationType: carousel.data('pagination_type'),
			paginationClickable: true,
			scrollbar: scrollbar,
			scrollbarHide: carousel.data('scrollbar_hide'),
			scrollbarDraggable: carousel.data('scrollbar_draggable'),
			speed: carousel.data('speed'),
			autoplay: carousel.data('autoplay'),
			autoplayStopOnLast: carousel.data('autoplay_stop_on_last'),
			autoplayDisableOnInteraction: carousel.data('autoplay_disable_on_interaction'),
			freeMode: carousel.data('free_mode'),
			freeModeMomentum: carousel.data('free_mode_momentum'),
			freeModeSticky: carousel.data('free_mode_sticky'),
			spaceBetween: carousel.data('space_between'),
			slidesPerView: carousel.data('slides_per_view'),
			slidesPerGroup: carousel.data('slides_per_group'),
			centeredSlides: carousel.data('centered_slides'),
			grabCursor: carousel.data('grab_cursor'),
			direction: carousel.data('direction'),
			mousewheelControl: carousel.data('mousewheel_control'),
			keyboardControl: carousel.data('keyboard_control'),
			effect: carousel.data('effect'),

		});
	});
}

// Special Offer Carousel
if ($('.discounts-list').length > 0) {
	$('.discounts-list').each(function () {
		var flexslider_discounts = { vars:{} };
		var discounts_this = $(this);
		$(this).flexslider({
			animation: "slide",
			controlNav: false,
			slideshow: false,
			itemWidth: 288,
			selector: '.slides > div',
			itemMargin: 30,
			minItems: allstore_getGridSize_discounts(),
			maxItems: allstore_getGridSize_discounts(),
			start: function(slider){
				flexslider_discounts = slider;
				discounts_this.resize();
			}
		});
		$(window).resize(function () {
			var gridSize = allstore_getGridSize_discounts();
			if (typeof flexslider_discounts.vars !== "undefined") {
				flexslider_discounts.vars.minItems = gridSize;
				flexslider_discounts.vars.maxItems = gridSize;
			}
		});

	});
}

// Popular Products Carousel
if ($('.products_carousel').length > 0) {
	$(".products_carousel").each(function () {
		var fr_pop_this = $(this);
		var flexslider_slider = { vars:{} };
		$(this).flexslider({
			animation: "slide",
			selector: '.slides > .prod-i',
			controlNav: true,
			slideshow: false,
			itemWidth: 270,
			itemMargin: 12,
			minItems: allstore_getGridSize_pop(),
			maxItems: allstore_getGridSize_pop(),
			start: function(slider){
				flexslider_slider = slider;
				fr_pop_this.resize();
			}
		});
		$(window).resize(function() {
			var gridSize = allstore_getGridSize_pop();
			if (typeof flexslider_slider.vars !== "undefined") {
				flexslider_slider.vars.minItems = gridSize;
				flexslider_slider.vars.maxItems = gridSize;
			}
		});
	});
}


// Brands Carousel
if ($('.brands-list').length > 0) {
	$('.brands-list').each(function () {
		var flexslider_brands;
		$(this).flexslider({
			animation: "slide",
			controlNav: false,
			slideshow: false,
			itemWidth: 150,
			itemMargin: 20,
			minItems: allstore_getGridSize_brands(),
			maxItems: allstore_getGridSize_brands(),
			start: function(slider){
				flexslider_brands = slider;
			}
		});
		$(window).resize(function () {
			var gridSize = allstore_getGridSize_brands();
			if (typeof flexslider_brands.vars !== "undefined") {
				flexslider_brands.vars.minItems = gridSize;
				flexslider_brands.vars.maxItems = gridSize;
			}
		});
	});
}

// Select Styles
if ($('.section-sb:not(.WOOF_Widget) select').length > 0) {
	$('.section-sb:not(.WOOF_Widget) select').chosen({
		disable_search_threshold: 10
	});
}
if ($('.prod-cont select').length > 0) {
	$('.prod-cont select').chosen({
		disable_search_threshold: 10
	});
}
if ($('body .prodlist-i select').length > 0) {
	$('body .prodlist-i select').chosen({
		disable_search_threshold: 10
	});
}
if ($('.woocommerce-ordering select.orderby').length > 0) {
	$('.woocommerce-ordering select.orderby').chosen({
		disable_search_threshold: 10
	});
}
if ($('.form-wppp-select select.wppp-select').length > 0) {
	$('.form-wppp-select select.wppp-select').chosen({
		disable_search_threshold: 10
	});
}


// Product Articles
if ($('#post-rel-car').length > 0) {
	var flexslider3;
	var type = 'type-1';
	if ($('#post-rel-car').data('type') == 'type-2') {
		type = 'type-2';
	}
	$('#post-rel-car').flexslider({
		animation: "slide",
		controlNav: false,
		slideshow: false,
		itemWidth: 274,
		itemMargin: 20,
		minItems: allstore_getGridSize_postrel(type),
		maxItems: allstore_getGridSize_postrel(type),
		start: function(slider){
			flexslider3 = slider;
			$("#post-rel-car").resize();
		}
	});
	$(window).resize(function() {
		var gridSize = allstore_getGridSize_postrel(type);
		/*if (typeof flexslider3.vars !== "undefined") {
			flexslider3.vars.minItems = gridSize;
			flexslider3.vars.maxItems = gridSize;
		}*/
	});
}

// Post Slider
if ($('#post-slider-car').length > 0) {
	$('#post-slider-car').flexslider({
		smoothHeight: true,
		controlNav: false,
	});
}

});
})(jQuery);




// WooCommerce Ajax Cart
function allstore_ajax_cart(element) {
    var form = element.closest('form');

	// emulates button Update cart click
    jQuery("<input type='hidden' name='update_cart' id='update_cart' value='1'>").appendTo(form);

	// plugin flag
    jQuery("<input type='hidden' name='is_wac_ajax' id='is_wac_ajax' value='1'>").appendTo(form);

    var el_qty = element;
    var matches = element.attr('name').match(/cart\[(\w+)\]/);
    var cart_item_key = matches[1];
    form.append( jQuery("<input type='hidden' name='cart_item_key' id='cart_item_key'>").val(cart_item_key) );

	// when qty is set to zero, then fires default woocommerce remove link
    if ( el_qty.val() == 0 ) {
        var removeLink = element.closest('.cart_item').find('.product-remove a');
        removeLink.click();

        return false;
    }

	// get the form data before disable button...
    var formData = form.serialize();

    jQuery("a.checkout-button.wc-forward").addClass('disabled');

    jQuery.post( form.attr('action'), formData, function(resp) {

    	var cur_item = element.closest('.cart_item');
		cur_item.find('.product-subtotal').html(jQuery(resp).find('.cart_item[data-id=' + cur_item.data('id') + '] .product-subtotal').html());

    	jQuery('.cart-subtotal').html(jQuery(resp).find('.cart-subtotal').html());
    	jQuery('.order-total').html(jQuery(resp).find('.order-total').html());

        jQuery('#update_cart').remove();
        jQuery('#is_wac_ajax').remove();
        jQuery('#cart_item_key').remove();

        jQuery("a.checkout-button.wc-forward").removeClass('disabled');

		// fix to update "Your order" totals when cart is inside Checkout page
        if ( jQuery( '.woocommerce-checkout' ).length ) {
            jQuery( document.body ).trigger( 'update_checkout' );
        }

        jQuery( document.body ).trigger( 'updated_cart_totals' );
    });
}


jQuery(document).ready(function($){
	$(document).on('change','.cart-quantity .qty', {} ,function(e){
		allstore_ajax_cart( $(this) );
	});
});