jQuery(document).ready(function() {
	 jQuery('#cementSlide, #plumbingSlide, #electricalsSlide').carousel({
         pause: true,
		interval: false
    });

     //Secondary Multi Select start
    jQuery(".dropdown-selection dt a").on('click', function() {
        jQuery(".dropdown-selection dd ul").slideToggle('fast');
    });
    jQuery(".dropdown-selection dd ul li a").on('click', function() {
        jQuery(".dropdown-selection dd ul").hide();
    });

    function getSelectedValue(id) {
        return jQuery("#" + id).find("dt a span.value").html();
    }
    jQuery(document).bind('click', function(e) {
        var clicked = jQuery(e.target);
        if (!clicked.parents().hasClass("dropdown-selection")) jQuery(".dropdown-selection dd ul").hide();
    });
    jQuery('.mutliSelect input[type="checkbox"]').on('click', function() {
        var selectedCount = jQuery(".mutliSelect [type='checkbox']:checked").length;
        var title = jQuery(this).closest('.mutliSelect').find('input[type="checkbox"]').data("val"),
            title = jQuery(this).data("val");
        //var resTitle = title.replace(/\s+/g, '-'); 
        if (jQuery(this).is(':checked')) {
            var html = '<span title="' + title + '">' + title + '</span>';
            jQuery('.multiSel').append(html);
            jQuery(".hida").hide();
        } else {
            jQuery('span[title="' + title + '"]').remove();
            if (!jQuery(".mutliSelect ul li input").is(':checked')) {
                jQuery('.dropdown-selection dt a .hida').show();
            }
        }
        if (!jQuery('#Customer').is(":checked")) {
            jQuery('span[title="Customer"]').remove();
            if (!jQuery(".mutliSelect ul li input").is(':checked')) {
                jQuery('.dropdown-selection dt a .hida').show();
                jQuery('#secondary_select').val('');
            }
        }
    });
    //Secondary Multi Select end
    jQuery(".m-source").parent().css("background", "#fff");
    jQuery(".m-source1").parent().css("background", "#f6f6f6");
    jQuery(".expertise").parent().addClass("customCode");
    jQuery(".fa-angle-up ").hide();
    jQuery('.lazyload').bind('appear', load);
    /*Navigation*/
    jQuery(".category-list,.category-list1").flexymenu({
        speed: 400,
        type: "vertical"
    });
    jQuery(".know_more_btn").click(function() {
        jQuery(".know_more input[type='text'], .know_more textarea").css("margin-top", "3px");
    });
    jQuery(".category-list li a.main-nav,.category-list1 li a.main-nav1").mouseout(function() {
        jQuery(this).children().children("img").trigger("onmouseout");
    })
    if (jQuery(window).width() <= 320 || jQuery(window).width() <= 767) {
        jQuery(".category-list > li.showhide span.icon").click(function() {
            jQuery(".category-list li:not('.showhide'),.coming-soon li,.google-block").toggleClass("show")
        });
    }

    function isTouchDevice() {
        return true == ("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch);
    }
    if (isTouchDevice() === true) {
        jQuery('.showhide1').on('click', function() {
            jQuery(".category-list1 li,.category-list1").toggleClass("show");
        });
        if (jQuery(window).width() <= 320 || jQuery(window).width() <= 767) {
            jQuery('.category-list li a.main-nav,.category-list1 li  a.main-nav1').click(function() {
                jQuery(this).find(".fa-angle-up, .fa-angle-down").toggle();
                if (jQuery(this).parent().siblings().children().children(".fa-angle-up").is(":visible") == true) {
                    jQuery(this).parent().siblings().children().children(".fa-angle-up").hide();
                    jQuery(this).parent().siblings().children().children(".fa-angle-down").show();
                }
                jQuery(this).children().children("img").trigger("onmouseover");
                jQuery(this).parent().children("ul").children("li").children("a").css("background", "#f6f6f6");
                jQuery(this).parent().children("ul").children("li:first-child").children("a").css("background", "#fff");
                jQuery(this).parent().children("ul").children("li:first-child").children("ul").show();
                jQuery(".category-list1 li#mainNav,.category-list1").addClass("show");
            });
            jQuery(".category-list.vertical li ul li a,.category-list1 li ul li a").mouseover(function() {
                var el = jQuery(this);
                var link = el.attr('href');
                window.location = link;
                jQuery(this).parent().parent().parent().children().children().children("img").trigger("onmouseover");
            });
        } else {
            jQuery('.category-list li a.main-nav,.category-list1 li  a.main-nav1').on('click touchend', function() {
                jQuery(this).children().children("img").trigger("onmouseover");
                jQuery(this).parent().children("ul").children("li").children("a").css("background", "#f6f6f6");
                jQuery(this).parent().children("ul").children("li:first-child").children("a").css("background", "#fff");
                jQuery(this).parent().children("ul").children("li:first-child").children("ul").show();
                jQuery(".category-list1 li#mainNav,.category-list1").addClass("show");
            });
            jQuery(".category-list.vertical li ul,.category-list1 li ul").mouseover(function() {
                jQuery(this).parent().children().children().children().trigger("onmouseover");
            });
		  jQuery(".category-list > li > ul > li,.category-list1 > li > ul > li").hover(function() {
			jQuery(this).children("a").css("background", "#fff")
			jQuery(this).siblings().children("a").css("background", "#f6f6f6");
			jQuery(this).siblings("li:first-child").children(".brand-list").hide()
		});

        }
    } else {
        jQuery(".category-list li a.main-nav,.category-list1 li a.main-nav1").mouseover(function() {
            jQuery(this).children().children("img").trigger("onmouseover");
            jQuery(this).parent().children("ul").children("li:first-child").children("ul").show();
            jQuery(this).parent().children("ul").children("li").children("a").css("background", "#f6f6f6");
            jQuery(this).parent().children("ul").children("li:first-child").children("a").css("background", "#fff");
        });
        jQuery(".category-list1").mouseout(function() {
            jQuery(".category-list1 li,.category-list1").removeClass("show")
        });
        jQuery(".category-list1,#subNavLevel1,#subNavLevel2,#showhide1").mouseover(function() {
            jQuery(".category-list1 li#mainNav,.category-list1").addClass("show");
        });
        jQuery(".category-list.vertical li ul,.category-list1 li ul").mouseover(function() {
            jQuery(this).parent().children().children().children().trigger("onmouseover");		
			jQuery(this).children("li:first-child").children("ul").show();
			/*if(jQuery(this).children("li:first-child").children("a").css("background-color") == 	"rgb(246, 246, 246)"	){
				jQuery(this).children("li:first-child").children("a").css("background", "#fff");
			}*/
        });
		jQuery(".brand-list").mouseout(function() {
			if(jQuery(".category-list.vertical li ul").children("li:first-child").children("ul").css("display") == "block"){
			jQuery(this).siblings("li:first-child").children("a").css("background", "#fff");
			}
		});
		jQuery(".category-list > li > ul > li,.category-list1 > li > ul > li").mouseout(function() {
			jQuery(this).children("a").css("background", "#f6f6f6");
			jQuery(this).siblings("li:first-child").children("a").css("background", "#fff");
		});
		jQuery(".category-list > li > ul > li,.category-list1 > li > ul > li").mouseover(function() {
			jQuery(this).children("a").css("background", "#fff")
			jQuery(this).siblings().children("a").css("background", "#f6f6f6");		
		});
    }
	
		
    jQuery(".category-list.vertical li ul,.category-list1 li ul").mouseout(function() {
        jQuery(this).parent().children().children().children().trigger("onmouseout");
    });
    jQuery("#mainLogo a").mouseenter(function() {
        jQuery(".category-list1 li,.category-list1").removeClass("show")
    });
   
	 
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 100) {
            if (jQuery(window).width() >= 768) {
                jQuery(".cms-index-index  #inner_scroll_menu").css("visibility", "visible");
            }
            jQuery('.lnkScrollUp').fadeIn();
        } else {
            jQuery('.lnkScrollUp').fadeOut();
            if (jQuery(window).width() >= 768) {
                jQuery(".cms-index-index  #inner_scroll_menu").css("visibility", "hidden");
            }
        }
    });
    jQuery(".side-bar-filter").each(function() {
        if (jQuery(this).height() >= 300) {
            jQuery(this).css("height", "300px");
        }
    });
    if (jQuery(window).width() <= 320 || jQuery(window).width() <= 767) {
        jQuery(function() {
            jQuery(".product-name a").each(function(i) {
                len = jQuery(this).text().trim().length;
                if (len >= 47) {
                    jQuery(this).text(jQuery(this).text().trim().substr(0, 47) + '...');
                }
            });
        });
    } else if (jQuery(window).width() <= 1050) {
        jQuery(function() {
            jQuery(".product-name a").each(function(i) {
                len = jQuery(this).text().trim().length;
                if (len >= 40) {
                    jQuery(this).text(jQuery(this).text().trim().substr(0, 40) + '...');
                }
            });
        });
    } else {
        jQuery(function() {
            jQuery(".product-name a").each(function(i) {
                len = jQuery(this).text().trim().length;
                if (len >= 54) {
                    jQuery(this).text(jQuery(this).text().trim().substr(0, 52) + '...');
                }
            });
        });
    }
    jQuery('.lnkScrollUp').click(function() {
        jQuery("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
    jQuery('#myCarousel1, #myCarousel2, #myCarousel3').carousel({
        interval: 100000
    });
    jQuery("#products_2 a").addClass("products_change");
    jQuery("#products_1").on("click", function() {
        jQuery("#products_1 a").addClass("products_change");
        jQuery("[id^='products'] a").addClass("products_inactive");
        jQuery("#products_1 a").removeClass("products_inactive");
        jQuery("#myCarousel2,#myCarousel3").hide();
        jQuery("#myCarousel,#products_lists_1").css("display", "block");
    });
    jQuery("#products_2").on("click", function() {
        jQuery("#products_2 a").addClass("products_change");
        jQuery("[id^='products'] a").addClass("products_inactive");
        jQuery("#products_2 a").removeClass("products_inactive");
        jQuery("#myCarousel,#myCarousel3").hide();
        jQuery("#myCarousel2,#products_lists_2").css("display", "block");
    });
    jQuery("#products_3").on("click", function() {
        jQuery("#products_3 a").addClass("products_change");
        jQuery("[id^='products'] a").addClass("products_inactive");
        jQuery("#products_3 a").removeClass("products_inactive");
        jQuery("#myCarousel,#myCarousel2").hide();
        jQuery("#myCarousel3,#products_lists_3").css("display", "block");
    });
    jQuery('#drop_down').change(function() {
        var selectText = jQuery(this).val();
        if (selectText == "products_lists_1") {
            jQuery("#products_lists_1,#myCarousel").show();
            jQuery("#products_lists_2,#products_lists_3,#myCarousel3,#myCarousel2").hide();
        } else if (selectText == "products_lists_2") {
            jQuery("#products_lists_2,#myCarousel2").show();
            jQuery("#products_lists_1,#products_lists_3,#myCarousel,#myCarousel3").hide();
        } else if (selectText == "products_lists_3") {
            jQuery("#products_lists_3,#myCarousel3").show();
            jQuery("#products_lists_2,#products_lists_1,#myCarousel,#myCarousel2").hide();
        }
    });
    var owl1 = jQuery('#heroSlider');
    owl1.owlCarousel({
        loop: true,
        items: 1,
        nav: true,
        autoplay: true,
        autoplaySpeed: 1000,
        smartSpeed: 4000,
        navText: ['<a class="left carousel-control transparent-arrow" href="#" role="button" data-slide="prev"> <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> <span class="sr-only">Previous</span></a>', ' <a class="right carousel-control transparent-arrow" href="#" role="button" data-slide="next"> <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>'],
    });
    var owl = jQuery("#owl-demo");
    owl.owlCarousel({
        // Define custom and unlimited items depending from the width
        // If this option is set, itemsDeskop, itemsDesktopSmall, itemsTablet, itemsMobile etc. are disabled
        // For better preview, order the arrays by screen size, but it's not mandatory
        // Don't forget to include the lowest available screen size, otherwise it will take the default one for screens lower than lowest available.
        // In the example there is dimension with 0 with which cover screens between 0 and 450px
        nav: false,
        loop: true,
        items: 6,
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: false,
    });
    jQuery('#js-main-slider').pogoSlider({
        autoplay: true,
        autoplayTimeout: 5000,
        displayProgess: true,
        preserveTargetSize: true,
        targetWidth: 1000,
        targetHeight: 300,
        responsive: true
    }).data('plugin_pogoSlider');
    var transitionDemoOpts = {
        displayProgess: false,
        generateNav: false,
        generateButtons: false,
        pauseOnHover: false
    }
    jQuery('#demo1').pogoSlider(transitionDemoOpts);
    jQuery('#demo2').pogoSlider(transitionDemoOpts);
    jQuery('#demo3').pogoSlider(transitionDemoOpts);
    jQuery('#demo4').pogoSlider(transitionDemoOpts);
    jQuery('#demo5').pogoSlider(transitionDemoOpts);
    jQuery('#demo6').pogoSlider(transitionDemoOpts);
    jQuery('#demo7').pogoSlider(transitionDemoOpts);
    jQuery('#demo8').pogoSlider(transitionDemoOpts);
    jQuery('#demo9').pogoSlider(transitionDemoOpts);
    jQuery('#demo10').pogoSlider(transitionDemoOpts);
    jQuery('#demo11').pogoSlider(transitionDemoOpts);
    jQuery('#demo12').pogoSlider(transitionDemoOpts);
});
/*Navigation End*/
/*Sub Section*/
jQuery(function() {
    var jQueryupper = jQuery('#upper');
    jQuery('#images').refineSlide({
        transition: 'fade',
        onInit: function() {
            var slider = this.slider,
                jQuerytriggers = jQuery('.translist').find('> li > a');
            jQuerytriggers.parent().find('a[href="#_' + this.slider.settings['transition'] + '"]').addClass('active');
            jQuerytriggers.on('click', function(e) {
                e.preventDefault();
                if (!jQuery(this).find('.unsupported').length) {
                    jQuerytriggers.removeClass('active');
                    jQuery(this).addClass('active');
                    slider.settings['transition'] = jQuery(this).attr('href').replace('#_', '');
                }
            });

            function support(result, bobble) {
                var phrase = '';
                if (!result) {
                    phrase = ' not';
                    jQueryupper.find('div.bobble-' + bobble).addClass('unsupported');
                    jQueryupper.find('div.bobble-js.bobble-css.unsupported').removeClass('bobble-css unsupported').text('JS');
                }
            }
            support(this.slider.cssTransforms3d, '3d');
            support(this.slider.cssTransitions, 'css');
        }
    });
    jQuery(".btn-toggle").click(function() {
        jQuery(this).parent().next().collapse('toggle');
    });
});

function load() {
    var element = jQuery(this);
    var comment = element.contents().filter(function() {
        return this.nodeType === 8;
    }).get(0);
    var newElement = jQuery(comment && comment.data);
    element.replaceWith(newElement);
    newElement.fadeOut(0, function() {
        newElement.fadeIn(1000);
    });
}
jQuery(function() {
    var jQueryels = jQuery('div.quote'),
        i = 0,
        len = jQueryels.length;
    jQueryels.slice(1).hide();
    setInterval(function() {
        jQueryels.eq(i).fadeOut(function() {
            i = (i + 1) % len
            jQueryels.eq(i).fadeIn();
        })
    }, 10000)
});
jQuery(function() {
    var jQueryels = jQuery('div.quote1'),
        i = 0,
        len = jQueryels.length;
    jQueryels.slice(1).hide();
    setInterval(function() {
        jQueryels.eq(i).fadeOut(function() {
            i = (i + 1) % len
            jQueryels.eq(i).fadeIn();
        })
    }, 10000)
});

function center(number) {
    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for (var i in sync2visible) {
        if (num === sync2visible[i]) {
            var found = true;
        }
    }
    if (found === false) {
        if (num > sync2visible[sync2visible.length - 1]) {
            sync2.trigger("owl.goTo", num - sync2visible.length + 2)
        } else {
            if (num - 1 === -1) {
                num = 0;
            }
            sync2.trigger("owl.goTo", num);
        }
    } else if (num === sync2visible[sync2visible.length - 1]) {
        sync2.trigger("owl.goTo", sync2visible[1])
    } else if (num === sync2visible[0]) {
        sync2.trigger("owl.goTo", num - 1)
    }
}

function syncPosition(el) {
        var current = this.currentItem;
        jQuery("#sync2").find(".owl-item").removeClass("synced").eq(current).addClass("synced")
        if (jQuery("#sync2").data("owlCarousel") !== undefined) {
            center(current)
        }
    }
    /*Sub Section Ends Here*/
jQuery(document).ready(function() {
    jQuery('.boxgrid.captionfull').hover(function() {
        jQuery(".cover", this).stop().animate({
            top: '0px'
        }, {
            queue: false,
            duration: 160
        });
    }, function() {
        jQuery(".cover", this).stop().animate({
            top: '200px'
        }, {
            queue: false,
            duration: 160
        });
    });
});
var text = ["Make sure you buy binding wires with steel rods.", "Green Buildings: Use recyclable material, increase longevity & sustenance.", "Off-white color paint is most used. Reflects more light & makes the room look larger.", "To enhance creativity, ensure children's rooms are colorfully painted.", "Cracks on the wall occur when concrete shrinks. Pack concrete carefully!", "A typical house uses standard size fans which are 49 to 55 inches in diameter.", "Plan the space for an air conditioner at the time of planning itself.", "Plan interiors for kitchen in advance. You can't bring water taps and new switches in the last minute.", "Keep the minimum size of your bathroom to 5' x 8'. You spend at-least an hour in it everyday.", "Make sure to have sunlight into your kitchen. It kills bad bacteria.", "Use mirrors in your bedroom to get spacious look. They are economical.", "Check for shadow when you buy light fittings.", "As per Feng Shui, have an inward opening door as it is welcoming.", "Keep standard sizes for doors & windows. Easy to buy & install.", "Do the porosity and compressive strength test on bricks.", "Light Dimmers: Use them to vary light intensity", "Rubber flooring is child friendly, try it. Your children will like it.", "More apartments are using artificial grass. Easy to maintain.", "Rubber floor is sound proof. Use it to prevent noise pollution.", "Unclutter the kitchen for improved hygeine.", "Coarse aggregates are nothing but stones.", "Modular switches are child friendly, install them for a worry free life.", "Wires: Once a house is built, you can't change. Buy wisely.", "Wires: Ask for bill. Bill ensures warranty!"]
var counter = 0;
var elem = document.getElementById("changeText");
setInterval(change, 6000);

function change() {
        if (elem != "undefined" && elem != null) {
            elem.textContent = text[counter];
            counter++;
            if (counter >= text.length) {
                counter = 0;
            }
        }
    }
    /* for home page popup keypad of mobile START */
function detectmob() {
    if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
        return true;
    } else {
        return false;
    }
}
if (detectmob()) {
    jQuery('input.hmpopupinput').focus(function() {
        //alert("hghghg");
        jQuery('.homepagepopup .modal').css('position', 'relative');
    });
}
/* for home page popup keypad of mobile END */
/*Checkout Calculation */
function checkTheSelectedPaymentOption(ctrl) {
    jQuery("#p_method_" + ctrl).prop("checked", true);
    var charge = jQuery("#tab_payment" + ctrl).attr('charge');
    var subtot = jQuery("#tab_payment" + ctrl).attr('subtotal');
    var gtot = jQuery("#tab_payment" + ctrl).attr('gtotal');
    var selected_charge = jQuery("#tab_payment" + ctrl).attr('selectedmet');
    //var total_charge = (parseFloat(charge) + parseFloat(subtot)).toFixed(2);
    var total_charge = (Math.floor((parseFloat(charge) + parseFloat(subtot)) * 100)/100).toFixed(2);
    var gtotal_charge = (parseFloat(charge) + parseFloat(gtot)).toFixed(2);
    var gtotal_charge = (parseFloat(gtotal_charge) - parseFloat(selected_charge)).toFixed(2);
    //alert(gtot+'--'+charge);
    jQuery('#pay_charge').text('₹' + total_charge);
    jQuery('#gtotal').text('₹' + gtotal_charge);
	jQuery('#cheque_total_amount').text('₹' + gtotal_charge);
	
	
	if(ctrl == "cashin")
	{
	var cashmintotal = jQuery("#tab_payment" + ctrl).attr('cashmintotal');
	if(parseInt(gtotal_charge) >= parseInt(cashmintotal))
	{
		jQuery("#pan_block").show();
		jQuery("#payment_submit").attr("disable", false);
		jQuery("#payment_submit").bind('click');
		jQuery("#payment_submit").css({"opacity":"1"});
	}
	else
	{
		jQuery("#pan_block").hide();
		jQuery("#payment_submit").attr("disable", true);
		jQuery("#payment_submit").unbind('click');
		jQuery("#payment_submit").css({"opacity":"0.3"});
	}	
    }	
	
	
	
}

function loader(ctrl) {
    var dataForm = new VarienForm('co-payment-form', true);
    if (ctrl == "hdfc_standard" || ctrl == "neft" || ctrl == "hdfcdc_standard" || ctrl == "hdfcnb_standard" || ctrl == "cashin_checkout" || ctrl == "cashondelivery" || ctrl == "cheque" || ctrl == "payucheckout_shared") {
        jQuery("#edit_payment,#tick_payment").removeClass("edit_icon_hide");
    }
    if (dataForm.validator.validate()) {
        jQuery('.loader-pay' + ctrl).show();
        //fail pass validation
    }
}