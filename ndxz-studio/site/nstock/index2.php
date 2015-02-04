<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='fr' lang='fr'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>

<title><%title%> : <%obj_name%></title>

<link rel='stylesheet' href='<%baseurl%><%basename%>/site/<%obj_theme%>/style.css' type='text/css' />
<!--[if lte IE 6]>
<link rel='stylesheet' href='<%baseurl%><%basename%>/site/<%obj_theme%>/ie.css' type='text/css' />
<![endif]-->
<!--[if lte IE 8]>
<style>
  .img-bot {  
	border : solid 7px #efefef;
  } 
</style>
<![endif]-->
<plug:front_lib_css />
<plug:front_dyn_css />
<script type='text/JavaScript' src='<%baseurl%><%basename%>/site/js/jquery.js'></script>
<script type='text/JavaScript' src='<%baseurl%><%basename%>/site/js/cookie.js'></script>
<script type='text/JavaScript' src='<%baseurl%><%basename%>/site/js/time.js'></script>
<script type='text/JavaScript' src='<%baseurl%><%basename%>/site/js/expandingMenus.js' ></script>
<script type="text/javascript" src="<%baseurl%><%basename%>/site/js/jquery.cycle.all.js"></script>
<!--<script type='text/JavaScript' src='<%baseurl%><%basename%>/site/js/effects.js' ></script>-->
<plug:front_lib_js />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script type='text/JavaScript'>
path = '<%baseurl%>/files/gimgs/';
$(document).ready(function()
{
	setTimeout('move_up()', 130);
	expandingMenu(0);
	expandingMenu(1);
	expandingMenu(2);
	expandingMenu(3);
	expandingMenu(4);
	expandingMenu(5);
	expandingMenu(6);
	expandingMenu(7);
	expandingMenu(8);
	expandingMenu(9);
	expandingMenu(10);
	
	$("#d-col1 img").each(function(i){
		
		$(this).fadeIn('slow');
		/*var currimg = $(this);
		$(currimg).css({"opacity":0}).css("visibility","visible");
		
		var the_src= $(currimg).attr("src");
		var img = new Image();					
									
		$(img).load(function () {
	       
	    //    $(currimg).css({"opacity":0}).css("visibility","visible");
	        $(currimg).attr("src", the_src);
	    
	        setTimeout(function(){
			
			 $(currimg).animate({"opacity":1},1500);
	        
	        },(900+Math.random()));
	    
	    }).attr("src",the_src);	*/
	});
var numphoto;
var photoCourante;
var nombreTotalImage =  $(".swapimage").length;
$(".swapimage").click(function(){
		//if (typeof photoCourante !== 'undefined') {
		$(".miniatureActive").removeClass("miniatureActive");//.addClass( "yourClass" );
			/*photoCourante.css('border', "0px"); 
			photoCourante.css('padding', "3px");*/			
		//}
		/*$(this).css('border', "solid 3px black");
		$(this).css('padding', "0px");*/
		$(this).addClass("miniatureActive");
		photoCourante = $(this);
		var nbImage =(".swapimage").length;
		var img = '<img height="80%" src="' + $(this).parent().attr("rel") + '" />';
		/*var title = $(this).attr("title");
		var caption = $(this).attr("alt");
		var cnumerino = (1 + $(".swapimage").index(this));
		var anumerino =  $(".swapimage").length;
		*/
		//caption = (caption != "") ? ": " + caption : "";

		//img = img + '<br /><div class="tmarge"><span id="numerino">'+cnumerino+'</span>/'+anumerino+' '+ title + caption + "</span></div>";		
		
		$("#d-col2").hide().html(img).fadeIn("slow");
		/*numPhoto = "<b>"+cnumerino+"</b> / "+anumerino
		$("#num").html(numphoto);*/
		//$("#numerino").text(numerino);
	});
	
	$(".swapimage").hover(function() {
        $(this).animate({opacity: 0.6}, 400);
    }, function() {
        $(this).animate({opacity: 1}, 400);
    });

	$("#pageIndex").fadeIn(5000);
	
	var largeurImage = 105;
	var largeurVisionneuse = $('#d-col1').css('width');
	largeurVisionneuse = largeurVisionneuse.replace('px','');	// on enleve le px
	largeurVisionneuse = parseInt(largeurVisionneuse);
	
	
	$( window ).resize(function() {
		largeurVisionneuse = $('#d-col1').css('width');
		largeurVisionneuse = largeurVisionneuse.replace('px','');	// on enleve le px
		largeurVisionneuse = parseInt(largeurVisionneuse);
	});
	
	var largeurUl = $('#listeVisioneuse').css('width');
	largeurUl = largeurUl.replace('px','');	// on enleve le px
	largeurUl = parseInt(largeurUl);
	
	$("#next").click(function() {
		var miniatureSuivante = $(".miniatureActive").parent().parent().next().children();
		var parent = $(".miniatureActive").parent().parent().parent();
		var nbElement = parent.children().length;		// on recupere le nombre d'images
		console.debug(nbElement);
		//console.debug(miniatureSuivante);
		var adresseImage = miniatureSuivante.attr("onclick");
		//console.debug(adresseImage+ " " + "bob");
		if(miniatureSuivante != null){	
			var indexImage = miniatureSuivante.children().attr('id');
			indexImage = indexImage.replace('img','');
			indexImage = parseInt(indexImage);
			
			if(indexImage < nombreTotalImage){
				console.log(nombreTotalImage + " next: "+indexImage);
				eval(adresseImage);
				$(".miniatureActive").removeClass("miniatureActive");
				miniatureSuivante.children().addClass("miniatureActive");
			}
		}
		//photoCourante = $(this);
		//var nbImage =(".swapimage").length;
		/*var img = '<img height="80%" src="' + $(this).parent().attr("rel") + '" />';	
		$("#d-col2").hide().html(img).fadeIn("slow");*/
	});
	
	$("#prev").click(function() {
		var miniaturePrecedente = $(".miniatureActive").parent().parent().prev().children();
		var adresseImage = miniaturePrecedente.attr("onclick");
	
		var indexImage = $(".miniatureActive").attr('id');
		indexImage = indexImage.replace('img','');
		indexImage = parseInt(indexImage);
		console.log(nombreTotalImage + " prev : "+indexImage);
		if(indexImage>0){
			alert(indexImage);
			eval(adresseImage);
		
			$(".miniatureActive").removeClass("miniatureActive");
			miniaturePrecedente.children().addClass("miniatureActive");
		}
	});
	
	$("#es-nav-next").click(function() {
		var recuperationMargin = $('#listeVisioneuse').css('marginLeft');	// on recupere npx
		recuperationMargin = recuperationMargin.replace('px','');			// on enleve le px
		recuperationMargin = parseInt(recuperationMargin);
		
		var negLargeurVisionneuse = 0 - largeurUl;
				
		if( recuperationMargin > negLargeurVisionneuse+largeurVisionneuse+largeurImage){
			recuperationMargin -= largeurImage;
			recuperationMargin += 'px';
			$("#listeVisioneuse").animate({marginLeft: recuperationMargin},250);
		}
	});
	
	$("#es-nav-prev").click(function() {
		var recuperationMargin = $('#listeVisioneuse').css('marginLeft');	// on recupere npx
		recuperationMargin = recuperationMargin.replace('px','');	// on enleve le px	
		recuperationMargin = parseInt(recuperationMargin);
		if(recuperationMargin < 0){
			recuperationMargin += largeurImage;
			recuperationMargin += 'px';
			$("#listeVisioneuse").animate({marginLeft: recuperationMargin},250);
		}
	});
	
	$(document).on('keyup.rgGallery', function( event ) {
		/*if (event.keyCode == 39)
			console.log("right");
		else if (event.keyCode == 37)
			console.log("left");*/	
	});
		
});
</script>
<plug:front_dyn_js />
<plug:backgrounder color='<%color%>', img='<%bgimg%>', tile='<%tiling%>' />
</head>

<body class='section-<%section_id%>'>
<div id='menu'>
<div class='container' id="menuGaucheContainer">
<div class="infotop">
	<p>
		<a id="home" href="http://www.pawl.fr">P A W L</a>
	</p>
</div>
<%obj_itop%>
<plug:front_index />
<%obj_ibot%>



</div>	
</div>	

<div id='content'>
<div class='container' id="conteneurImageContainer">

<!-- text and image -->
<plug:front_exhibit />
<!-- end text and image -->

</div>
</div>
<!-- you must provide a link to Indexhibit on your site someplace - thank you -->
<div id="pub">Built with <a href='http://www.indexhibit.org/'>Indexhibit</a></div>
</body>
</html>