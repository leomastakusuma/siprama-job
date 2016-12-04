/*---LEFT BAR ACCORDION----*/
$(function() {
    $('#nav-accordion').dcAccordion({
        eventType: 'click',
        autoClose: true,
        saveState: true,
        disableLink: true,
        speed: 'slow',
        showCount: false,
        autoExpand: true,
//        cookie: 'dcjq-accordion-1',
        classExpand: 'dcjq-current-parent'
    });
});

function htmlEncode(value){
  //create a in-memory div, set it's inner text(which jQuery automatically encodes)
  //then grab the encoded contents back out.  The div never exists on the page.
  return $('<div/>').text(value).html();
}

function htmlDecode(value){
  return $('<div/>').html(value).text();
}

//prevent doublequote
/*
$( "input" ).keyup(function() {
  var str = this.value;
    if (str.search(/"/g) !== -1) {
        alert("\"is not allowed");
        this.value=str.slice(0, -1);
    }
});
$( "textarea" ).keyup(function() {
  var str = this.value;
    if (str.search(/"/g) !== -1) {
        alert("\"is not allowed");
        this.value=str.slice(0, -1);
    }
});*/
/*$(function() {
    $('#nav-accordion2').dcAccordion({
        eventType: 'click',
        autoClose: true,
        saveState: true,
        disableLink: true,
        speed: 'slow',
        showCount: false,
        autoExpand: true,
//        cookie: 'dcjq-accordion-1',
        classExpand: 'dcjq-current-parent'
    });
});
$(function() {
    $('#nav-advert').dcAccordion({
        eventType: 'click',
        autoClose: true,
        saveState: true,
        disableLink: true,
        speed: 'slow',
        showCount: false,
        autoExpand: true,
//        cookie: 'dcjq-accordion-1',
        classExpand: 'dcjq-current-parent'
    });
});*/

var Script = function () {

//    sidebar dropdown menu auto scrolling

    jQuery('#sidebar .sub-menu > a').click(function () {
        var o = ($(this).offset());
        diff = 250 - o.top;
        if(diff>0)
            $("#sidebar").scrollTo("-="+Math.abs(diff),500);
        else
            $("#sidebar").scrollTo("+="+Math.abs(diff),500);
    });

//    sidebar dropdown menu channel auto scrolling

    jQuery('#menu-channel .sub-menu > a').click(function () {
        var o = ($(this).offset());
        diff = 250 - o.top;
        if(diff>0)
            $("#menu-channel ").scrollTo("-="+Math.abs(diff),500);
        else
            $("#menu-channel ").scrollTo("+="+Math.abs(diff),500);
    });

//    sidebar toggle

    $(function() {
        function responsiveView() {
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#container').addClass('sidebar-close');
                $('#sidebar > ul').hide();
            }

            if (wSize > 768) {
                $('#container').removeClass('sidebar-close');
                $('#sidebar > ul').show();
            }
        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);
    });

    $('.icon-reorder').click(function () {
        if ($('#sidebar > ul').is(":visible") === true) {
            $('#main-content').css({
                'margin-left': '0px'
            });
            $('#sidebar').css({
                'margin-left': '-210px'
            });
            $('#sidebar > ul').hide();
            $('#menu-channel').css({
                'margin-left': '-210px'
            });
            $('#menu-channel > ul').hide();
            $('#advert-channel').css({
                'margin-left': '-210px'
            });
            $('#advert-channel').removeClass('show');
            $('#menu-channel').removeClass('show');
            $('#adver-channel > ul').hide();
            
            $("#container").addClass("sidebar-closed");
        } else {
            $('#main-content').css({
                'margin-left': '210px'
            });
            $('#sidebar > ul').show();
            $('#sidebar').css({
                'margin-left': '0'
            });
            $('#menu-channel > ul').show();
            $('#menu-channel').css({
                'margin-left': '0'
            });
            $('#advert-channel > ul').show();
            $('#advert-channel').css({
                'margin-left': '0'
            });
            $("#container").removeClass("sidebar-closed");
        }
    });

