jQuery(document).ready(function($) {
	$('#vsearch_form').submit(function() {
		$('#vsearch_loading').show();
		$('#vsearch_submit').attr('disabled', true);

      data = $('#vsearch_form').serialize();

     	$.post(ajaxurl, data, function (response) {
			$('#results').html(response);
			$('#vsearch_loading').hide();
			$('#vsearch_submit').attr('disabled', false);
		});	
		$(".redtube_tags").hide();
		return false;
	});
	// Redtube tags
	$(".redtube_tags").hide();
    $(".show_hide_tags").show();
 
    $('.show_hide_tags').on("click",function(){
    $(".redtube_tags").slideToggle();
    });
});
