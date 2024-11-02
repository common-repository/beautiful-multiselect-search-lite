jQuery(document).ready(function($) {
    // Inside of this function, $() will work as an alias for jQuery()
    // and other libraries also using $ will not be accessible under this shortcut
	$('.bms-sous-categorie').on('mouseenter',function(){
			//recupere la derniere classe
			var val = $(this).attr("class").split(' ').slice(-1);
			var bmsselectorhovercl = admin_info.bmscolorselectorhover;
			var bmsselectorborderhovercl = admin_info.bmsselecteurhoverbordercolor;
			$('.bms-selecteur-sous-categorie.'+val).animate({ backgroundColor:bmsselectorhovercl},250);
			$('.bms-selecteur-sous-categorie.'+val).css({'border-color':bmsselectorborderhovercl});	
	});
	$('.bms-sous-categorie').on('mouseleave',function(){
			//recupere la derniere classe
			var val = $(this).attr("class").split(' ').slice(-1);
			var bmsselectorcl = admin_info.bmscolorselector;
			var bmsselectorbordercl = admin_info.bmsselecteurbordercolor;
			$('.bms-selecteur-sous-categorie.'+val).animate({ backgroundColor:bmsselectorcl},200); 
			$('.bms-selecteur-sous-categorie.'+val).css({'border-color':bmsselectorbordercl});

	});
	$('a.bms-selectedcritere').on('mouseenter',function(){
			//recupere la derniere classe
			var val = $(this).attr("class").split(' ').slice(-1);
			var bmsselectedcriterehovercl = admin_info.bmsselectedcriterehovercolor;
			var bmscrosscolorhover = admin_info.bmscrosscolorhover;
			var urlbms = admin_info.bmsurl;
			if (bmscrosscolorhover == 'Dark Grey')
			{
					$('a.bms-selectedcritere.'+val).css({'background':'url('+urlbms+'images/croix-grise-hover.png) no-repeat 95% center'});
			}
			else if (bmscrosscolorhover == 'White')
			{
					$('a.bms-selectedcritere.'+val).css({'background':'url('+urlbms+'images/croix-blanche.png) no-repeat 95% center'});
			}
			else if (bmscrosscolorhover == 'Grey')
			{
					$('a.bms-selectedcritere.'+val).css({'background':'url('+urlbms+'images/croix-grise.png) no-repeat 95% center'});
			}
			$('a.bms-selectedcritere.'+val).animate({ backgroundColor:bmsselectedcriterehovercl},50);
	});
	$('a.bms-selectedcritere').on('mouseleave',function(){
			//recupere la derniere classe
			var val = $(this).attr("class").split(' ').slice(-1);
			var bmsselectorhovercl = admin_info.bmscolorselectorhover;
			var bmscrosscolor = admin_info.bmscrosscolor;
			var urlbms2 = admin_info.bmsurl;
			if (bmscrosscolor == 'Dark Grey')
			{
					$('a.bms-selectedcritere.'+val).css({'background':'url('+urlbms2+'images/croix-grise-hover.png) no-repeat 95% center'});
			}
			else if (bmscrosscolor == 'White')
			{
					$('a.bms-selectedcritere.'+val).css({'background':'url('+urlbms2+'images/croix-blanche.png) no-repeat 95% center'});
			} 
			else if (bmscrosscolor == 'Grey')
			{
					$('a.bms-selectedcritere.'+val).css({'background':'url('+urlbms2+'images/croix-grise.png) no-repeat 95% center'});				
			}
			$('a.bms-selectedcritere.'+val).animate({ backgroundColor:bmsselectorhovercl},20);
	});
	/* selectionne tous les criteres hidden */
	if (($('#bms_crit_search_critere1').val()!='')&&($('#bms_crit_search_critere1').length)) {

        $('.bms-selectedcritere1').show();
        $('.bms-selectedcritere1').css({'display':'block'});
        $('.bms-cancelselectedcritere').show();
        $('.bms-cancelselectedcritere').css({'display':'block'});
	}
    if (($('#bms_crit_search_critere2').val()!='')&&($('#bms_crit_search_critere2').length)) {

        $('.bms-selectedcritere2').show();
        $('.bms-selectedcritere2').css({'display':'block'});
        $('.bms-cancelselectedcritere').show();
        $('.bms-cancelselectedcritere').css({'display':'block'});
    }
    if (($('#bms_crit_search_critere3').val()!='')&&($('#bms_crit_search_critere3').length)) {

        $('.bms-selectedcritere3').show();
        $('.bms-selectedcritere3').css({'display':'block'});
        $('.bms-cancelselectedcritere').show();
        $('.bms-cancelselectedcritere').css({'display':'block'});
    }
    if (($('#bms_crit_search_critere4').val()!='')&&($('#bms_crit_search_critere4').length)) {

        $('.bms-selectedcritere4').show();
        $('.bms-selectedcritere4').css({'display':'block'});
        $('.bms-cancelselectedcritere').show();
        $('.bms-cancelselectedcritere').css({'display':'block'});
    }
    if (($('#bms_crit_search_critere5').val()!='')&&($('#bms_crit_search_critere5').length)) {

        $('.bms-selectedcritere5').show();
        $('.bms-selectedcritere5').css({'display':'block'});
        $('.bms-cancelselectedcritere').show();
        $('.bms-cancelselectedcritere').css({'display':'block'});
    }
});
// fin doc ready
//The tricky thing is this particular copy of jQuery is in compatibility mode by default. That means that the typical '$' shortcut for jQuery doesn't work, 
//so it doesn't conflict with any other JavaScript libraries that use the dollar sign also, like MooTools or Prototype.
// Many plugin authors and theme developers are aware of this, and they use 'jQuery' instead of '$' to be safe.

