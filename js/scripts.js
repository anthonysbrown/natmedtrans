
jQuery(function($) {
	
	
	$(".natmedtrans-button").on("click",function(){
	var button = $(this);
	
	var remodal_options = {'hashTracking':false}
	var inst =$('[data-remodal-id=natmedtrans]').remodal(remodal_options);
	var is_opera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
    var is_Edge = navigator.userAgent.indexOf("Edge") > -1;
    var is_chrome = !!window.chrome && !is_opera && !is_Edge;
    var is_explorer= typeof document !== 'undefined' && !!document.documentMode && !is_Edge;
    var is_firefox = typeof window.InstallTrigger !== 'undefined';
    var is_safari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
	var url = button.attr('data-url');
		if(is_safari || is_opera){
			window.open(url,'_blank');
			
		}else{
			inst.open();
			  jQuery(".natmedtrans-wrapper").html('<iframe frameborder="0" height="1000px" width="100%" class="nmt-frame" src="'+url+'"></iframe>');
			
		}
		
		
	
		
		
		
		
		
		
	});
		


});