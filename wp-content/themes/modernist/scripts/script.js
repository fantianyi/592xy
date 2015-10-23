(function($) {
	
	$(window).load(function(){
		$("#ajax_wrap").hide();
		$("#ajax_loader").hide();
	    
	});


	
	$(document).ready(function () {
	    
	    var contentButton = [];
	    var contentTop = [];
	    var content = [];
	    var lastScrollTop = 0;
	    var scrollDir = '';
	    var itemClass = '';
	    var itemHover = '';
	    var menuSize = null;
	    var stickyHeight = 0;
	    var stickyMarginB = 0;
	    var currentMarginT = 0;
	    var topMargin = 0;
	    $(window).scroll(function (event) {
	        var st = $(this).scrollTop();
	        if (st > lastScrollTop) {
	            scrollDir = 'down';
	        } else {
	            scrollDir = 'up';
	        }
	        lastScrollTop = st;
	    });
	    $.fn.stickUp = function (options) {
	        // adding a class to users div
	        $(this).addClass('stuckMenu');
	        //getting options
	        var objn = 0;
	        if (options != null) {
	            for (var o in options.parts) {
	                if (options.parts.hasOwnProperty(o)) {
	                    content[objn] = options.parts[objn];
	                    objn++;
	                }
	            }
	            if (objn == 0) {
	                console.log('error:needs arguments');
	            }

	            itemClass = options.itemClass;
	            itemHover = options.itemHover;
	            if (options.topMargin != null) {
	                if (options.topMargin == 'auto') {
	                    topMargin = parseInt($('.stuckMenu').css('margin-top'));
	                } else {
	                    if (isNaN(options.topMargin) && options.topMargin.search("px") > 0) {
	                        topMargin = parseInt(options.topMargin.replace("px", ""));
	                    } else if (!isNaN(parseInt(options.topMargin))) {
	                        topMargin = parseInt(options.topMargin);
	                    } else {
	                        console.log("incorrect argument, ignored.");
	                        topMargin = 0;
	                    }
	                }
	            } else {
	                topMargin = 0;
	            }
	            menuSize = $('.' + itemClass).size();
	        }
	        stickyHeight = parseInt($(this).height());
	        stickyMarginB = parseInt($(this).css('margin-bottom'));
	        currentMarginT = parseInt($(this).next().closest('div').css('margin-top'));
	        vartop = parseInt($(this).offset().top);
	        //$(this).find('*').removeClass(itemHover);
	    }
	    $(document).on('scroll', function () {
	        varscroll = parseInt($(document).scrollTop());
	        if (menuSize != null) {
	            for (var i = 0; i < menuSize; i++) {
	                contentTop[i] = $('#' + content[i] + '').offset().top;
	                function bottomView(i) {
	                    contentView = $('#' + content[i] + '').height() * .4;
	                    testView = contentTop[i] - contentView;
	                    //console.log(varscroll);
	                    if (varscroll > testView) {
	                        $('.' + itemClass).removeClass(itemHover);
	                        $('.' + itemClass + ':eq(' + i + ')').addClass(itemHover);
	                    } else if (varscroll < 50) {
	                        $('.' + itemClass).removeClass(itemHover);
	                        $('.' + itemClass + ':eq(0)').addClass(itemHover);
	                    }
	                }
	                if (scrollDir == 'down' && varscroll > contentTop[i] - 50 && varscroll < contentTop[i] + 50) {
	                    $('.' + itemClass).removeClass(itemHover);
	                    $('.' + itemClass + ':eq(' + i + ')').addClass(itemHover);
	                }
	                if (scrollDir == 'up') {
	                    bottomView(i);
	                }
	            }
	        }



	        if (vartop < varscroll + topMargin) {
	            $('.stuckMenu').addClass('isStuck');
	            $('.stuckMenu').next().closest('div').css({
	                'margin-top': stickyHeight + stickyMarginB + currentMarginT + 'px'
	            }, 10);
	            $('.stuckMenu').css("position", "fixed");
	            $('.isStuck').css({
	                top: '0px'
	            }, 10, function () {

	            });
	        };

	        if (varscroll + topMargin < vartop) {
	            $('.stuckMenu').removeClass('isStuck');
	            $('.stuckMenu').next().closest('div').css({
	                'margin-top': currentMarginT + 'px'
	            }, 10);
	            $('.stuckMenu').css("position", "relative");
	        };

	    });

	    //alert(1);
	    //enabling stickUp on the '.navbar-wrapper' class
	    $('.top-nav').stickUp({
	        //enabling marginTop with the 'auto' setting 
	        marginTop: 'auto'
	    });

		$("div.blog_post_page").live({
			mouseenter:function(){
				$(this).find(".blog_title").stop(true,true).fadeOut("fast");
				$(this).find(".blog_post_content").stop(true,true).fadeIn("fast");
			},
			mouseleave:function(){
				$(this).find(".blog_post_content").stop(true,true).fadeOut("fast");
				$(this).find(".blog_title").stop(true,true).fadeIn("fast");
			}
		});
		
		if(!Modernizr.csstransitions) { // Test if CSS transitions are supported
	            $(function() {
	                $('.project').hover(function() {
	                    $(this).find(".project_box_info").stop(true, true).animate({opacity: 1}, 300);
	                }, function() {
	                    $(this).find(".project_box_info").stop(true, true).animate({opacity: 0}, 300);
	                });
	            });
	        } else	{
	        	$(".project_box_info").addClass("fade_box");
	        }

	        $(".filter_item").children("a").hide();

	        $(".filter_main_element a").click(function(e) {
	        	e.preventDefault();

	        	$(".filter_item").children("a").stop(true, true).slideToggle(200);

	        });
		
		$(".wid_content ul li").live({
			mouseenter:function(){
				$(this).find(".proj_info").stop(true,true).fadeIn("fast");
			},
			mouseleave:function(){
				$(this).find(".proj_info").stop(true,true).fadeOut("fast");
			}
		});
		
		if (!$.browser.webkit) {
			$('.post_content').jScrollPane();
			$('.comments_field').jScrollPane();
		}
		
		/*Comments*/
		$(".comment_content > .button").click( function(e) {
			e.preventDefault();
			$(this).parent().siblings(".reply_form").slideToggle();
		});
		
		$(".reply_form").each(function(){
			var parentcomment = $(this).data("parent");
			$(this).find("input:hidden#comment_parent").val(parentcomment);
		});
		/*Comments*/
		/*Social Buttons*/
		$("a.fb").live("click",function(e){
			e.preventDefault();
			var url = $(this).attr("href");
			window.open ("http://www.facebook.com/share.php?u="+url, "Facebook_Share","menubar=1,resizable=1,width=900,height=500");
			return false;		
		});
		
		$("a.tw").live("click",function(e){
			e.preventDefault();
			var url = $(this).attr("href");
			window.open ("https://twitter.com/share?url="+url, "Tweet","menubar=1,resizable=1,width=900,height=500");
			return false;		
		});
		
		$("a.pin").live("click",function(e){
			e.preventDefault();
			var url = $(this).attr("href");
			var media = $(this).data("media");
			window.open ("http://pinterest.com/pin/create/bookmarklet/?url="+encodeURIComponent(url)+"&is_video=false&media="+media, "Pinterest +","menubar=1,resizable=1,width=900,height=500");
			return false;		
		});
		/*Social Buttons*/
		
		/*Form Validation*/
		$("form.contact_form").submit(function(){
			var name = $(this).find("[name='name']");
			var email = $(this).find("[name='email']");
			var tel = $(this).find("[name='mob']");
			var message = $(this).find("[name='message']");
			var url = $(this).attr("action");
			var returnstate = true;
			if(name.val() == ''){
				name.addClass("error");
				returnstate = false;
			}
			if(email.val() == '' || !validateEmail(email.val())){
				email.addClass("error");
				returnstate = false;
			}
			if(message.val() == ''){
				message.addClass("error");
				returnstate = false;
			}
			if(returnstate){
				$.post(url,{u_name:name.val(),u_email:email.val(),u_tel:tel.val(),u_message:message.val()},function(data){
					$("form.contact_form").hide();
					$("div.message_success").fadeIn("fast");
				});
			}
			return false;
		});
		
		$("input,textarea").click(function(){
			$(this).removeClass("error");
		});
		
		$("a.reset").live("click",function(e){
			e.preventDefault();
			$("form.contact_form").find("input:text,textarea").val("");
		});
		/*Form Validation*/
		
		/*Accordion*/
		
		$('.page_accordion').liteAccordion({
			containerWidth : 1260,
			containerHeight : 307,
			headerWidth : 114,
			responsive : true,
			minContainerWidth : 280,
        	maxContainerWidth : 1260
		});
	
		/*Accordion*/
		
		/*Projects Slider
		var counter = 0;
		var duration = 300;
		var boxes = null;
		if($("div.projects_box").eq(0).find("div.project:visible").length >= $("div.projects_box").eq(1).find("div.project:visible").length){
			boxes = $("div.projects_box").eq(0).find("div.project");
		}
		else{
			boxes = $("div.projects_box").eq(1).find("div.project");
		}
		$("a.pr_next").live("click",function(e){
			e.preventDefault();
			if(boxes.length > 4){
				if(counter <= boxes.length-2){
					var nextbox = boxes.eq(++counter);
					$(".project_holder").stop().scrollTo( nextbox , duration ,{axis:"x"});
				}
				else{
					counter = 0;
					var nextbox = boxes.eq(++counter);
					$(".project_holder").stop().scrollTo( nextbox , duration ,{axis:"x"});
				}
			}
		});
		
		$("a.pr_prev").live("click",function(e){
			e.preventDefault();
			if(boxes.length > 4){
				if(counter > 1){
					var nextbox = boxes.eq(--counter);
					$(".project_holder").stop().scrollTo( nextbox , duration ,{axis:"x"});
				}else{
					counter = boxes.length-1;
					var nextbox = boxes.eq(counter);
					$(".project_holder").stop().scrollTo( nextbox , duration ,{axis:"x"});
				}
			}
		});
		Projects Slider*/
		
		/*Testimonials*/
		var testimonials = $(".testimonial_box");
		var counter1 = 0;
		window.setTimeout(function(){
			slideTestimonials();
		},1000);
		
		function slideTestimonials(){
			testimonials.eq(counter1).fadeOut("normal",function(){
				window.setTimeout(function(){
					counter1++;
					if(testimonials.eq(counter1).length){
						testimonials.eq(counter1).fadeIn("normal");
					}else{
						testimonials.eq(0).fadeIn("normal");
						counter1 = 0;
					}
					window.setTimeout(function(){
						slideTestimonials();
					},8000);
				},40);
			});
		}
		/*Testimonials*/
		
		/*Projects Slider*/
		$("a.pro_next").live("click",function(e){
			e.preventDefault();
			var currentPic = $(".project_img_slider ul li:visible");
			var nextPic = $(".project_img_slider ul li:visible").next();
			if(!nextPic.length){
				nextPic = $(".project_img_slider ul li:first");
			}
			currentPic.fadeOut("slow");
			nextPic.fadeIn("slow");
		});
		
		$("a.pro_prev").live("click",function(e){
			e.preventDefault();
			var currentPic = $(".project_img_slider ul li:visible");
			var nextPic = $(".project_img_slider ul li:visible").prev();
			if(!nextPic.length){
				nextPic = $(".project_img_slider ul li:last");
			}
			currentPic.fadeOut("slow");
			nextPic.fadeIn("slow");
		});
		
		/*Filter*/
		$("a.filter").click(function(e){
			e.preventDefault();
			var category = $(this).attr("href");
			if(category == "all"){
				$("div.project").fadeIn("fast");
				return false;
			}
			var projects = $("div.project");
			projects.fadeIn("fast");
			projects.each(function(){
				var current_project = $(this);
				var categories = String(current_project.data("categories"));
				if(categories){
					categories = categories.split(",");
					console.log(jQuery.inArray(category,categories));
					if(jQuery.inArray(category,categories) == -1){
						current_project.fadeOut("fast");
						//console.log(current_project.get(0));
					}
				}else{
					current_project.fadeOut("fast");
				}
			});
		});
		/*Filter*/
		
		/*Short Codes*/
		var allPanels = $('.accordion > ul > li > div').hide();
	
		$('.accordion li:first-child > div').show().addClass('active');
		$('.accordion li:first-child > h4 a span').addClass('selected_accordion');

		$('.accordion h4 a').live("click",function(e) {
			e.preventDefault();
			$this = $(this);
			$target =  $this.parent().next();

			if(!$target.hasClass('active')){
				$('.active').slideUp(500).removeClass("active").siblings("h4").find("a > span").removeClass("selected_accordion");
				$this.parent().siblings("div").slideDown(500).addClass("active");
				$(this).find("span").addClass("selected_accordion");
			} else {
				$this.parent().siblings("div").slideUp(500).removeClass("active");
				$(this).find("span").removeClass("selected_accordion");
			}
		  
			return false;
		});


		$("div.tab_buttons ul li a").live("click",function(e){
			e.preventDefault();
			if($(this).hasClass("selected_tab"))
				return false;
			var parent = $(this).parent().parent().parent().parent();
			var index = $(this).parent().index();
			var thiselement = $(this);
			parent.find("a.selected_tab").removeClass("selected_tab");
			parent.find(".tab_content:visible").stop(true,true).fadeOut("fast",function(){
				parent.find(".tab_content").eq(index).stop(true,true).fadeIn("fast");
			});
			thiselement.addClass("selected_tab");
		});
		
		$("div.tabs").each(function(){
			var thistab = $(this);
			/*thistab.find(".tab_content").each(function(){
				//var title = $(this).data("title");
				//thistab.find(".tab_buttons ul").append('<li><a href="#">'+title+'</a></li>');
			});*/
			for(var i = 0 ; i < thistab.find(".tab_content").length ; i++){
				var title = thistab.find(".tab_content").eq(i).data("title");
				thistab.find(".tab_buttons ul").append('<li><a href="#">'+title+'</a></li>');
			}
			thistab.find(".tab_content").eq(0).addClass("selected_tab_content");
			thistab.find(".tab_buttons ul li a").eq(0).addClass("selected_tab");
		});
		/*Short Codes*/

		$("#comment").attr('placeholder', "你的评论写在这里......");

		/*$(this).children("li").children("a").stop(true, true).slideDown(300).css("display", "block");*/
		 $(".mobile_navigation").click(function (e) {
		 	e.preventDefault();
	        $(this).children("li").children("a").stop(true, true).slideToggle(300).css("display","block");
	     });

	       	$("a.h_next").live("click",function(e){
				e.preventDefault();
				var currentPic = $(".home_slider ul li:visible");
				var nextPic = $(".home_slider ul li:visible").next();
				if(!nextPic.length){
					nextPic = $(".home_slider ul li:first");
				}
				currentPic.stop(true,true).fadeOut("slow");
				nextPic.stop(true,true).fadeIn("slow");
			});
			
			$("a.h_prev").live("click",function(e){
				e.preventDefault();
				var currentPic = $(".home_slider ul li:visible");
				var nextPic = $(".home_slider ul li:visible").prev();
				if(!nextPic.length){
					nextPic = $(".home_slider ul li:last");
				}
				currentPic.stop(true,true).fadeOut("slow");
				nextPic.stop(true,true).fadeIn("slow");
			});

	});

})( jQuery );

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}



function createQrCode(link) {
    if (!link) { return; }
    var $qrCode = jQuery("#qrCode");
    if ($qrCode.size() <= 0) {
        jQuery("body").append('<div id="qrCode"><a href="javascript:;" class="qrcode" title="'+link+'"></a></div>');
        $qrCode = jQuery("#qrCode");
    };
    $qrCode.show().find(".qrcode").qrcode({
        width: 200,
        height: 200,
        text: link
    });
    $qrCode.one("click", function () {
        $qrCode.remove();
    });
}