// custom scrollbar
    $("#sidebar, #menu-channel, #advert-channel").niceScroll({styler:"fb",cursorcolor:"#e8403f", cursorwidth: '3', cursorborderradius: '10px', background: '#404040', spacebarenabled:false, cursorborder: ''});

    $("html").niceScroll({styler:"fb",cursorcolor:"#e8403f", cursorwidth: '6', cursorborderradius: '10px', background: '#404040', spacebarenabled:false,  cursorborder: '', zindex: '1000'});

// widget tools

    jQuery('.panel .tools .icon-chevron-down').click(function () {
        var el = jQuery(this).parents(".panel").children(".panel-body");
        if (jQuery(this).hasClass("icon-chevron-down")) {
            jQuery(this).removeClass("icon-chevron-down").addClass("icon-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("icon-chevron-up").addClass("icon-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.panel .tools .icon-remove').click(function () {
        jQuery(this).parents(".panel").parent().remove();
    });


//    tool tips

    $('.tooltips').tooltip();

//    popovers

    $('.popovers').popover();



// custom bar chart

    if ($(".custom-bar-chart")) {
        $(".bar").each(function () {
            var i = $(this).find(".value").html();
            $(this).find(".value").html("");
            $(this).find(".value").animate({
                height: i
            }, 2000)
        })
    }

// demo close footer notification
    $('#toPublish').on('click', function() {
        $(".notif-footer").addClass('show success');
        setTimeout(function() {
           $(".notif-footer").removeClass('show success');
       }, 1500);
    });
    $('#toUnPublish').on('click', function() {
        $(".notif-footer").addClass('show failed');
        setTimeout(function() {
           $(".notif-footer").removeClass('show failed');
       }, 1500);
    });
    $('.icon-remove').on('click', function() {
        $(".notif-footer").removeClass('show success failed');
    });

// show menu channel
    $(".showMenuChannel").on('click', function(){
        if ($('#menu-channel').hasClass('show')) {
            $('#menu-channel').removeClass('show');
        }else{
            $('#menu-channel').addClass('show');
        }
        $('#advert-channel').removeClass('show');
    });
    $('.close-menuChannel').on('click', function(){
        $('#menu-channel').removeClass('show');
        $('#advert-channel').removeClass('show');
    })
// show advert channel
    $(".showAdvertChannel").on('click', function(){
        if ($('#advert-channel').hasClass('show')) {
            $('#advert-channel').removeClass('show');
        }else{
            $('#advert-channel').addClass('show');
        }
            $('#menu-channel').removeClass('show');
    });
    $('.close-advertChannel').on('click', function(){
        $('#advert-channel').removeClass('show');
            $('#menu-channel').removeClass('show');
    })

}();

(function(d){d.fn.redirect=function(a,b,c){void 0!==c?(c=c.toUpperCase(),"GET"!=c&&(c="POST")):c="POST";if(void 0===b||!1==b)b=d().parse_url(a),a=b.url,b=b.params;var e=d("<form target='_blank'></form");e.attr("method",c);e.attr("action",a);for(var f in b)a=d("<input />"),a.attr("type","hidden"),a.attr("name",f),a.attr("value",b[f]),a.appendTo(e);d("body").append(e);e.submit()};d.fn.parse_url=function(a){if(-1==a.indexOf("?"))return{url:a,params:{}};var b=a.split("?"),a=b[0],c={},b=b[1].split("&"),e={},d;for(d in b){var g= b[d].split("=");e[g[0]]=g[1]}c.url=a;c.params=e;return c}})(jQuery);
(function(d){d.fn.redirect_pageself=function(a,b,c){void 0!==c?(c=c.toUpperCase(),"GET"!=c&&(c="POST")):c="POST";if(void 0===b||!1==b)b=d().parse_url(a),a=b.url,b=b.params;var e=d("<form></form");e.attr("method",c);e.attr("action",a);for(var f in b)a=d("<input />"),a.attr("type","hidden"),a.attr("name",f),a.attr("value",b[f]),a.appendTo(e);d("body").append(e);e.submit()};d.fn.parse_url=function(a){if(-1==a.indexOf("?"))return{url:a,params:{}};var b=a.split("?"),a=b[0],c={},b=b[1].split("&"),e={},d;for(d in b){var g= b[d].split("=");e[g[0]]=g[1]}c.url=a;c.params=e;return c}})(jQuery);