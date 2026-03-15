$(document).ready(function() {
	$("li.style a").on("click",function() {
		$('.loader').fadeIn(0).html('<span>LOADING...</span>').delay(3000).fadeOut(500);
	});
});
$(function() {
	var pull 		= $('#pull');
	menu 		= $('.nav');
	menuHeight	= menu.height();

	$(pull).on('click', function(e) {
		e.preventDefault();
		menu.slideToggle();
	});
});
/*Load Thumbs*/
;(function($) {
  $.fn.arena = function(threshold, callback) {
	   var $w = $(window),
        th = threshold || 0,
        retina = window.devicePixelRatio > 1,
        attrib = retina? "data-src-retina" : "data-src",
        images = this,
        loaded;
    this.one("arena", function() {
      var source = this.getAttribute(attrib);
      source = source || this.getAttribute("data-src");
      if (source) {
        this.setAttribute("src", source);
        if (typeof callback === "function") callback.call(this);
      }
    });
    function arena() {
      var inview = images.filter(function() {
        var $e = $(this);
        if ($e.is(":hidden")) return;

        var wt = $w.scrollTop(),
            wb = wt + $w.height(),
            et = $e.offset().top,
            eb = et + $e.height();

        return eb >= wt - th && et <= wb + th;
      });
      loaded = inview.trigger("arena");
      images = images.not(loaded);
    }
    //$w.scroll(arena);
    $w.trigger("scroll", arena);
    //$w.resize(arena);
    $w.trigger("resize", arena);
    arena();
    return this;
  };
})(window.jQuery || window.Zepto);
/*$(document).ready(function(){
	$(".video_list li").on('mouseenter',function() {
		$(this).find("img").not(this).stop().fadeTo(150,0.9);
		$(this).find("span").not(this).stop().animate({height:0},150);
		$(this).find("i").not(this).stop().fadeIn(150);
	}).on('mouseleave',function() {
		$(this).find("img").not(this).stop().fadeTo(150,1.0);
		$(this).find("span").not(this).stop().animate({height:22},150);
		$(this).find("i").not(this).stop().fadeOut(150);
	});
	$(".post").hover(function() {
		$(this).find(".title").not(this).stop().animate({height:0},150);
		$(this).find(".info").not(this).stop().animate({height:22},150);
	}, function() {
		$(this).find(".title").not(this).stop().animate({height:22},150);
		$(this).find(".info").not(this).stop().animate({height:0},150);
	});
	$(".add_comment").toggle(function() {
		$(this).addClass('active');
		$(this).text('Close');
		$('.comments').slideDown(200);
	}, function() {
		$(this).removeClass('active');
		$(this).text('Add comments');
		$('.comments').slideUp(200);
	});
	$(".thumb img").arena(100);


});*/



 $(function() {
 if ($('body').hasClass('home')) {
        var fn = new FocusNews({
            thumbs_container: '.thumbnails-container',
            slideshow: 15
        });
    }
	var searchInput = $("#searchword");
	var searchButton = $("#search-btn");

	searchButton.on("click",function(e) {
		e.preventDefault();
            $("#main-search-form").submit();
		/*var activeClass = searchButton.attr("class");
		var searchValue = encodeURIComponent(searchInput.val());

		if (searchButton.hasClass("search-btn-close")) {
			// close search
			searchInput.css("width", "0");
			searchButton.removeClass().addClass("search-btn-circle");
		} else if (searchButton.hasClass("search-btn-arrow") && (searchValue != "")) {
			// do search
			searchInput.removeClass();
			var inputHidden = $("<input>").attr("type", "hidden").attr("name", "s").val(searchInput.val());
			$("#main-search-form").append($(inputHidden));
			$("#main-search-form").submit();
		} else {
			// default, open search, show close
			searchInput.css("width", "150px");
			searchInput.val("Search...");
			searchButton.removeClass().addClass("search-btn-close");
		}*/
	});

	// submit form on Enter
	searchInput.on( "keypress",function(e) {
		var searchValue = encodeURIComponent(searchInput.val());
		if (e.which == 13) {
			e.preventDefault();
			/*if ((searchButton.hasClass("search-btn-arrow")) && (searchValue != "")) {
				searchInput.removeClass();
				var inputHidden = $("<input>").attr("type", "hidden").attr("name", "s").val(searchInput.val());
				$("#main-search-form").append($(inputHidden));*/
				$("#main-search-form").submit();
			//}
		}
	});

	searchInput.on( "focus",function() {
		if ($(this).val("") == "Search...") {
			$(this).val("");
		}
		//searchButton.removeClass().addClass("search-btn-arrow");
	});

	/*$("body").on("click",function() {
		if (searchInput.hasClass("search-input-reset")) {
			// reset search
			searchInput.css("width", "0");
			searchButton.removeClass().addClass("search-btn-circle");
			searchInput.val("Search...");
			searchInput.removeClass();
		}
	});

	// remove search field, reset search
	searchInput.on( "focusout",function() {
		var activeClass = searchButton.attr("class");
		// reset search
		searchInput.addClass("search-input-reset");
	});*/

 });
 
// Sidebar toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('verticalSidebar');
    const headerToggle = document.getElementById('headerMenuToggle');
    const collapseToggle = document.getElementById('collapseToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    
    // Toggle sidebar collapse/expand
    function toggleSidebar() {
        sidebar.classList.toggle('collapsed');
        
        // Update collapse button text
        if (collapseToggle) {
            const isCollapsed = sidebar.classList.contains('collapsed');
            const collapseText = collapseToggle.querySelector('.collapse-text');
            if (collapseText) {
                collapseText.textContent = isCollapsed ? 'Expand' : 'Collapse';
            }
        }
    }
    
    // Toggle mobile menu
    function toggleMobileMenu() {
        if (window.innerWidth <= 768) {
            // Mobile behavior: show/hide sidebar with overlay
            sidebar.classList.toggle('expanded');
            if (sidebarOverlay) {
                sidebarOverlay.classList.toggle('active');
            }
        } else {
            // Desktop behavior: collapse/expand sidebar
            toggleSidebar();
        }
    }
    
    // Event listeners
    if (headerToggle) {
        headerToggle.addEventListener('click', toggleMobileMenu);
    }
    
    if (collapseToggle) {
        collapseToggle.addEventListener('click', toggleSidebar);
    }
    
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('expanded');
            this.classList.remove('active');
        });
    }
    
    // Close mobile menu on resize to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && sidebarOverlay) {
            sidebar.classList.remove('expanded');
            sidebarOverlay.classList.remove('active');
        }
    });
});