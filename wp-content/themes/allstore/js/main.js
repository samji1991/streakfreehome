"use strict";

/*function allstore_pad(n) {
    return (n < 10) ? ("0" + n) : n;
}*/
function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
function in_array(needle, haystack, strict) {
    var found = false, key, strict = !!strict;
    for (key in haystack) {
        if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
            found = true;
            break;
        }
    }
    return found;
}


function allstore_slider_init(refresh, parent) {

    if (refresh) {
        jQuery('.prod-thumbs').html(jQuery('.prod-thumbs .bx-viewport').html());
        jQuery('.prod-slider').html(jQuery('.prod-slider .bx-viewport').html());
        jQuery('.prod-slider-car').removeAttr('style').find("li").off().removeAttr('style');
        jQuery('.prod-thumbs-car').removeAttr('style').find("li").off().removeAttr('style');
        jQuery('.prod-thumbs-car li').each(function (index) {
            jQuery(this).find('a').attr('data-slide-index', index);
        });
    }

    var thumbs_car = '.prod-thumbs-car';
    var slider_car = '.prod-slider-car';

    if (parent) {
        thumbs_car = parent + ' ' + thumbs_car;
        slider_car = parent + ' ' + slider_car;
    }

    jQuery(slider_car).bxSlider({
        pagerCustom: jQuery(thumbs_car),
        adaptiveHeight: true,
        infiniteLoop: false,
    });
    jQuery(thumbs_car).bxSlider({
        slideWidth: 5000,
        slideMargin: 8,
        moveSlides: 1,
        infiniteLoop: false,
        minSlides: 5,
        maxSlides: 5,
        pager: false,
    });
}


