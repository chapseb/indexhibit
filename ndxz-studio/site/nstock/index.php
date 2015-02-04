<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='fr' lang='fr'>
<head>
<meta name="description" content="<plug:front_dyn_desc /> "/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<META HTTP-EQUIV="imagetoolbar" CONTENT="no">

<meta name="viewport" content="initial-scale=1.0">

<title><%obj_name%> : <%title%></title>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script type='text/JavaScript' src='<%baseurl%><%basename%>/site/js/jquery.js'></script>
<script type='text/JavaScript' src='<%baseurl%><%basename%>/site/js/cookie.js'></script>
<script type='text/JavaScript' src='<%baseurl%><%basename%>/site/js/time.js'></script>
<script type='text/JavaScript' src='<%baseurl%><%basename%>/site/js/expandingMenus.js' ></script>
<script type="text/javascript" src="<%baseurl%><%basename%>/site/js/jquery.cycle.all.js"></script>
<script type="text/javascript" src="<%baseurl%><%basename%>/site/js/jquery.mousewheel.js"></script>
<!--<script type='text/JavaScript' src='<%baseurl%><%basename%>/site/js/effects.js' ></script>-->

<plug:front_lib_js />


<script type="text/javascript" src="<%baseurl%><%basename%>/site/js/affichagephoto.js"></script>
<script type="text/javascript"> <!-- function clickIE4(){ if (event.button==2){ return false; } } function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false; } } } if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; } document.oncontextmenu=new Function("return false") // --> </script>
<script type='text/JavaScript'>
path = '<%baseurl%>/files/gimgs/';

	
$(document).ready(function(){
	$("li:has('a'):contains('Mentions legales')").remove();
	$("#pageIndex").fadeIn(3000);	// affichage de la PAWL sur la page d'accueil
	setTimeout('move_up()', 130);
	$("#d-col1 img").each(function(i){ $(this).fadeIn('slow');});
	/*expandingMenu(0);*/expandingMenu(1);expandingMenu(2);expandingMenu(3);
	expandingMenu(4);expandingMenu(5);expandingMenu(6);expandingMenu(7);
	expandingMenu(8);expandingMenu(9);expandingMenu(10);
	/*$('#d-col1').mousewheel(function(e, delta) {
		this.scrollLeft -= (delta * 40);
		e.preventDefault();
	});*/
	
});
function centreVerticale(){

		var tailleImage = 0.75 * document.body.offsetHeight+'px'; // coefficient pour savoir combien l'image doit prendre de place dans la page
		var image = document.getElementById('d-col2');//.getElementsByTagName('IMG')[0];
		image.style.height = tailleImage;
		var tailleConteneurCentre = parseInt(document.getElementById('d-col2').style.height);
		tailleConteneurCentre = parseInt(tailleConteneurCentre) + 70 +20 + 20 +20; // 70 pour le caroussel +20 margin bottom +20 fleches + 20 margin top
		
		document.getElementById('conteneurCentre').style.height = tailleConteneurCentre +'px';
		document.getElementById('conteneurCentre').style.marginTop = '-'+ (tailleConteneurCentre/2) +'px';
	}
</script>
<plug:front_dyn_js />
<plug:backgrounder color='<%color%>', img='<%bgimg%>', tile='<%tiling%>' />
</head>

<body class='section-<%section_id%>'>
<div id='menu'>
<div class='container' id="menuGaucheContainer">
<!--<div class="infotop">
	<p>
		<a id="home" href="http://www.pawl.fr">HOME</a>
	</p>
</div>-->
<%obj_itop%>
<plug:front_index />
<%obj_ibot%>
<div style="padding-bottom:10px;color:black;position:fixed;bottom:0;">
	&copy; pawl.fr
</div>
</div>	
</div>	

<div id='content'>
<div class='container' id="conteneurImageContainer">
<div id="conteneurCentre">
<div id="divVideo" style="display:none;"></div>
<!-- text and image -->
<plug:front_exhibit />
<!-- end text and image -->

</div>
</div>
</div>

<!-- you must provide a link to Indexhibit on your site someplace - thank you -->
<div id="pub">Built with <a href='http://www.indexhibit.org/'>Indexhibit</a></div>
</body>
</html>