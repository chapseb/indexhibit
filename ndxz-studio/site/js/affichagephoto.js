$(document).ready(function()
{
	/************ variables globales ****************/
	var largeurImage = 106;	// sert lors du calcul du margin left de la visionneuse (déplace la liste d'une largeur d'image vers la droite ou la gauche)
	var nombreTotalImage =  $(".swapimage").length;		// nombre d'image dans la visionneuse
	var largeurVisionneuse = $('#d-col1').css('width');	// largeur du div contenant la visionneuse (renvoie la largeur de la div affichée)
	//alert(largeurVisionneuse);
	if(typeof largeurVisionneuse != "undefined") {
		largeurVisionneuse = largeurVisionneuse.replace('px','');	// on enleve le px
		largeurVisionneuse = parseInt(largeurVisionneuse);
	}
	var nbImageParEcran = largeurVisionneuse / largeurImage;
	nbImageParEcran = Math.floor(nbImageParEcran);
	var largeurUl = $('#listeVisioneuse').css('width');		// taille de la liste UL  = ensemble des images visibles et non visibles
	if(typeof largeurUl != "undefined") {
		largeurUl = largeurUl.replace('px','');	// on enleve le px
		largeurUl = parseInt(largeurUl); 
	}
	/****************************************************/

	
	/** suivante ou precedente, sert a deplacer la miniature active vers la gauche ou vers la droite et replace la visionneuse pour voir la photo active ***/
	function deplacementFlechesPhoto(sens){
		var miniatureProchaine;
		if(sens == 'suivante'){	miniatureProchaine = $(".miniatureActive").parent().parent().next().children(); }
		else{ miniatureProchaine = $(".miniatureActive").parent().parent().prev().children(); }
		var indexImage = miniatureProchaine.children().attr('id');
		var imageProchaineMiniature = miniatureProchaine.children();
		if(typeof indexImage != "undefined") {
			indexImage = indexImage.replace('img','');
			indexImage = parseInt(indexImage);
			var numImage = indexImage+1;
			if( (sens == 'suivante' && indexImage < nombreTotalImage) || (sens == 'precedente' && indexImage >= 0) ){
				transitionCSS(imageProchaineMiniature);
				var adresseImage = miniatureProchaine.attr("onclick");	
				eval(adresseImage);
				$(".miniatureActive").removeClass("miniatureActive");
				miniatureProchaine.children().addClass("miniatureActive");
			}
			testVisibleEntiere(numImage);
		}
	}
	/*********************************************************************************************************/
	
	/********** deplacement des fleches blanches pour déplacer d'une largeur de visionneuse	*/
	function deplacementFlecheMiniature(sens){
		/**	good **/
		var recuperationMargin = $('#listeVisioneuse').css('marginLeft');	// on recupere npx
		recuperationMargin = recuperationMargin.replace('px','');			// on enleve le px
		recuperationMargin = parseInt(recuperationMargin);					// margin courant
		if(sens == 'suivant'){
			var negLargeurUl = 0 - largeurUl;
				recuperationMargin = recuperationMargin - largeurVisionneuse;
				if(recuperationMargin <=  negLargeurUl + largeurVisionneuse){ recuperationMargin =  negLargeurUl + largeurVisionneuse; }
				recuperationMargin += 'px';$("#listeVisioneuse").animate({marginLeft: recuperationMargin},250);
		}
		/**/
		if(sens == 'precedent'){
			if(recuperationMargin < 0){
				recuperationMargin = recuperationMargin + largeurVisionneuse;// - largeurImage;
				if(recuperationMargin > 0){	recuperationMargin = 0;	}
				recuperationMargin += 'px';$("#listeVisioneuse").animate({marginLeft: recuperationMargin},250);
			}
		}
	}
	
	$("#es-nav-prev").click(function(){ deplacementFlecheMiniature('precedent'); });
	$("#es-nav-next").click(function(){	deplacementFlecheMiniature('suivant'); });
	/**************************************************************************************************/
	
	/** clic sur une miniature	**/
	$(".swapimage").click(function(){
		transitionCSS($(this));
		var indexImage = $(".miniatureActive").attr('id');	// on recupere l'index de l'image sur laquelle on vient de cliquer
		if(typeof indexImage != "undefined") {
			indexImage = indexImage.replace('img','');
			indexImage = parseInt(indexImage);
			var numImage = indexImage+1;
			testVisibleEntiere(numImage);	// si elle n'est pas entierement visible on fait en sorte qu elle le soit
		}
	});
	
	function transitionCSS(noeud){
		$(".miniatureActive").removeClass("miniatureActive");
		noeud.addClass("miniatureActive");
	}
	
	/** on teste si l'image est visible entierement. Si elle ne l'est pas on la rend visible en déplaçant les miniatures **/ 
	function testVisibleEntiere(numImage){
		var recuperationMargin = $('#listeVisioneuse').css('marginLeft');	// on recupere npx
		recuperationMargin = recuperationMargin.replace('px','');			// on enleve le px
		recuperationMargin = parseInt(recuperationMargin);					// margin courant
		recuperationMargin = Math.abs(recuperationMargin);

		var imageCourante = $('#listeVisioneuse li:nth-child('+numImage+')');
		var largeurImageCourante = imageCourante.children('a').children('img').width()+6;
		var nombresEspacesApres = imageCourante.nextAll(".imageApres").length;
		var nombresEspacesAvant = imageCourante.prevAll(".imageApres").length;
		var imagesAvant = imageCourante.prevAll();
		var largeurImagesAvant = 0;
		imagesAvant.each(function(i){
			var largeurImagePrecedente = jQuery(imagesAvant[i]).children('a').children('img').width();
			largeurImagesAvant += largeurImagePrecedente +6; // padding		
		});
		if($('#listeVisioneuse li:nth-child('+numImage+')').hasClass("imageApres")){
			nombresEspacesAvant++;
		}
		var fourchetteBasse = recuperationMargin - largeurImagesAvant - (nombresEspacesAvant*37);	// 40 - 3 px du margin left d'une photo normale
		//Math.ceil((( (recuperationMargin - (nombresEspacesAvant*40))-largeurImagesAvant)) + 1);	// recupere entier sup 
		var fourchetteHaute =  recuperationMargin + largeurVisionneuse - largeurImagesAvant - (nombresEspacesAvant*37) - largeurImageCourante-6;// 6 correspond a la bordure
		// Math.floor((recuperationMargin+largeurVisionneuse - (nombresEspacesAvant*40))-largeurImagesAvant);	// entier inferieur
		//alert(fourchetteHaute); 
		if(fourchetteBasse > 0 || fourchetteHaute < 0 ){
			if(fourchetteBasse > 0 ){
				recuperationMargin = largeurImagesAvant + (nombresEspacesAvant*37);
			}
			else if(fourchetteHaute < 0){
				recuperationMargin += largeurVisionneuse - largeurImageCourante; //largeurImagesAvant + (nombresEspacesAvant*40) + largeurVisionneuse - largeurImageCourante;
			}
			if(recuperationMargin >= largeurUl - largeurVisionneuse){
				//alert(recuperationMargin + " " + largeurUl + " " + largeurVisionneuse);
				recuperationMargin = largeurUl - largeurVisionneuse;
			}
			recuperationMargin = 0 - recuperationMargin;
			recuperationMargin += 'px';
			$("#listeVisioneuse").animate({marginLeft: recuperationMargin},500);
		}
	}
	/*************************************************************************************************/
	
	$(".swapimage").hover(
		function(){ $(this).animate({opacity: 0.6}, 400);}, 
			function(){ $(this).animate({opacity: 1}, 400);}
	);
	
	$("#next").click(function(){ deplacementFlechesPhoto("suivante"); });
	$("#prev").click(function(){ deplacementFlechesPhoto("precedente");	});
	
	$(document).on('keyup.container', function( event ) {
		if (event.keyCode == 39){deplacementFlechesPhoto("suivante");}
		else if (event.keyCode == 37){deplacementFlechesPhoto("precedente");}
	});
	
	/*********************************************** en cours *********************************************************/
	
	$(window).resize(function() {
		largeurVisionneuse = $('#d-col1').css('width');
		centreVerticale();
		if(typeof largeurVisionneuse != "undefined") {
			largeurVisionneuse = largeurVisionneuse.replace('px','');	// on enleve le px
			largeurVisionneuse = parseInt(largeurVisionneuse);
		}
		nbImageParEcran = largeurVisionneuse / largeurImage;
		nbImageParEcran = Math.floor(nbImageParEcran);
	});
	
	/**********************************************************/
	
});