jQuery(document).ready(function ($) {

    // Ajaxify compare button
    $('body').on( 'click', '.compare-btn', function(e){

        if ($(this).hasClass('compare-added'))
            return true;

        e.preventDefault();

        var button = $(this);
        if (!button.hasClass('loading')) {

            button.addClass('loading');

            $.ajax({
                type: 'post',
                url: $(this).attr('href'),
                success: function(response){

                    button.removeClass('loading').addClass('compare-added');

                    if ($('#h-compare-count').length > 0) {
                        var count = $('#h-compare-count').text();
                        count++;
                        $('#h-compare-count').text(count);
                    }

                    $( '#compare-popup-message' ).remove();
                    $( 'body' ).append( '<div id="compare-popup-message">Product added!</div>' );
                    $( '#compare-popup-message' ).css( 'margin-left', '-' + $( '#compare-popup-message' ).width() + 'px' ).fadeIn();
                    window.setTimeout( function() {
                        $( '#compare-popup-message' ).fadeOut();
                    }, 2000 );
                }
            });
        }
    });

    // Products "Load more"
    $('.prod-items-loadmore').on('click', '.prod-items-loadmore-btn', function () {
        var button = $(this);
        var max_num_pages = button.attr('data-max-num-pages');
        var page_num = button.attr('data-page-num');
        var posts_per_page = button.attr('data-posts_per_page');
        var container = button.parent().parent().find(button.attr('data-container'));
        var url = button.attr('data-url');
        var file = button.attr('data-file');
        var order = button.attr('data-order');
        var orderby = button.attr('data-orderby');
        var viewmode = button.attr('data-viewmode');
        var catalog_galimg = button.attr('data-catalog_galimg');
        var catalog_galbtns = button.attr('data-catalog_galbtns');
        var catalog_listimg = button.attr('data-catalog_listimg');
        var catalog_listactions = button.attr('data-catalog_listactions');
        var catalog_listatts = button.attr('data-catalog_listatts');
        var catalog_listadd2cart = button.attr('data-catalog_listadd2cart');
        var catalog_tbimg = button.attr('data-catalog_tbimg');
        var catalog_tbadd2cart = button.attr('data-catalog_tbadd2cart');
        var item = button.attr('data-item');
        var ids = button.attr('data-ids');

        if (!button.hasClass('loading')) {

            button.addClass('loading');
            page_num++;
            button.attr('data-page-num', page_num);

            $.ajax({
                type: "POST",
                data: {
                    posts_per_page : posts_per_page,
                    page_num: page_num,
                    order: order,
                    orderby: orderby,
                    viewmode: viewmode,
                    catalog_galimg: catalog_galimg,
                    catalog_galbtns: catalog_galbtns,
                    catalog_listimg: catalog_listimg,
                    catalog_listactions: catalog_listactions,
                    catalog_listatts: catalog_listatts,
                    catalog_listadd2cart: catalog_listadd2cart,
                    catalog_tbimg: catalog_tbimg,
                    catalog_tbadd2cart: catalog_tbadd2cart,
                    file: file,
                    ids: ids,
                    action: 'allstore_load_more'
                },
                url: url,
                success: function(data){
                    $(button).removeClass('loading');
                    if (max_num_pages <= page_num) {
                        $(button).remove();
                    }
                    var btn_new = $(data).find('.' + button.attr('class'));
                    var posts_list = $(data).find(item);
                    container.append(posts_list);
                    button.attr('data-max-num-pages', btn_new.attr('data-max-num-pages'));

                    catalog_images_carousel_init();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $(button).remove();
                    alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                }
            });
        }
        return false;
    });


    // Product quantity for List view mode
    $('body').on('click', '.prod-qnt a', function () {
        var qnt_btn = $(this);
        var qnt_wrap = qnt_btn.parents('.prod-qnt');
        var qnt_input = qnt_wrap.find('input');
        var qnt = qnt_input.val();
        if (qnt_btn.data('qnt') == 'minus' && qnt > 1) {
            qnt--;
        } else if (qnt_btn.data('qnt') == 'plus') {
            qnt++;
        }
        qnt_input.val(qnt);
        qnt_input.trigger('change');
        return false;
    });

    // Product quantity for Table view mode
    $('body').on('click', '.prodtb-i-qnt a', function () {
        var qnt_btn = $(this);
        var prod = qnt_btn.parents('.prodtb-i');
        var qnt_wrap = qnt_btn.parents('.prodtb-i-qnt');
        var qnt_input = qnt_wrap.find('input');
        var qnt = qnt_input.val();
        if (qnt_btn.data('qnt') == 'minus' && qnt > 1) {
            qnt--;
        } else if (qnt_btn.data('qnt') == 'plus') {
            qnt++;
        }
        qnt_input.val(qnt);

        if (prod.hasClass('product-type-simple')) {
            var prod_add = prod.find('.prod-add-btn');
            if (prod_add.length) {
                prod_add.data('quantity', qnt);
            }
        } else if (prod.hasClass('product-type-variable')) {
            var prod_qnt = prod.find('.prod-qnt input');
            if (prod_qnt.length) {
                prod_qnt.val(qnt);
            }
        }

        return false;
    });
    $('body').on('change', '.prodtb-i .prod-qnt input', function () {
        var prod_input = $(this);
        var prod = prod_input.parents('.prodtb-i');
        var qnt_input = prod.find('.prodtb-i-qnt input');
        qnt_input.val(prod_input.val());
    });


    // Single Product Tabs
    $('body').on('click', '.prod-tabs li a', function () {
        if ($(this).hasClass('active') || $(this).attr('data-prodtab') == '')
            return false;
        $(this).parents('.prod-tabs').find('li a').removeClass('active');
        $(this).addClass('active');

        // mobile
        $('.prod-tab-mob[data-prodtab-num=' + $(this).data('prodtab-num') + ']').parents('.prod-tab-cont').find('.prod-tab-mob').removeClass('active');
        $('.prod-tab-mob[data-prodtab-num=' + $(this).data('prodtab-num') + ']').addClass('active');

        $($(this).attr('data-prodtab')).parents('.prod-tab-cont').find('.prod-tab').css('height', '0px');
        $($(this).attr('data-prodtab')).css('height', 'auto');
        return false;
    });

    // Single Product Tabs (mobile)
    $('body').on('click', '.prod-tab-cont .prod-tab-mob', function () {
        if ($(this).hasClass('active') || $(this).attr('data-prodtab') == '')
            return false;
        $(this).parents('.prod-tab-cont').find('.prod-tab-mob').removeClass('active');
        $(this).addClass('active');

        // main
        $('.prod-tabs li a[data-prodtab-num=' + $(this).data('prodtab-num') + ']').parents('.prod-tabs').find('li a').removeClass('active');
        $('.prod-tabs li a[data-prodtab-num=' + $(this).data('prodtab-num') + ']').addClass('active');

        $($(this).attr('data-prodtab')).parents('.prod-tab-cont').find('.prod-tab').css('height', '0px');
        $($(this).attr('data-prodtab')).css('height', 'auto').hide().fadeIn();
        return false;
    });


    // "All Features" button
    $('.prod-showprops').on('click', function () {
        if ($('.prod-tabs li a.active').attr('data-prodtab') == '#prod-tab-additional_information') {
            $('html, body').animate({scrollTop: ($('.prod-tabs-wrap').offset().top - 10)}, 700);
        } else {
            $('.prod-tabs li a').removeClass('active');
            $('.additional_information_tab a').addClass('active');
            $('.prod-tab-cont .prod-tab').css('height', '0px');
            $('#prod-tab-additional_information').css('height', 'auto');
            $('html, body').animate({scrollTop: ($('.prod-tabs-wrap').offset().top - 10)}, 700);
        }
        return false;
    });

    // Sidebar Categories
    $('#section-sb-toggle').on('click', function () {
        $('#section-sb-list').slideToggle();
        if ($(this).hasClass('opened'))
            $(this).removeClass("opened");
        else
            $(this).addClass('opened');
        return false;
    });
    $("#section-sb-list li.has_child").on("click", ".section-sb-toggle", function () {
        $(this).parent().next("ul").slideToggle();
        if ($(this).hasClass('opened'))
            $(this).removeClass("opened");
        else
            $(this).addClass('opened');
        return false;
    });

    /*
    // Catalog View Mode
    if ($('#section-mode').length > 0) {
        $('#section-mode').on('click', 'a[data-viewmode]', function () {
            var viewmode = $(this).data('viewmode');
            document.cookie = "allstore_catalog_viewmode=" + viewmode + "; expires=Thu, 31 Dec 2040 23:59:59 GMT; path=/;";
        });
    }
    */

    // Quick View
    $('body').on('click', '.qview-btn', function () {
        var button = $(this);
        var product_id = $(this).data('id');
        var file = $(this).data('file');
        var url = $(this).data('url');
        if (!button.hasClass('loading')) {

            button.addClass('loading');

            $.ajax({
                type: "POST",
                data: {
                    file: file,
                    product_id: product_id,
                    action: 'allstore_quick_view'
                },
                url: url,
                success: function(data){
                    $(button).removeClass('loading');
                    $.fancybox({
                        content: data,
                        padding: 0,
                        helpers : {
                            overlay : {
                                locked  : false
                            }
                        }
                    });

                    // Product Images Slider
                    if ($('.prod-slider-car').length > 0) {
                        allstore_slider_init(false, '.quick-view-modal');
                    }
                    // Selects
                    if ($('.prod-cont select').length > 0) {
                        $('.prod-cont select').chosen({
                            disable_search_threshold: 10
                        });
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $(button).remove();
                    alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                }
            });
        }
        return false;
    });

    // Filter Toggle (mobile)
    $('.widget').on('click', '#section-filter-toggle', function () {
        $(this).next('.woof').slideToggle();
        if ($(this).hasClass('opened')) {
            $(this).removeClass("opened").find('span').text($(this).data("open"));
        }
        else {
            $(this).addClass('opened').find('span').text($(this).data("close"));
        }
        return false;
    });

    // Product Offers (select type)
    $('body').on('click', '.offer-props-select p', function () {
        if ($(this).parent().hasClass('opened'))
            $(this).parent().removeClass('opened');
        else
            $(this).parent().addClass('opened');
        return false;
    });
    $('body').on('click', '.offer-props-select li', function () {
        if ($(this).parent().parent().hasClass('opened'))
            $(this).parent().parent().removeClass('opened');
        else
            $(this).parent().parent().addClass('opened');
    });
    $('body').on('click', '.offer-props-select li', function () {
        $(this).parent().parent().find('p').html($(this).text());
    });

    // Topmenu
    $('.topmenu').on('click', '.mainmenu-btn', function () {
        if ($('.cmm-container.toggled-on').length) {
            $('.cmm-container.toggled-on').removeClass('toggled-on');
            $('.cmm-toggle.toggled-on').removeClass('toggled-on');
        }
        if ($('body').hasClass('mainmenu-show')) {
            $('body').removeClass('mainmenu-show');
        } else {
            $('body').addClass('mainmenu-show');
        }
            return false;
    });
    $('html').on('click', 'body.mainmenu-show', function () {
        $('body').removeClass('mainmenu-show');
    });
    $('body').on('click', '.mainmenu', function(event){
        event.stopPropagation();
    });

    // Topmenu (mobile)
    if ($(window).width() <= 751) {
        $('.topmenu .mainmenu li a .fa').on('click', function () {
            if ($(this).parent().next('.sub-menu').hasClass('opened')) {
                $(this).parent().next('.sub-menu').removeClass('opened');
                $(this).parent().next('.sub-menu').slideUp();
            } else {
                $(this).parent().next('.sub-menu').addClass('opened');
                $(this).parent().next('.sub-menu').slideDown();
            }
            return false;
        });

        $('.topcatalog').on('click', '.topcatalog-btn', function () {
            if ($('body').hasClass('topcatalog-show')) {
                $('body').removeClass('topcatalog-show');
            } else {
                $('body').addClass('topcatalog-show');
            }
            return false;
        });
        $('html').on('click', 'body.topcatalog-show', function () {
            $('body').removeClass('topcatalog-show');
        });
        $('body').on('click', '.topcatalog-list', function(event){
            event.stopPropagation();
        });
        $('.topcatalog li .fa').on('click', function () {
            if ($(this).next('ul').hasClass('opened')) {
                $(this).next('ul').removeClass('opened');
                $(this).next('ul').slideUp();
            } else {
                $(this).next('ul').addClass('opened');
                $(this).next('ul').slideDown();
            }
            return false;
        });
    }

    // Search Button
    $('.topsearch').on('click', '#topsearch-btn', function () {
        if ($('body').hasClass('search-show')) {
            $('body').removeClass('search-show');
        } else {
            $('body').addClass('search-show');
        }
            return false;
    });

    // Search Close
    $('body.search-show').on('click', '#topsearch-btn', function () {
        if ($('body').hasClass('search-show')) {
            $('body').removeClass('search-show');
        }
        return false;
    });
    $('html').on('click', 'body.search-show', function (event) {
        if ($(event.target).parents('.topsearch').length) {

        } else {
            $('body').removeClass('search-show');
        }
    });
    /*$('body').on('click', '.topsearch', function(event){
        event.stopPropagation();
    });*/


    // Reviews "Show Answer" button
    if ($('.reviews-i-showanswer').length > 0) {
        $('.reviews-i-showanswer').on('click', function () {
            if ($(this).hasClass('opened')) {
                $(this).removeClass('opened').find('span').text($(this).find('span').data('open'));
                $(this).parents('.reviews-i').find('.reviews-i-answer').slideUp();
            } else {
                $(this).addClass('opened').find('span').text($(this).find('span').data('close'));
                $(this).parents('.reviews-i').find('.reviews-i-answer').slideDown();
            }
            return false;
        });
    }

    // Catalog Gallery - Show Properties on hover
    if ($('.prod-i-action .prod-i-properties-label').length > 0) {
        /*$('.prod-i-action .prod-i-properties-label').on({
            mouseenter: function () {
                $(this).parents('.prod-i').find('.prod-i-properties').addClass('show');
                return false;
            },
            mouseleave: function () {
                $(this).parents('.prod-i').find('.prod-i-properties').removeClass('show');
                return false;
            }
        });*/
        $('body').on('mouseenter', '.prod-i-action .prod-i-properties-label', function () {
                $(this).parents('.prod-i').find('.prod-i-properties').addClass('show');
                return false;
            }
        ).on('mouseleave', '.prod-i-action .prod-i-properties-label', function () {
                $(this).parents('.prod-i').find('.prod-i-properties').removeClass('show');
                return false;
            }
        );
    }

    // Catalog Table - Show more info button
    if ($('.prodtb-i-toggle').length > 0) {
        $('body').on('click', '.prodtb-i-toggle', function () {
            if ($(this).hasClass('opened')) {
                $(this).removeClass('opened').parents('.prodtb-i').find('.prodlist-i').hide();
            } else {
                $(this).addClass('opened').parents('.prodtb-i').find('.prodlist-i').show();
            }
            return false;
        });
    }
    if ($('.prodtb-i-toggle-rt').length > 0) {
        $('body').on('click', '.prodtb-i-toggle-rt', function () {
            if ($(this).hasClass('opened')) {
                $(this).removeClass('opened').parents('.prodtb-i').find('.prodlist-i').hide();
                $(this).parents('.prodtb-i').find('.prodtb-i-toggle').removeClass('opened');
            } else {
                $(this).addClass('opened').parents('.prodtb-i').find('.prodlist-i').show();
                $(this).parents('.prodtb-i').find('.prodtb-i-toggle').addClass('opened');
            }
            return false;
        });
    }

    // AJAX pagination scroll
    $('body.archive.woocommerce').on('click', 'ul.page-numbers a.page-numbers', function () {
        if ($('#woof_results_by_ajax').length > 0) {
            $('html, body').animate({scrollTop: $('#woof_results_by_ajax').offset().top - 25}, 800);
        }
    });


    $(document).on('woof_ajax_done', function () {
        if ($('body .prodlist-i select').length > 0) {
            $('body .prodlist-i select').chosen({
                disable_search_threshold: 10
            });
        }
        if ($('body .woocommerce-ordering select').length > 0) {
            $('body .woocommerce-ordering select').chosen({
                disable_search_threshold: 10
            });
        }
        if ($('body .products-per-page select').length > 0) {
            $('body .products-per-page select').chosen({
                disable_search_threshold: 10
            });
        }
        if ($('.prod-i-img.prod-i-carousel:not(.brazzers-daddy)').length > 0) {
            $(".prod-i-img.prod-i-carousel:not(.brazzers-daddy)").brazzersCarousel();
        }
        if ($('.prodlist-i-img.prodlist-i-carousel:not(.brazzers-daddy)').length > 0) {
            $(".prodlist-i-img.prodlist-i-carousel:not(.brazzers-daddy)").brazzersCarousel();
        }
        if ($('.prod-tb .list-img-carousel:not(.brazzers-daddy)').length > 0) {
            $(".prod-tb .list-img-carousel:not(.brazzers-daddy)").brazzersCarousel();
        }
    });


    // Video URL
    if ($('.video-i-url').length > 0) {
        $('.video-i-url').fancybox({
            padding: 0,
            type: 'iframe',
            aspectRatio: true,
            beforeLoad: function() {
                var url= $(this.element).attr("href");
                this.href = url
            }
        });
    }


    // Update Compare Count & Active Classes
    var compare_list = getCookie("compare-list");
    if (typeof compare_list !== 'undefined' && compare_list != '') {
        var compare_list_arr = compare_list.split(':');
        compare_list_arr.pop();

        if ($('#h-compare-count').length > 0) {
            $('#h-compare-count').text(compare_list_arr.length);
        }

        $('.compare-btn').each(function () {
            if ($(this).hasClass('compare-added') && !in_array($(this).data('id'), compare_list_arr)) {
                $(this).removeClass('compare-added').attr('href', $(this).data('url'));
                $(this).find('.compare-btn-text').text($(this).data('text'));
            } else if (!$(this).hasClass('compare-added') && in_array($(this).data('id'), compare_list_arr)) {
                $(this).addClass('compare-added').attr('href', $(this).data('url'));
                $(this).find('.compare-btn-text').text($(this).data('text'));
            }
        });
    }


    // Update WishList Count & Active Classes
    var wishlist_list = getCookie("yith_wcwl_products");
    if (typeof wishlist_list !== 'undefined' && wishlist_list != '') {
        var wishlist_list_obj = $.parseJSON(wishlist_list);
        var wishlist_list_ids = [];

        for(var wishlist_item in wishlist_list_obj) {
            wishlist_list_ids[wishlist_list_ids.length] = wishlist_list_obj[wishlist_item]['prod_id'];
        }

        if ($('#h-wishlist-count').length > 0) {
            $('#h-wishlist-count').text(wishlist_list_ids.length);
        }

        $('.add_to_wishlist').each(function () {
            var prod_id = $(this).data('product-id');
            var el_wrap = $( '.add-to-wishlist-' + prod_id );
            if (el_wrap.hasClass('wishlist-added') && !in_array(prod_id, wishlist_list_ids)) {
                el_wrap.removeClass('wishlist-added');
                el_wrap.find( '.yith-wcwl-add-button' ).show().removeClass('hide').addClass('show');
                el_wrap.find( '.yith-wcwl-wishlistexistsbrowse' ).hide().removeClass('show').addClass('hide');
                el_wrap.find( '.yith-wcwl-wishlistaddedbrowse' ).hide().removeClass('show').addClass('hide');
            } else if (!el_wrap.hasClass('wishlist-added') && in_array(prod_id, wishlist_list_ids)) {
                el_wrap.addClass('wishlist-added');
                el_wrap.find('.yith-wcwl-add-button').hide().removeClass('show').addClass('hide');
                el_wrap.find( '.yith-wcwl-wishlistexistsbrowse' ).show().removeClass('hide').addClass('show');
            }
        });
    }
    
});




(function($) {
jQuery(window).load(function(){

    // Quantity
    /*if ($('.cart_item').length > 0) {
        $('input.qty').on('change', function(){
            allstore_ajax_cart($(this));
        });
    }*/

    // Product Images Slider
    if ($('.prod-slider-car').length > 0) {
        allstore_slider_init(false, '');
    }

    // Variation Image
    $( ".variations_form" ).on( "woocommerce_variation_select_change", function () {
        if ($('.prod-varimg').length) {
            $('.prod-varimg').parents('li').remove();
            allstore_slider_init(true, '');
        }
    } );
    $( ".variations_form" ).on( "found_variation", function ( event, variation ) {
        var img_exists = false;
        if ($('.prod-slider-car a[href="' + variation.image.full_src + '"]').length > 0) {
            img_exists = true;
        }
        if (variation.image_id && !img_exists) {
            if ($('.prod-slider-car').length) {
                $('.prod-slider-car').prepend('<li><a data-fancybox-group="product" class="fancy-img" href="' + variation.image.full_src + '"><img class="prod-varimg" src="' + variation.image.full_src + '" alt=""></a></li>');
                $('.prod-thumbs-car').prepend('<li><a data-slide-index="0" href="#"><img class="prod-varimg" src="' + variation.image.full_src + '" alt=""></a></li>');
                allstore_slider_init(true, '');
            }
        }
    } );



    // Filter
    if ($('.section-filter-ttl').length > 0) {
        $('.section-filter').on('click', '.section-filter-ttl', function () {
            if ($(this).parents('.section-filter-item').hasClass('opened')) {
                $(this).parents('.section-filter-item').removeClass('opened');

            } else {
                $(this).parents('.section-filter-item').addClass('opened');
            }
            return false;
        });
    }
    
    // Product Countdown
    /*if ($('.countdown').length > 0) {
        $('.countdown').each(function () {
            if (!$(this).data('date')) {
                return;
            }
            var countdown = $(this);
            var BigDay = new Date(countdown.data('date'));
            var msPerDay = 24 * 60 * 60 * 1000 ;
            window.setInterval(function(){
                var today = new Date();
                var timeLeft = (BigDay.getTime() - today.getTime());
                var e_daysLeft = timeLeft / msPerDay;
                var daysLeft = Math.floor(e_daysLeft);
                var e_hrsLeft = (e_daysLeft - daysLeft)*24;
                var hrsLeft = Math.floor(e_hrsLeft);
                var e_minsLeft = (e_hrsLeft - hrsLeft)*60;
                var minsLeft = Math.floor(e_minsLeft);
                var e_secsLeft = (e_minsLeft - minsLeft)*60;
                var secsLeft = Math.floor(e_secsLeft);
                var timeString = daysLeft + "d " + allstore_pad(hrsLeft) + ":" + allstore_pad(minsLeft) + ":" + allstore_pad(secsLeft);
                countdown.html(timeString);
                if (!countdown.hasClass('display')) {
                    countdown.addClass('display');
                }
            }, 1000);
        });
    }*/

});
})(jQuery);



/* PRODUCT V2 - start */
var fixed_obj = {};

function compareScrollStyles(st, newSt) {
    var obj1 = jQuery.extend({}, st),
        obj2 = jQuery.extend({}, newSt);
    jQuery.each(obj1, function(i, k) {
        if (i !== 'position') {
            obj1[i] = Math.round(k);
        }
    });
    jQuery.each(obj2, function(i, k) {
        if (i !== 'position') {
            obj2[i] = Math.round(k);
        }
    });
    return JSON.stringify(obj1) === JSON.stringify(obj2);
}

function setStyle(elem, name, value){
    elem = jQuery(elem);
    if (!elem) return;
    if (typeof name == 'object') return jQuery.each(name, function(k, v) { setStyle(elem,k,v); });
    elem.removeAttr('style');
    elem.css(name, value + 'px');
}

function fixed_on_scroll() {

    var
        thumbs = jQuery('.prod2-thumbs-car'),
        content = jQuery('.prod-cont-inner'),
        slider = jQuery('.prod2-slider-wrap');

    var
        wh = jQuery(window).height() || 0,
        st = jQuery(window).scrollTop(),
        headH = 15,
        isFixed = content.css('position') == 'fixed',
        contentH = content.outerHeight(),
        sliderH = slider.outerHeight(),
        sliderPos = slider.offset().top,
        tooBig = contentH >= sliderH,
        contentBottom = st + wh - sliderH - sliderPos,
        contentPB = Math.max(0, contentBottom),
        contentPT = sliderPos - headH,
        contentPos = content.offset().top,
        thumbsH = (typeof thumbs !== "undefined" ? thumbs.outerHeight() : 0),
        thumbsPos = (typeof thumbs.offset() !== "undefined" ? thumbs.offset().top : 0),
        lastSt = fixed_obj.lastSt || 0,
        lastStyles = fixed_obj.lastStyles || {},
        styles,
        needFix = false,
        smallEnough = headH + contentH + contentPB <= wh,
        delta = 1;

    if (st - delta < contentPT && !(smallEnough && contentPos < headH) || tooBig) {
        thumbs.removeAttr('style');
        thumbs.removeClass('stick');
    } else if ((wh + st >= Math.max(contentPos + contentH, sliderPos + sliderH)) && (thumbsPos > sliderPos)) {
        thumbs.css('margin-top', (thumbsPos - sliderPos) + 'px');
        thumbs.removeClass('stick');
    } else if (wh + st < Math.max(contentPos + contentH, sliderPos + sliderH) && thumbsH < contentH) {
        thumbs.removeAttr('style');
        thumbs.addClass('stick');
    }

    if (st - delta < contentPT && !(smallEnough && contentPos < headH) || tooBig) {
        styles = {
            marginTop: 0
        };
    } else if (st - delta < Math.min(lastSt, contentPos - headH) || smallEnough) {
        styles = {
            top: headH
        };
        needFix = true;
    } else if (st + delta > Math.max(lastSt, contentPos + contentH - wh) && contentBottom < 0) {
        styles = {
            bottom: 0
        };
        needFix = true;
    } else {
        styles = {
            marginTop: (contentBottom >= 0) ? sliderH - contentH : Math.min(contentPos - sliderPos, sliderH - contentH + contentPT)
        };
    }

    if (!compareScrollStyles(styles, lastStyles)) {
        jQuery.each (lastStyles, function(i, k) {
            lastStyles[i] = null;
        });
        setStyle(content, jQuery.extend(lastStyles, styles));
        fixed_obj.lastStyles = styles;
    }
    if (needFix !== isFixed) {
        if (needFix) {
            jQuery(content).addClass('fixed');
        } else {
            jQuery(content).removeClass('fixed');
        }
    }
    fixed_obj.lastSt = st;

    if (content.width() !== content.parent().width() && needFix) {
        content.width(content.parent().width());
    }
}


(function(jQuery) {
jQuery(window).load(function(){

    if (jQuery('.prod2-slider-wrap').length > 0) {
        if (jQuery(window).width() >= 975) {
            fixed_on_scroll();
        }
        jQuery(window).scroll(function () {
            if (jQuery(window).width() >= 975) {
                fixed_on_scroll();
            }
        });
    }

    if (jQuery('.prod2-thumbs-car li a').length > 0) {

        // Scroll to
        jQuery('.prod2-thumbs-car li').on('click', 'a', function () {
            if (jQuery(window).width() >= 975) {
                var
                    el_index = jQuery(this).attr('data-slide-index'),
                    slide = jQuery('.prod2-slider-car li img').eq(el_index),
                    slide_h = slide.outerHeight(),
                    w_h = jQuery(window).height(),
                    slide_pos = slide.offset().top + slide_h/2 - w_h/2;
                jQuery('html, body').animate({scrollTop: slide_pos}, 700);
                return false;
            }
        });

        // Waypoints
        jQuery('.prod2-slider-car li img').each(function (i) {
            var this_img = jQuery(this);
            var inview = new Waypoint.Inview({
                element: this_img,
                entered: function(direction) {
                    jQuery('.prod2-thumbs-car li img').removeClass('scroll_active');
                    jQuery('.prod2-thumbs-car li img').eq(i).addClass('scroll_active');
                }
            });
        });
    }

    // Product Images Slider
    if (jQuery('.prod2-slider-car').length > 0) {
        jQuery('.prod2-slider-car').each(function () {

            var this_slider = jQuery(this);
            var this_thumbs = jQuery(this).parents('.prod2-slider-wrap').find('.prod2-thumbs-car');

            var slider_load = false;
            var slider;
            var thumbs;
            if (jQuery(window).width() < 975) {
                slider_load = true;

                this_slider.parents('.prod2-slider-wrap').addClass('slider-load');

                slider = this_slider.bxSlider({
                    pagerCustom: this_thumbs,
                    adaptiveHeight: true,
                    infiniteLoop: false,
                });
                thumbs = this_thumbs.bxSlider({
                    slideWidth: 5000,
                    slideMargin: 8,
                    moveSlides: 1,
                    infiniteLoop: false,
                    minSlides: 5,
                    maxSlides: 5,
                    pager: false,
                });
            } else {

            }
            jQuery(window).resize(function () {
                if (!slider_load && jQuery(window).width() < 975) {
                    slider_load = true;

                    this_slider.parents('.prod2-slider-wrap').addClass('slider-load');

                    slider = this_slider.bxSlider({
                        pagerCustom: this_thumbs,
                        adaptiveHeight: true,
                        infiniteLoop: false,
                    });
                    thumbs = this_thumbs.bxSlider({
                        slideWidth: 5000,
                        slideMargin: 8,
                        moveSlides: 1,
                        infiniteLoop: false,
                        minSlides: 5,
                        maxSlides: 5,
                        pager: false
                    });
                } else if (slider_load && jQuery(window).width() >= 975) {
                    slider_load = false;
                    this_slider.parents('.prod2-slider-wrap').removeClass('slider-load');
                    slider.destroySlider();
                    thumbs.destroySlider();
                }
            });
        });

    }

});
})(jQuery);
/* PRODUCT V2 - end */






/*
 Woocommerce Add to cart Ajax for variable products
 http://www.rcreators.com/woocommerce-ajax-add-to-cart-variable-products
 Ajax based add to cart for varialbe products in woocommerce.
 Rishi Mehta - Rcreators Websolutions
 http://rcreators.com
 */
jQuery( function( $ ) {

    // wc_add_to_cart_params is required to continue, ensure the object exists
    if ( typeof wc_add_to_cart_params === 'undefined' )
        return false;

    // Ajax add to cart
    $( document ).on( 'click', '.variations_form .single_add_to_cart_button', function(e) {

        e.preventDefault();

        var $variation_form = $( this ).closest( '.variations_form' );
        var var_id = $variation_form.find( 'input[name=variation_id]' ).val();

        var product_id = $variation_form.find( 'input[name=product_id]' ).val();
        var quantity = $variation_form.find( 'input[name=quantity]' ).val();

        //attributes = [];
        $( '.ajaxerrors' ).remove();
        var item = {},
            check = true;

        var variations = $variation_form.find( 'select[name^=attribute]' );

        /* Updated code to work with radio button - mantish - WC Variations Radio Buttons - 8manos */
        if ( !variations.length) {
            variations = $variation_form.find( '[name^=attribute]:checked' );
        }

        /* Backup Code for getting input variable */
        if ( !variations.length) {
            variations = $variation_form.find( 'input[name^=attribute]' );
        }

        variations.each( function() {

            var $this = $( this ),
                attributeName = $this.attr( 'name' ),
                attributevalue = $this.val(),
                index,
                attributeTaxName;

            $this.removeClass( 'error' );

            if ( attributevalue.length === 0 ) {
                index = attributeName.lastIndexOf( '_' );
                attributeTaxName = attributeName.substring( index + 1 );

                $this
                    .addClass( 'required error' )
                    .before( '<div class="ajaxerrors"><p>Please select ' + attributeTaxName + '</p></div>' )

                check = false;
            } else {
                item[attributeName] = attributevalue;
            }

        } );

        if ( !check ) {
            return false;
        }

        // AJAX add to cart request

        var $thisbutton = $( this );

        if ( $thisbutton.is( '.variations_form .single_add_to_cart_button' ) ) {

            $thisbutton.removeClass( 'added' );
            $thisbutton.addClass( 'loading' );

            var data = {
                action: 'woocommerce_add_to_cart_variable_rc',
                product_id: product_id,
                quantity: quantity,
                variation_id: var_id,
                variation: item
            };

            // Trigger event
            $( 'body' ).trigger( 'adding_to_cart', [ $thisbutton, data ] );

            // Ajax action
            $.post( wc_add_to_cart_params.ajax_url, data, function( response ) {

                if ( ! response )
                    return;

                var this_page = window.location.toString();

                this_page = this_page.replace( 'add-to-cart', 'added-to-cart' );

                if ( response.error && response.product_url ) {
                    window.location = response.product_url;
                    return;
                }

                if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {

                    window.location = wc_add_to_cart_params.cart_url;
                    return;

                } else {

                    $thisbutton.removeClass( 'loading' );

                    var fragments = response.fragments;
                    var cart_hash = response.cart_hash;

                    // Block fragments class
                    if ( fragments ) {
                        $.each( fragments, function( key ) {
                            $( key ).addClass( 'updating' );
                        });
                    }

                    // Block widgets and fragments
                    $( '.shop_table.cart, .updating, .cart_totals' ).fadeTo( '400', '0.6' ).block({
                        message: null,
                        overlayCSS: {
                            opacity: 0.6
                        }
                    });

                    // Changes button classes
                    $thisbutton.addClass( 'added' );

                    // View cart text
                    if ( ! wc_add_to_cart_params.is_cart && $thisbutton.parent().find( '.added_to_cart' ).size() === 0 ) {
                        $thisbutton.after( ' <a href="' + wc_add_to_cart_params.cart_url + '" class="added_to_cart wc-forward" title="' +
                            wc_add_to_cart_params.i18n_view_cart + '">' + wc_add_to_cart_params.i18n_view_cart + '</a>' );
                    }

                    // Replace fragments
                    if ( fragments ) {
                        $.each( fragments, function( key, value ) {
                            $( key ).replaceWith( value );
                        });
                    }

                    // Unblock
                    $( '.widget_shopping_cart, .updating' ).stop( true ).css( 'opacity', '1' ).unblock();

                    // Cart page elements
                    $( '.shop_table.cart' ).load( this_page + ' .shop_table.cart:eq(0) > *', function() {

                        $( '.shop_table.cart' ).stop( true ).css( 'opacity', '1' ).unblock();

                        $( document.body ).trigger( 'cart_page_refreshed' );
                    });

                    $( '.cart_totals' ).load( this_page + ' .cart_totals:eq(0) > *', function() {
                        $( '.cart_totals' ).stop( true ).css( 'opacity', '1' ).unblock();
                    });

                    // Trigger event so themes can refresh other areas
                    $( document.body ).trigger( 'added_to_cart', [ fragments, cart_hash, $thisbutton ] );
                }
            });

            return false;

        } else {
            return true;
        }

    });

    // Wishlist header counter
    $('body').on('click', '.add_to_wishlist', function () {
        if ($('#h-wishlist-count').length > 0) {
            var count = $('#h-wishlist-count').text();
            count++;
            $('#h-wishlist-count').text(count);
        }
    });


    // Sticky header
    if ($('.header-sticky').length > 0) {
        $(window).scroll(function () {
            var topbar = false;
            var topbar_ht = $('.site-header-before').height() + $('.site-header-after').height() + $('.header-middle').height();
            if (($('.site-header-before').length > 0 && $('.site-header-before').css('display') !== 'none') || ($('.site-header-after').length > 0 && $('.site-header-after').css('display') !== 'none') || ($('.header-middle').length > 0 && $('.header-middle').css('display') !== 'none')) {
                topbar = true;
            }
            if (topbar) {
                $('body').css('margin-top', '0px');
                if (topbar_ht < $(window).scrollTop()) {
                    $('.header-sticky .header-bottom').addClass('header_sticky');
                    $('.header-middle').css('margin-bottom', $('.header-sticky .header-bottom').outerHeight());
                } else {
                    $('.header-sticky .header-bottom').removeClass('header_sticky');
                    $('.header-middle').css('margin-bottom', '0px');
                }
            } else {
                $('.header-sticky .header-bottom').addClass('header_sticky');
                $('body').css('margin-top', $('.header-sticky .header-bottom').outerHeight());
            }
        });
    }

});




// AJAX add to cart (Simple product)
jQuery( function( $ ) {

    // wc_add_to_cart_params is required to continue, ensure the object exists
    if ( typeof wc_add_to_cart_params === 'undefined' )
        return false;

    // Ajax add to cart
    $( document ).on( 'click', '.prod-form-simple .single_add_to_cart_button', function(e) {

        e.preventDefault();

        var $thisbutton = $( this );
        var $simple_form = $( this ).closest( '.prod-form-simple' );

        var product_id = $thisbutton.val();
        var quantity = $simple_form.find( 'input[name=quantity]' ).val();


        $( '.ajaxerrors' ).remove();

        $thisbutton.removeClass( 'added' );
        $thisbutton.addClass( 'loading' );

        var data = {
            action: 'woocommerce_add_to_cart_variable_rc',
            product_id: product_id,
            quantity: quantity,
            variation_id: false,
            variation: false
        };

        // Trigger event
        $( 'body' ).trigger( 'adding_to_cart', [ $thisbutton, data ] );

        // Ajax action
        $.post( wc_add_to_cart_params.ajax_url, data, function( response ) {

            if ( ! response )
                return;

            var this_page = window.location.toString();

            this_page = this_page.replace( 'add-to-cart', 'added-to-cart' );

            if ( response.error && response.product_url ) {
                window.location = response.product_url;
                return;
            }

            if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {

                window.location = wc_add_to_cart_params.cart_url;
                return;

            } else {

                $thisbutton.removeClass( 'loading' );

                var fragments = response.fragments;
                var cart_hash = response.cart_hash;

                // Block fragments class
                if ( fragments ) {
                    $.each( fragments, function( key ) {
                        $( key ).addClass( 'updating' );
                    });
                }

                // Block widgets and fragments
                $( '.shop_table.cart, .updating, .cart_totals' ).fadeTo( '400', '0.6' ).block({
                    message: null,
                    overlayCSS: {
                        opacity: 0.6
                    }
                });

                // Changes button classes
                $thisbutton.addClass( 'added' );

                // View cart text
                if ( ! wc_add_to_cart_params.is_cart && $thisbutton.parent().find( '.added_to_cart' ).size() === 0 ) {
                    $thisbutton.after( ' <a href="' + wc_add_to_cart_params.cart_url + '" class="added_to_cart wc-forward" title="' +
                        wc_add_to_cart_params.i18n_view_cart + '">' + wc_add_to_cart_params.i18n_view_cart + '</a>' );
                }

                // Replace fragments
                if ( fragments ) {
                    $.each( fragments, function( key, value ) {
                        $( key ).replaceWith( value );
                    });
                }

                // Unblock
                $( '.widget_shopping_cart, .updating' ).stop( true ).css( 'opacity', '1' ).unblock();

                // Cart page elements
                $( '.shop_table.cart' ).load( this_page + ' .shop_table.cart:eq(0) > *', function() {

                    $( '.shop_table.cart' ).stop( true ).css( 'opacity', '1' ).unblock();

                    $( document.body ).trigger( 'cart_page_refreshed' );
                });

                $( '.cart_totals' ).load( this_page + ' .cart_totals:eq(0) > *', function() {
                    $( '.cart_totals' ).stop( true ).css( 'opacity', '1' ).unblock();
                });

                // Trigger event so themes can refresh other areas
                $( document.body ).trigger( 'added_to_cart', [ fragments, cart_hash, $thisbutton ] );
            }
        });

        return false;

    });

});

