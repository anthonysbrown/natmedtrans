

jQuery(document).on('opening', '.remodal', function () {
  jQuery(".natmedtrans-wrapper").empty();
  if(jQuery(this).attr('data-remodal-id') == 'natmedtrans'){
	  
	   jQuery.post(nmt_var.ajax_url, {'action':'nmt_ajax_get_booking'}, function(response) {
		   
		   var obj = jQuery.parseJSON(response);
		   
		   if(obj.error == ''){
			  console.log(obj.url); 
			  jQuery(".natmedtrans-wrapper").html('<iframe frameborder="0" height="1000px" width="100%" class="nmt-frame" src="'+obj.url+'"></iframe>'); 
		   }else{
			   
			jQuery(".natmedtrans-wrapper").html('<div class="nmt-error">'+ obj.error+'</div>');
			   
		   }
		   
		
	});
	
  }
});