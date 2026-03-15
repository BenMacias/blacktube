jQuery(document).ready(function($) {
	$('#add_videos_form').submit(function() {
		$('#add_videos_loading').show();
		$('#add_videos_submit').attr('disabled', true);
	 	$('#add_videos_results').empty();
      
	  	data = $('#add_videos_form').serialize();

     	$.post(ajaxurl, data, function (response) {
			$('#add_videos_results').html(response);
			$('#add_videos_loading').hide();
			$('#add_videos_submit').attr('disabled', false);
			$('.add_videos_box').hide();
		});	
		return false;
	});
	
	$('#checkuncheck').toggle(function(){
        $('#results input:checkbox').removeAttr('checked');
        $(this).val('check all');
		$('#checkuncheck').text('check all videos');
    },function(){
		$('#results input:checkbox').attr('checked','checked');
        $(this).val('uncheck all');
		$('#checkuncheck').text('uncheck all videos');       
    })
	
});
