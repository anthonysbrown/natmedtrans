
jQuery(function() {
	
		
	 var inst = jQuery('[data-remodal-id=natmedtrans]').remodal();	
		
jQuery(document).on('opened', '.remodal', function () {
  jQuery(".natmedtrans-wrapper").empty();
  if(jQuery(this).attr('data-remodal-id') == 'natmedtrans'){
	  
    var is_opera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
    var is_Edge = navigator.userAgent.indexOf("Edge") > -1;
    var is_chrome = !!window.chrome && !is_opera && !is_Edge;
    var is_explorer= typeof document !== 'undefined' && !!document.documentMode && !is_Edge;
    var is_firefox = typeof window.InstallTrigger !== 'undefined';
    var is_safari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
	var new_window = jQuery(".natmedtrans-button").attr("natmedtrans-button");
	  console.log(new_window);
	   jQuery.post(nmt_var.ajax_url, {'action':'nmt_ajax_get_booking'}, function(response) {
		   
		   
		   var obj = jQuery.parseJSON(response);
		   
		   
		   
		   
		   if(obj.error == ''){
			    console.log(obj.url); 
			  
				  if(is_safari || is_opera){
		  		
				inst.close(function(){
				
						
					
			
				});
				
				if(new_window == 1 || new_window === undefined ){
							window.open(obj.url);		
						}else{
							
							window.location.href =obj.url;
						}
					
				
		
				  }else{
	  		
	
		
			
			  jQuery(".natmedtrans-wrapper").html('<iframe frameborder="0" height="1000px" width="100%" class="nmt-frame" src="'+obj.url+'"></iframe>'); 
			    }
		   }else{
			
			   
			jQuery(".natmedtrans-wrapper").html('<div class="nmt-error">'+ obj.error+'</div>');
				
			   
		   }
		   
		
	});
	
  }
});

});