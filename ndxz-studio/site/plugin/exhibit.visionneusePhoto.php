<?php if (!defined('SITE')) exit('No direct script access allowed');

/**
* Deux column
*
* Exhbition format
* inspired by miaandjem.com
* 
* @version 1.0
* @author Vaska 
*/

// defaults from the general libary - be sure these are installed
$exhibit['dyn_css'] = dynamicCSS();
$exhibit['dyn_js'] = dynamicJS();
$exhibit['exhibit'] = createExhibit();
$exhibit['dyn_desc'] = dynamicDesc();

function dynamicDesc(){
	$OBJ =& get_instance();
	global $rs;

	$pages = $OBJ->db->fetchArray("SELECT media_file FROM ".PX."media");		
		// $pages contient toutes les images :)
		
	// ** DON'T FORGET THE TEXT ** //
	$s = $rs['content'];		// on se sert du content pour faire créer le meta description

	if (!$pages) return $s;

	return strip_tags($s);
}

function createExhibit()
{
	//var_dump($_SERVER['HTTP_HOST']);	
	//var_dump($_SERVER["PHP_SELF"]);
	$OBJ =& get_instance();
	global $rs, $exhibit;
	
	$pages = $OBJ->db->fetchArray("SELECT * 
		FROM ".PX."media   
		WHERE media_ref_id = '$rs[id]' 
		ORDER BY media_order ASC, media_id ASC");
	if ($pages){
		$esCarouselWrapperDebut = "<div class='es-carousel-wrapper'>";
		$esCarouselWrapperFin = "</div>";		
		$i = 0; $a = '';
		$largeurDesImages=0;
		$premiereImageClasseActive = "";
		$invisibleImage = '';
		foreach ($pages as $go){
		$formatURL = "/homez.341/pawlwaby/www/files/gimgs/".$go['media_file'];
			if($i==0){
				$premiereImage = "<img src='". BASEURL . GIMGS ."/".$go['media_file']."' oncontextmenu='return false' oncontextmenu='return false' ondrag='return false' onmousedown='return false' />";
				$premiereImageClasseActive = " miniatureActive";
			}
			else{$premiereImageClasseActive = "";}
			$title 		= ($go['media_title'] == '') ? 'N/A' : $go['media_title'];
			$caption 	= ($go['media_caption'] == '') ? 'N/A' : $go['media_caption'];
			
			$png		= ($go['media_mime'] == 'png') ? " class='png'" : '';
			/* dans img:  alt='$caption' title='$title' */
			
			if(!strstr($go['media_file'], 'separationphotos')){ 
				
				//$formatURL = "asterios:$1$7RshsTIE$8M/Y78cl6gXidBHJ3tn.C@". BASEURL . GIMGS."/".$go['media_file'];
				list($width, $height, $type, $attr) = getimagesize($formatURL);
				
				if($width>$height || ($width/$height < 1.10 && $width/$height > 0.90)){$widthMiniature = $width*65/$height;}
				else{$widthMiniature = $width*90/$height;}
				$a .= "\n<li class='$invisibleImage'><a href='#' rel='" . BASEURL . GIMGS . "'onclick=\"swapImg($i, '$go[media_file]');\"><img src='" . GIMGS . "/th-$go[media_file]' width='$widthMiniature' id='img$i'$png class='swapimage $premiereImageClasseActive' oncontextmenu='return false'/></a></li>\n";
				$largeurDesImages = $largeurDesImages + $widthMiniature + 6;
				$i++;
				$invisibleImage = '';
			}
			else{
				$largeurDesImages += 40;
				$invisibleImage = 'imageApres';
			}
		} 
	}
	
	// images
	$s .= "<div id='img-container'>\n";
		
	// text
	$s .= "<div id='d-col2'>\n";
	//$s .= $rs['content'];
	$s .= $premiereImage;
	$s .= "</div>\n";
	
	$s .= "<div id='hidden-text'>\n";
	$s .= $rs['content'];
	$s .= "</div>\n";
	
	$s .= "\n<div class='cl'><!-- --></div>\n";
	$s .= "</div>\n";
	$s .= "<p class='nav'><a id='prev' href='#'><<</a>   <a id='next' href='#'>>></a></p>";
	$s .= $esCarouselWrapperDebut;
	//$s .= "<div class='es-nav'></div>"; 
	$s .= "<span class='es-nav' id='es-nav-prev'>Previous</span>";
	$s .= "<div id='d-col1'><ul id='listeVisioneuse' style='width:".$largeurDesImages."px'>\n";
	$s .= $a;
	$s .= "</ul></div>\n";
	$s .= "<span class='es-nav' id='es-nav-next'>Next</span>";
	$s .= $esCarouselWrapperFin;
	return $s;
}

function dynamicCSS()
{
	return "#d-col1{ /*float: left; width: 200px;*/ }
	#d-col2 { /*margin-left: 205px;*/ }
	#d-col1 img { /*margin-bottom: 12px;*/ }
	#hidden-text { display: none; }";
}

function dynamicJS()
{
	global $rs;
	
	$tile = ($rs['tiling'] != 1) ? ", backgroundRepeat: 'no-repeat'" : '';
	
	return "function swapImg(a, image)
	{
		var the_path = '" . BASEURL . GIMGS ."/' + image;
		show = new Image;
		show.src = the_path;
		
		var img = '<img oncontextmenu=\'return false\' src=' + the_path + ' />';
		var title = $('#img' + a).attr('title');
		var caption = $('#img' + a).attr('alt');
		if (title != 'N/A') 
		{
			caption = (caption != 'N/A') ? ': ' + caption : '';

			//img = img + '<br /><span>' + title + caption + '</span>';
		}
		//img = img + \"<p class='nav'><span id='num'>\"+numPhoto+\"</span></p>\";
		$('#d-col2').fadeOut(0, function() {
			$('#d-col2').html(img);
			$('#d-col2').fadeIn(500);
		});
		//$('#d-col2').hide().html(img).fadeIn('slow');
	}
	
	function swapText()
	{
		var text = $('#hidden-text').html();
		$('#d-col2').html(text);
	}
	$( document ).ready(function() {
		$('#divVideo').hide();
		$('#divVideo').empty();
		window.onload = centreVerticale();
	});
		
	
	
	";
}


?>