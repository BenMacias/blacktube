jQuery(document).ready(function() {
	
	$('aside.widget_categories h4').on("click", function(e){
		e.preventDefault();
		$('aside.widget_categories').toggleClass('hover');
	});
	
	$('#mobile-nav').on("click", function(e){
		e.preventDefault();
		$('nav#top-nav').toggleClass('hide-nav');
		$('#mobile-nav').toggleClass('mobile-nav-close');
	});
	
	$('div#videoOverAd a.close').on("click", function(e){
		e.preventDefault();
		$('div#videoOverAd').hide();
	});
	
    jQuery('a.heartLink').on("click", function(e){
		e.preventDefault();
		heart = jQuery(this);
		if(heart.hasClass('liked') == false){	
			post_id = heart.data('post_id');
			jQuery.ajax({
				type: 'post',
				url: ajax_var.url,
				data: 'action=post-like&nonce='+ajax_var.nonce+'&post_like=&post_id='+post_id,
				success: function(count){
					heart.text(count+' likes');
				},
			});
			heart.addClass('liked');
		}	
        return false;
    })
	$('#showCommentsLink').on("click", function(e){
		e.preventDefault();
		status;
		$('#comments').toggle('fast');
		if(status == '1'){
			$('#showCommentsLink').text('Add comment'); status = '0';
		}else{
			$('#showCommentsLink').text('Close comments'); status = '1';
		}
	})
	
/*$('.blocks-gallery-item a').attr("data-fancybox","images").fancybox({
				
		buttons : [
		    "zoom",
			"share",
			"slideShow",
			"fullScreen",
			"download",
			"thumbs",
			"close"
					]
	});*/
	
})
	function openCity(evt, cityName) {
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
	tabcontent[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
	tablinks[i].className = tablinks[i].className.replace(" active", "");
	}
	document.getElementById(cityName).style.display = "block";
	evt.currentTarget.className += " active";
	}
	// Get the element with id="defaultOpen" and click on it
	document.getElementById("tab_terms").on("click");