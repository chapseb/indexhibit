$(document).ready(function(){
    
	// var cosi = $('.infotop');
    // Cufon.replace(cosi,{hover:true});
  
    $("#d-col1 img").each(function(i){
		var test = $(this);
	console.debug(test);
		var currimg = $(this);
		$(currimg).css({"opacity":0}).css("visibility","visible");
		
		var the_src= $(currimg).attr("src");
		var img = new Image();					
									
		$(img).load(function () {
	       
	    //    $(currimg).css({"opacity":0}).css("visibility","visible");
	        $(currimg).attr("src", the_src);
	    
	        setTimeout(function(){
			
			 $(currimg).animate({"opacity":1},1500);
	        
	        },(900+Math.random()*5000));
	    
	    }).attr("src",the_src);	
	    
	  
	
	
	});	
	
	
	function looppa(imgx){
        var evry = 3000+parseInt(Math.random()*15000);
		$(imgx).everyTime(evry, 'imgloop', function() {
		$(imgx).animate({"opacity":"toggle"},1500);
			                     
		});

    }

    setTimeout(function(){
			
			$("#d-col1 ul.home img").each(function() {
			 
			     looppa($(this));
			 
			 });
	        
    },4000);
    
    
    $("#d-col1 ul.home img").hover(function() {
			                
		 $(this).stopTime('imgloop');
		 $(this).stop().animate({"opacity":1},900);
			                
		},function(){
			                
		 looppa($(this));
			                
		});

	        
	
    /*var off=$("#content").offset();*/
	
	
	
	$(".swapimage").click(function(){
	
		var img = '<img src="' + $(this).parent().attr("rel") + '" />';
		var title = $(this).attr("title");
		var caption = $(this).attr("alt");
		var cnumerino = (1 + $(".swapimage").index(this));
		var anumerino =  $(".swapimage").length;
		
		caption = (caption != "") ? ": " + caption : "";

		img = img + '<br /><div class="tmarge"><span id="numerino">'+cnumerino+'</span>/'+anumerino+' '+ title + caption + "</span></div>";
		
		var coff=$(this).offset();
		var ptop = coff.top-off.top;
		$("#placetwo").stop().animate({top:ptop},900);
		
		
		$("#d-col2").hide().html(img).fadeIn("slow");
		//$("#numerino").text(numerino);
		
			
	});
	
		$(".swapimage").hover(function(){
	
		var coff=$(this).offset();
		var ptop = coff.top-off.top;
		$("#place").stop().animate({top:ptop},900);
		
			
	});
	
	
	
	$("#swaptext").click(function(){
	
		var text = $("#hidden-text").html();
		$("#d-col2").hide().html(text).fadeIn("slow");
	    
	    
	});
   
	
	
	 if( location.hash ){
       
       setTimeout(function(){
            var clicked = window.location.href.split('#')[1];
           // alert(clicked);
            $("#img"+clicked+"").trigger("click");
       },500); 
    
    }else{
       setTimeout(function(){ 
	    $(".swapimage").eq(0).trigger("click");
    	  // $("#swaptext").trigger("click");

        },500); 
    };
    
    
   //  var cc = $('iframe').contents().find('body').html();
     //css({"margin":0});
   // console.log("."+cc);
	
});