function change_val_crit(critere,value,defaultcritere){
	/* on recupere la valeur clickée puis on la met dans un champ de critere de recherche hidden puis on lance la recherche qui
	met les champs hidden dans l url que l on reprend dans le champ hidden de la page a partir de l'url cette fois*/
	jQuery('#bms_crit_search_'+critere).val(value);
	/* jQuery('#selected'+critere).val(value); */
	jQuery('#default_critere').val(defaultcritere);
	/* site_info.wpurl et site_info.slugpagename sont declares dans beautiful_multiselect_search_scripts() du fichier beautiful-multiselect-search.php */
	/* search_beautiful_multiselect(site_info.wpurl+'/'+site_info.slugpagename+'/',defaultcritere); */
	/*tester si dernier caractere est / car si lon est pas en reecriture d url il n y a pas de / a la fin mais ?page_id=x */
	derniercaractere = site_info.sitepermalink.slice(-1);

	 /* si utilisation des permaliens*/
	if (site_info.usingpermalink==1)
	{

		if (derniercaractere=='/'){
			/* reecriture d url*/
			console.log(site_info.sitepermalink+'cpc_bms_searchr/'+defaultcritere);
			search_beautiful_multiselect(site_info.sitepermalink+'cpc_bms_searchr/',defaultcritere,1);
		}
		else {
			/* reecriture d url*/
			search_beautiful_multiselect(site_info.sitepermalink+'/cpc_bms_searchr/',defaultcritere,1);
		}
	}
	/* si pas d'utilisation des permaliens*/
	else {
		search_beautiful_multiselect(site_info.sitepermalink,defaultcritere,0);
	}
}
function search_beautiful_multiselect(url,defaultcritere,permal){
		var string_search=new Object();
		groups_hidden_crit = jQuery('[id^="bms_crit_search_critere"]');
		string_search_no_permalink="";
		jQuery.each(groups_hidden_crit, function(key, group) {
			if(jQuery(group).val()!=''){
					var nbr = jQuery(group).attr("id").slice(23);
					var crit = 'critere'+nbr;
					/* construction de la sequence a mettre dans l url si permalink*/
					string_search[crit]=jQuery('#bms_crit_search_critere'+nbr).val();
					/* construction de la sequence a mettre dans l url si pas de permalink*/
					string_search_no_permalink = string_search_no_permalink+"&"+crit+"="+string_search[crit];	
			}
		});
		console.log(string_search);
		/* construction de la sequence a mettre dans l url si permalink*/
		var url_serialize_crit_rech = serialize(string_search);
		console.log(url_serialize_crit_rech);
		/* corrige bug safari */
		url_serialize_crit_rech = url_serialize_crit_rech.replace("{","%7B");
		url_serialize_crit_rech = url_serialize_crit_rech.replace("}","%7D/");
    	url_serialize_crit_rech = url_serialize_crit_rech.replace(/"/g,"%22");
		/* si utilisation des permaliens */
		if (permal==1){
            console.log(url+defaultcritere+'/'+url_serialize_crit_rech);

			document.location=url+defaultcritere+'/'+url_serialize_crit_rech;
		}
		/* si pas d'utilisation des permaliens */
		else{
				document.location=url+'&defaultcrit='+defaultcritere+string_search_no_permalink;
		}	
}
function del_val_crit(critere,defaultcritere,permal){
	/* on recupere la valeur clickée puis on met a nul le champ de critere de recherche hidden correspondant puis on lance la recherche qui met
	les champs hidden dans l url avec la fonction js serialize que l on reprend dans le champ hiiden de la page*/
	jQuery('#bms_crit_search_'+critere).val('');
	derniercaractere = site_info.sitepermalink.slice(-1);
	/* si permalink */
	if(permal==1){
		if (derniercaractere=='/'){
			/* reecriture d url*/
			search_beautiful_multiselect(site_info.sitepermalink+'cpc_bms_searchr/',defaultcritere,1);
		}
		else {
			/* reecriture d url*/
			search_beautiful_multiselect(site_info.sitepermalink+'/cpc_bms_searchr/',defaultcritere,1);
		}
	}
	/* si pas permalink */
	else {
		search_beautiful_multiselect(site_info.sitepermalink,defaultcritere,0);
	}
}
function del_all_crit(defaultcritere,permal){
	group_hidden_crit = jQuery('[id^="bms_crit_search_critere"]');    
	jQuery.each(group_hidden_crit, function(key, group) {
		if(jQuery(group).val()!=''){
				jQuery(group).val('');		
		}
	});
	derniercaractere = site_info.sitepermalink.slice(-1);
	/* si permalink */
	if(permal==1){
		if (derniercaractere=='/'){
			/* reecriture d url*/
			search_beautiful_multiselect(site_info.sitepermalink+'cpc_bms_searchr/',defaultcritere,1);
		}
		else {
			/* reecriture d url*/
			search_beautiful_multiselect(site_info.sitepermalink+'/cpc_bms_searchr/',defaultcritere,1);
		}
	}
	/* si pas permalink */
	else {
		search_beautiful_multiselect(site_info.sitepermalink,defaultcritere,0);
	}
}