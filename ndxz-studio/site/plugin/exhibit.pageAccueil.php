<?php if (!defined('SITE')) exit('No direct script access allowed');

/**
* Slideshow
*
* Exhibition format
* 
* @version 1.0.0.0.0.0.0.0.0.0.1 (Because Simon ate a banana for lunch)
* @author Simon Lagneaux 
* @author Vaska
*/


// defaults from the general libary - be sure these are installed
$exhibit['dyn_css'] = dynamicCSS();
$exhibit['lib_js'] = array('jquery.cycle.all.js');
$exhibit['dyn_js'] = dynamicJS();
$exhibit['dyn_desc'] = dynamicDesc();
$exhibit['exhibit'] = createExhibit();

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

function dynamicJS()
{
    global $timeout;
	$OBJ =& get_instance();
	$photos = $OBJ->db->fetchArray("SELECT media_file, url FROM ".PX."media left join ".PX."objects ON ".PX."media.media_ref_id=".PX."objects.id");
	$repertoireVideos = 'files/videos/webm';  
  
	  
	
	$dossierPhotos = '/files/gimgs/';
	$dossierWebM = '/files/videos/webm/';
	$dossierH264 = '/files/videos/H264/';
	$dossierLiens = 'index.php?';	
	$retour = '$(document).ready(function(){
		var adresseVideos = new Array();
		var lienPhotos = new Array();
		var liensVideosH264 = new Array();
		var liensVideosWEBM = new Array();
		function initTableauPhotos(adresseVideos){';
		if ($handle = opendir( $repertoireVideos )) {  
			while ($file = readdir($handle)) {  
				if ($file != '.' && $file != '..') {  
					$retour .= 'liensVideosH264.push("'.$dossierWebM.$file.'");';
					$retour .= 'liensVideosWEBM.push("'.$dossierH264.$file.'");'."\r\n"; 
				}  
			}  
			closedir($handle);  
		}
		$retour .= '}';
		
		$retour .= 'initTableauPhotos(adresseVideos);
		var nombreRandom = Math.floor(Math.random()*(3)+1);
		var codeVideo = \'<video muted="true" id="videoIntro" autoplay="true" loop><source src="/files/videos/pawlok.mp4" type="video/mp4" /><source src="/files/videos/pawlok.webm" type="video/webm" /><source src="files/videos/pawlok.ogv" type="video/ogg" />Votre navigateur ne supporte pas la video.</video>\';
		$("#divVideo").append(codeVideo);
		$("#divVideo").show(); // remis pour afficher la vidéo dès le départ
		';
		 
		// premier lancement pageIndex existe : on le supprimer pour laisser place au photo : run s'appelle en boucle
		$retour .= '
		var div = $("#pageIndex");
				//if (div.length) {
					//div.fadeOut(2000,function(){div.remove();
					//$("#testVideo").remove();
					//  //$("#conteneurImageContainer").html("<div id=\'d-col3\'><img id=\'photoAccueil\' src=\'/files/accueil.jpg\' /></div>");
					//  //run();
					//});
				//}
		/* //function run(){
			$("#photoAccueil").fadeOut(2000, function(){	
				nombreRandom = Math.floor(Math.random()*(2)+1);
				if(nombreRandom == 1){
					$("#divVideo").hide();
					$("#divVideo").empty();
					$("#conteneurImageContainer").show();
					$("#photoAccueil").attr("src","/files/accueil.jpg").fadeIn(2000, run);
				}
				else if(nombreRandom > 1){
					$("#conteneurImageContainer").hide();
					$("#divVideo").show();
					//$("#divVideo").html("<iframe id=\'videoIframe\' src=\'//www.youtube.com/embed/Y5pen3QMgzQ?start="+departVideo1Random+"&amp;end="+endVideo1+"&autoplay=1\' frameborder=\'0\' allowfullscreen></iframe>");
					$("#divVideo").html("<video muted=\"muted\" autoplay=\"true\"><source src=\"/files/videos/videoEntiereMP4.mp4\" type=\"video/mp4\" /><source src=\"/files/videos/videoEntiereWEBM.webm\" type=\"video/webm\" /></video>");
					setTimeout(run, 5000);
				}
				else{
					run();
				}
			}); 
		}	*/
		';
		 
		$retour .= '
		});';
	$retour .= "function centreVerticale(){

		var tailleImage = 0.75 * document.body.offsetHeight+'px'; // coefficient pour savoir combien l'image doit prendre de place dans la page
		var image = document.getElementById('videoIntro');//.getElementsByTagName('IMG')[0];
		image.style.height = tailleImage;
		var tailleConteneurCentre = parseInt(document.getElementById('videoIntro').style.height);
		
		tailleConteneurCentre = parseInt(tailleConteneurCentre);
		
		document.getElementById('conteneurCentre').style.height = tailleConteneurCentre +'px';
		document.getElementById('conteneurCentre').style.marginTop = '-'+ (tailleConteneurCentre/2) +'px';

	}
	window.onload = centreVerticale;";
	
	return $retour;
}


function createExhibit()
{
	$OBJ =& get_instance();
	global $rs;

	$pages = $OBJ->db->fetchArray("SELECT media_file FROM ".PX."media");		
		// $pages contient toutes les images :)
		
	// ** DON'T FORGET THE TEXT ** //
	$s = ""; //$rs['content'];		// on se sert du content pour faire créer le meta description

	if (!$pages) return $s;

	return $s;
}

function dynamicCSS()
{
	return "#num {padding-left: 6px;}
	.img-bot {margin-bottom: 6px; display: block; }";
}





?>