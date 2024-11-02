<?php 

function cpc_bms_admin_head_custom_style(){
	$bms_get_options=get_option('cpc_bms_admin_options');
	$bms_get_aoptions=get_option('cpc_bms_advanced_admin_options');
	$bms_get_textmod=get_option('cpc_bms_admin_text_mod');
	echo '<style type="text/css">';
	echo'.bms-pictobtsearch {';
		if (isset($bms_get_options['fulltextpicto'])){
			if ($bms_get_options['fulltextpicto']) echo 'color:'.$bms_get_options['fulltextpicto'].';';
		}
	echo '} ';
	echo'.bms_disablepicto {';
		if (isset($bms_get_options['disablecritpicto'])){
			if ($bms_get_options['disablecritpicto']) echo 'color:'.$bms_get_options['disablecritpicto'].';';
		}
	echo '} ';
	echo'.ligne-bms .bms-search-wrap {';
		if ($bms_get_aoptions['widthsearchwrap']!='') echo 'width: '.$bms_get_aoptions['widthsearchwrap'].'%;';
		if ($bms_get_aoptions['bmssearchwrapfloat']!='') echo 'float: '.$bms_get_aoptions['bmssearchwrapfloat'].';';
		
	echo '} ';
	echo'.bms-point-interrogation {';
		if ($bms_get_options['noqm']=='on') echo 'display: none ;';
		if ($bms_get_options['qmradius']) echo 'border-radius:'.$bms_get_options['qmradius'].'%;';
		if ($bms_get_options['qmbg']) echo 'background-color:'.$bms_get_options['qmbg'].';';
		if ($bms_get_options['qmsdbdcolor']) echo 'border: 1px solid '.$bms_get_options['qmsdbdcolor'].';';
		if ($bms_get_options['qmmt']) echo 'margin-right: '.$bms_get_options['qmmt'].'px;';
		if (($bms_get_options['qmsd']=='on')&&($bms_get_options['qmsdcolor'])) echo '
		-moz-box-shadow: '.$bms_get_options['qmsdx'].'px '.$bms_get_options['qmsdy'].'px 5px 0px '.$bms_get_options['qmsdcolor'].';
		-webkit-box-shadow: '.$bms_get_options['qmsdx'].'px '.$bms_get_options['qmsdy'].'px 5px 0px '.$bms_get_options['qmsdcolor'].';
		-o-box-shadow: '.$bms_get_options['qmsdx'].'px '.$bms_get_options['qmsdy'].'px 5px 0px '.$bms_get_options['qmsdcolor'].';
		box-shadow: '.$bms_get_options['qmsdx'].'px '.$bms_get_options['qmsdy'].'px 5px 0px '.$bms_get_options['qmsdcolor'].';
		filter:progid:DXImageTransform.Microsoft.Shadow('.$bms_get_options['qmsdcolor'].', Direction=134, Strength=5);';
	echo '} ';
	echo'.ligne-bms .bms-result-wrap {';
		if ($bms_get_aoptions['widthresultwrap']!='') echo 'width: '.$bms_get_aoptions['widthresultwrap'].'%;';
	echo '} ';
	echo'.wrap-beautiful-multiselect-search {';
		if ($bms_get_aoptions['mtopbmswrap']!='') echo 'margin-top: '.$bms_get_aoptions['mtopbmswrap'].$bms_get_aoptions['mtopbmswrap_unit'].';';
		if ($bms_get_aoptions['mbottombmswrap']!='') echo 'margin-bottom: '.$bms_get_aoptions['mbottombmswrap'].$bms_get_aoptions['mbottombmswrap_unit'].';';
		if ($bms_get_aoptions['mrightbmswrap']!='') echo 'margin-right: '.$bms_get_aoptions['mrightbmswrap'].$bms_get_aoptions['mrightbmswrap_unit'].';';
		if ($bms_get_aoptions['mleftbmswrap']!='') echo 'margin-left: '.$bms_get_aoptions['mleftbmswrap'].$bms_get_aoptions['mleftbmswrap_unit'].';';
		if ($bms_get_aoptions['ptopbmswrap']!='') echo 'padding-top: '.$bms_get_aoptions['ptopbmswrap'].$bms_get_aoptions['ptopbmswrap_unit'].';';
	echo '} ';
	echo 'a.bms-selectedcritere {';
		if ($bms_get_options['crosscolor']!='') {
			switch ($bms_get_options['crosscolor']) {
				case 'White':
					echo 'background:url('.cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_URL.'images/croix-blanche.png) no-repeat 95% center; ';
				break;
				case 'Dark Grey':
					echo 'background:url('.cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_URL.'images/croix-grise-hover.png) no-repeat 95% center; ';
				break;
				case 'Grey':
					echo 'background:url('.cpc_bms_BEAUTIFUL_MULTISELECT_SEARCH_URL.'images/croix-grise.png) no-repeat 95% center; ';
				break;
			}
		}
		if ($bms_get_options['selectorhovercolor']!='') echo 'background-color: '.$bms_get_options['selectorhovercolor'].';';
		if ($bms_get_options['selectedcriterebordercolor']!='') echo 'border: 1px solid '.$bms_get_options['selectedcriterebordercolor'].'; ';
		if ($bms_get_options['selectedcriteretexte']!='') echo 'color:'.$bms_get_options['selectedcriteretexte'];
	echo '} ';
	echo 'a.bms-apageresultselected {';
		if ($bms_get_options['critereborder']!='') echo '; border-bottom: 1px solid '.$bms_get_options['critereborder'];
	echo '} ';
	echo'.bms-selecteur-sous-categorie {';

		if ($bms_get_options['selectorcolor']!='') echo 'background-color: '.$bms_get_options['selectorcolor'];
		if ($bms_get_options['critereborder']!='') echo '; border: 1px solid '.$bms_get_options['critereborder'];
		if ($bms_get_options['bulletsize']!='') {
			echo '; width: '.$bms_get_options['bulletsize'].'px ';
			echo '; height: '.$bms_get_options['bulletsize'].'px ';
			if ($bms_get_options['bulletcircle']!='') echo '; border-radius: '.$bms_get_options['bulletsize'].'px';
			if ($bms_get_options['bulletcircle']!='') echo '; -moz-border-radius: '.$bms_get_options['bulletsize'].'px';
			if ($bms_get_options['bulletcircle']!='') echo '; -webkit-border-radius: '.$bms_get_options['bulletsize'].'px';		
		}
	echo '} ';
	echo'ul.bms-critere-avec-sous-categorie {';
		if ($bms_get_options['maincategorytexte']!='') echo 'color: '.$bms_get_options['maincategorytexte'];
	echo '} ';
	echo'.bms-titrerecherche {';
		if ($bms_get_options['titleborder']!='') echo 'border-bottom: 1px dotted '.$bms_get_options['titleborder'];
	echo '} ';
	echo'ul.bms-critere-avec-sous-categorie li.bms-liavecsouscategorie {';
		if ($bms_get_options['critereborder']!='') echo 'border: 1px solid '.$bms_get_options['critereborder'];
	echo '; border-width: 1px 0px 0px 0px;} ';
	echo'ul.bms-critere-avec-sous-categorie, ul.bms-critere-sans-sous-categorie {';
		if ($bms_get_options['critereborder']!='') echo 'border: 1px solid '.$bms_get_options['critereborder'];
	echo '; border-width: 0px 0px 1px 0px;} ';
	echo'a.bms-sous-categorie {';
		if ($bms_get_options['criteretexte']!='') echo 'color: '. $bms_get_options['criteretexte'];
	echo '} ';
	echo'a.bms-sous-categorie span {';
	    if (isset($bms_get_aoptions['countcat'])) {
            if ($bms_get_aoptions['countcat'] != '') {
                if (isset($bms_get_options['predictcategory']) && ($bms_get_options['predictcategory'] != '')) {
                    echo 'color: ' . $bms_get_options['predictcategory'];
                }
            }
        }
	echo '} ';
	echo'a.bms-cancelselectedcritere {';
		if ($bms_get_options['cancelselectedcriteretexte']!='') echo 'color: '.$bms_get_options['cancelselectedcriteretexte'];
		if ($bms_get_options['cancelselectedcritereborder']!='') echo '; border: 1px solid '.$bms_get_options['cancelselectedcritereborder'];
		if ($bms_get_options['cancelselectedcriterebg']!='') echo '; background-color: '.$bms_get_options['cancelselectedcriterebg'];
	echo '} ';
	echo'.bms-titrerecherche .bmstitrerecherchetexte {';
		if ($bms_get_options['titletexte']!='') echo 'color: '.$bms_get_options['titletexte'];
	echo '} ';
	echo'.bms-rappel {';
		if ($bms_get_options['titleselectedcriteretexte']!='') echo 'color: '.$bms_get_options['titleselectedcriteretexte'];
	echo '} ';
	echo'a.bms-selectedcritere:hover {';
		if ($bms_get_options['selectedcriteretextehover']!='') echo 'color: '.$bms_get_options['selectedcriteretextehover'];
	echo '} ';
	echo '</style>';
}
add_action("wp_head", "cpc_bms_admin_head_custom_style");
?>