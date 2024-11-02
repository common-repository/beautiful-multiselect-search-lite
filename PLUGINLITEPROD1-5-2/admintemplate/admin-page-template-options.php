<?php

?><div class='wrap-options'>

	<?php 
	/***************************************************/
	/*                INITIALISATION                   */
	/***************************************************/
	$erroradminform=false;

	if (!isset($error_QM_border_radius)){$error_QM_border_radius=false;}
	if (!isset($error_questionmark_xshadow)){$error_questionmark_xshadow=false;}
	if (!isset($error_questionmark_yshadow)){$error_questionmark_yshadow=false;}
	if (!isset($error_pxmarginwithtitle)){$error_pxmarginwithtitle=false;}
	if (!isset($error_bulletwidth)){$error_bulletwidth=false;}

	/************************************************************************/
	/* CONTRÖLE DES ERREURS ENVOYEES PAR LE FORMULAIRE DES OPTIONS          */
	/************************************************************************/

	if (isset($_POST['bmsadmin-qmradius'])){
	    if ((!ctype_digit($_POST['bmsadmin-qmradius'])||(intval($_POST['bmsadmin-qmradius'])>50)||(intval($_POST['bmsadmin-qmradius'])<0))){
            $erroradminform = true;
            $error_QM_border_radius = true;
        }
	} 
	else {
		$error_QM_border_radius=false;
	}
	if (isset($_POST['bmsadmin-qmsdx'])){
        if ((!ctype_digit($_POST['bmsadmin-qmsdx'])||(intval($_POST['bmsadmin-qmsdx'])>9)||(intval($_POST['bmsadmin-qmsdx'])<0))) {
            $erroradminform = true;
            $error_questionmark_xshadow = true;
        }
	} 
	else {
		$error_questionmark_xshadow=false;
	}
    if (isset($_POST['bmsadmin-qmsdy'])){
        if ((!ctype_digit($_POST['bmsadmin-qmsdy'])||(intval($_POST['bmsadmin-qmsdy'])>9)||(intval($_POST['bmsadmin-qmsdy'])<0))) {
            $erroradminform = true;
            $error_questionmark_yshadow = true;
        }
    }
    else {
		$error_questionmark_yshadow=false;
	}
    if (isset($_POST['bmsadmin-qmmt'])){
        if ((!ctype_digit($_POST['bmsadmin-qmmt'])||(intval($_POST['bmsadmin-qmmt'])>99)||(intval($_POST['bmsadmin-qmmt'])<0))){
            $erroradminform=true;
            $error_pxmarginwithtitle=true;
        }
    }
	else {
		$error_pxmarginwithtitle=false;
	}
    if (isset($_POST['bmsadmin-bulletsize'])){
        if ((!ctype_digit($_POST['bmsadmin-bulletsize'])||(intval($_POST['bmsadmin-bulletsize'])>99)||(intval($_POST['bmsadmin-bulletsize'])<0))){
            $erroradminform=true;
            $error_bulletwidth=true;
        }
    }
	else {
		$error_bulletwidth=false;
	}
	/**********************************************/
	/* TRAITEMENT FORMULAIRE DES OPTIONS          */
	/**********************************************/
	if (isset($_POST['form-bms-adminoptionspage'])) {

        if (
                !isset($_POST['cpc_bms_nonce_form_adminoptions'])
                || !wp_verify_nonce($_POST['cpc_bms_nonce_form_adminoptions'], 'cpc_bms_saveform_adminoptions')
            ) {
                print 'Sorry, your nonce did not verify.';
                exit;
            } else {


                if ($erroradminform == false) {
                    if (isset($_POST['bmsadmin-crosscolor'])) {
                        $bms_options['crosscolor'] = sanitize_text_field($_POST['bmsadmin-crosscolor']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['crosscolor'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-qmsdcolor'])) {
                        $bms_options['qmsdcolor'] = sanitize_text_field($_POST['bmsadmin-qmsdcolor']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['qmsdcolor'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-qmmt'])) {
                        $bms_options['qmmt'] = intval($_POST['bmsadmin-qmmt']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['qmmt'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-qmsdbdcolor'])) {
                        $bms_options['qmsdbdcolor'] = sanitize_text_field($_POST['bmsadmin-qmsdbdcolor']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['qmsdbdcolor'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-qmsdx'])) {
                        $bms_options['qmsdx'] = intval($_POST['bmsadmin-qmsdx']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['qmsdx'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-qmsdy'])) {
                        $bms_options['qmsdy'] = intval($_POST['bmsadmin-qmsdy']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['qmsdy'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }

                    if (isset($_POST['bmsadmin-qmsd'])) {
                        $bms_options['qmsd'] = sanitize_text_field($_POST['bmsadmin-qmsd']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['qmsd'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-qmbg'])) {
                        $bms_options['qmbg'] = sanitize_text_field($_POST['bmsadmin-qmbg']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['qmbg'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if ((isset($_POST['bmsadmin-qmradius'])) && ($erroradminform == false)) {
                        $bms_options['qmradius'] = intval($_POST['bmsadmin-qmradius']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } elseif (($_POST['bmsadmin-qmradius']) == '' && ($erroradminform == false)) {
                        $bms_options['qmradius'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-noqm'])) {
                        $bms_options['noqm'] = sanitize_text_field($_POST['bmsadmin-noqm']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['noqm'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-qmcolor'])) {
                        $bms_options['qmcolor'] = sanitize_text_field($_POST['bmsadmin-qmcolor']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['qmcolor'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-crosscolorhover'])) {
                        $bms_options['crosscolorhover'] = sanitize_text_field($_POST['bmsadmin-crosscolorhover']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['crosscolorhover'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-bullet']) && $_POST['bmsadmin-bullet'] == "square") {
                        $bms_options['bulletsquare'] = "yes";
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['bulletsquare'] = "";
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-bullet']) && $_POST['bmsadmin-bullet'] == "circle") {
                        $bms_options['bulletcircle'] = "yes";
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['bulletcircle'] = "";
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-bulletsize'])) {
                        $bms_options['bulletsize'] = intval($_POST['bmsadmin-bulletsize']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['bulletsize'] = "";
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-selectorhovercolor'])) {
                        $bms_options['selectorhovercolor'] = sanitize_text_field($_POST['bmsadmin-selectorhovercolor']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['selectorhovercolor'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-selectorhoverbordercolor'])) {
                        $bms_options['selectorhoverbordercolor'] = sanitize_text_field($_POST['bmsadmin-selectorhoverbordercolor']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['selectorhoverbordercolor'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-selectorcolor'])) {
                        $bms_options['selectorcolor'] = sanitize_text_field($_POST['bmsadmin-selectorcolor']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['selectorcolor'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-titletexte'])) {
                        $bms_options['titletexte'] = sanitize_text_field($_POST['bmsadmin-titletexte']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['titletexte'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-titleborder'])) {
                        $bms_options['titleborder'] = sanitize_text_field($_POST['bmsadmin-titleborder']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['titleborder'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-maincategorytexte'])) {
                        $bms_options['maincategorytexte'] = sanitize_text_field($_POST['bmsadmin-maincategorytexte']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['maincategorytexte'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-titleselectedcriteretexte'])) {
                        $bms_options['titleselectedcriteretexte'] = sanitize_text_field($_POST['bmsadmin-titleselectedcriteretexte']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['titleselectedcriteretexte'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-selectedcriteretexte'])) {
                        $bms_options['selectedcriteretexte'] = sanitize_text_field($_POST['bmsadmin-selectedcriteretexte']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['selectedcriteretexte'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-criteretexte'])) {
                        $bms_options['criteretexte'] = sanitize_text_field($_POST['bmsadmin-criteretexte']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['criteretexte'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-selectedcriteretextehover'])) {
                        $bms_options['selectedcriteretextehover'] = sanitize_text_field($_POST['bmsadmin-selectedcriteretextehover']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['selectedcriteretextehover'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-selectedcriterehovercolor'])) {
                        $bms_options['selectedcriterehovercolor'] = sanitize_text_field($_POST['bmsadmin-selectedcriterehovercolor']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['selectedcriterehovercolor'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-selectedcriterebordercolor'])) {
                        $bms_options['selectedcriterebordercolor'] = sanitize_text_field($_POST['bmsadmin-selectedcriterebordercolor']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['selectedcriterebordercolor'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-cancelselectedcriteretexte'])) {
                        $bms_options['cancelselectedcriteretexte'] = sanitize_text_field($_POST['bmsadmin-cancelselectedcriteretexte']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['cancelselectedcriteretexte'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-cancelselectedcriterebg'])) {
                        $bms_options['cancelselectedcriterebg'] = sanitize_text_field($_POST['bmsadmin-cancelselectedcriterebg']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['cancelselectedcriterebg'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-cancelselectedcritereborder'])) {
                        $bms_options['cancelselectedcritereborder'] = sanitize_text_field($_POST['bmsadmin-cancelselectedcritereborder']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['cancelselectedcritereborder'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-critereborder'])) {
                        $bms_options['critereborder'] = sanitize_text_field($_POST['bmsadmin-critereborder']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['critereborder'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-disablecritpicto'])) {
                        $bms_options['disablecritpicto'] = sanitize_text_field($_POST['bmsadmin-disablecritpicto']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['disablecritpicto'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                    if (isset($_POST['bmsadmin-fulltextpicto'])) {
                        $bms_options['fulltextpicto'] = sanitize_text_field($_POST['bmsadmin-fulltextpicto']);
                        update_option('cpc_bms_admin_options', $bms_options);
                    } else {
                        $bms_options['fulltextpicto'] = '';
                        update_option('cpc_bms_admin_options', $bms_options);
                    }
                }
            }
    }
	?>
		<!--
		---------------------------------------------
		---------------------------------------------
		AFFICHAGE DU FORMULAIRE LOAD PREDEFINED THEME 
		---------------------------------------------	
		---------------------------------------------
		-->
		<div class="ligne"></div><br>
		<div><?php _e('LOAD A PREDEFINED THEME','beautifulmultiselectsearch'); ?></div><br>
		<form class="adminthemesform" action="" method="post">
			<select id="bmsadmin-loadtheme" name="bmsadmin-loadtheme">
					<option></option>
					<option>Minimal Theme</option>
					<option>Orange Juice Theme</option>
			</select>

			<a style="margin-left: 10px;" href="<?php print(cpc_bms_PRO_VERSION_URL); ?>" target="blank"><?php _e('More Themes...','beautifulmultiselectsearch'); ?></a>
			<br><br>
			<input type="submit" class='button-primary' name="cpc_bms_form-adminoptionsloadtheme" id="cpc_bms_form-adminoptionsloadtheme" value="<?php esc_attr_e('Loading&#8230;'); ?>" />
		</form>
		<br><br>
		<?php
		/***************************************************/
		/* TRAITEMENT FORMULAIRE LOAD PREDEFINED THEME     */
		/***************************************************/
		if (isset($_POST['cpc_bms_form-adminoptionsloadtheme'])){
			if ($_POST['bmsadmin-loadtheme']=='Minimal Theme'){
				cpc_bms_Beautiful_Multiselect_Search_Admin::cpc_bms_loadbmstheme($minimalbmsthemearray,"cpc_bms_admin_options");
			}
			if ($_POST['bmsadmin-loadtheme']=='Orange Juice Theme'){
                cpc_bms_Beautiful_Multiselect_Search_Admin::cpc_bms_loadbmstheme($orangejuicebmsthemearray,"cpc_bms_admin_options");
			}
		}
		/***************************************************/
		/* TRAITEMENT FORMULAIRE CLEAR ALL VALUES          */
		/***************************************************/
		if (isset($_POST['cpc_bms_form-dadminclearallvalues'])){
            cpc_bms_Beautiful_Multiselect_Search_Admin::cpc_bms_reset_admin_options();
		}
		//---------------------------------------------------------------------------------------------------//
		//---------------------------------------------------------------------------------------------------//
		// récuperation des variables en base de données après la réception du formulaire et le traitement   //
		//---------------------------------------------------------------------------------------------------//
		//---------------------------------------------------------------------------------------------------//
		$bms_get_options=get_option('cpc_bms_admin_options'); ?>
		<!--
		--------------------------------------
		--------------------------------------
		AFFICHAGE DU FORMULAIRE DES OPTIONS 
		--------------------------------------	
		--------------------------------------
		-->
		<div class="ligne"></div><br>
		<?php 
		//-------------------------------
		// affichage message d'erreur  
		//-------------------------------
		if ($erroradminform==true) {
			echo '<span class="advancedadminerror">';
			_e('SAVE FAILED');
			echo '</span>';
			echo '<br><br>';
		}
		?>
		<div><?php _e('CHANGE COLORS','beautifulmultiselectsearch'); ?></div>
		<br>
		<form class="adminoptionsform" action="" method="post">
		<input type="submit" class='button-primary' name="form-bms-adminoptionspage" id="form-bms-adminoptionspage" value="<?php esc_attr_e('Save Changes'); ?>" /><br><br>
			<div class="colonne">
				<h4><?php _e('Bullet','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-selectorcolor" value="<?php if(isset($bms_get_options['selectorcolor'])){echo esc_textarea(htmlspecialchars($bms_get_options['selectorcolor']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Bullet Hover and Selected Criteria BG','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-selectorhovercolor" value="<?php if(isset($bms_get_options['selectorhovercolor'])){echo esc_textarea(htmlspecialchars($bms_get_options['selectorhovercolor']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Bullet Border and Criteria Bottom Border','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-critereborder" value="<?php if(isset($bms_get_options['critereborder'])){echo esc_textarea(htmlspecialchars($bms_get_options['critereborder']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Bullet Border Hover','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-selectorhoverbordercolor" value="<?php if(isset($bms_get_options['selectorhoverbordercolor'])){echo esc_textarea(htmlspecialchars($bms_get_options['selectorhoverbordercolor']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Title Text','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-titletexte" value="<?php if(isset($bms_get_options['titletexte'])){echo esc_textarea(htmlspecialchars($bms_get_options['titletexte']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Title Border','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-titleborder" value="<?php if(isset($bms_get_options['titleborder'])){echo esc_textarea(htmlspecialchars($bms_get_options['titleborder']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Main Category Text','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-maincategorytexte" value="<?php if(isset($bms_get_options['maincategorytexte'])){echo esc_textarea(htmlspecialchars($bms_get_options['maincategorytexte']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Criteria Text','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-criteretexte" value="<?php if(isset($bms_get_options['criteretexte'])){echo esc_textarea(htmlspecialchars($bms_get_options['criteretexte']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Disable Criteria Check Picto','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-disablecritpicto" value="<?php if(isset($bms_get_options['disablecritpicto'])){echo esc_textarea(htmlspecialchars($bms_get_options['disablecritpicto']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('FullTextSearch Picto','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-fulltextpicto" value="<?php if(isset($bms_get_options['fulltextpicto'])){echo esc_textarea(htmlspecialchars($bms_get_options['fulltextpicto']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Title Selected Criteria Text','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-titleselectedcriteretexte" value="<?php if(isset($bms_get_options['titleselectedcriteretexte'])){echo esc_textarea(htmlspecialchars($bms_get_options['titleselectedcriteretexte']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<br><br><input type="submit" class='button-primary' name="form-bms-adminoptionspage" value="<?php esc_attr_e('Save Changes'); ?>" /><br><br>
			<div class="colonne">
				<h4><?php _e('Selected Criteria Text','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-selectedcriteretexte" value="<?php if(isset($bms_get_options['selectedcriteretexte'])){echo esc_textarea(htmlspecialchars($bms_get_options['selectedcriteretexte']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Selected Criteria Text Hover','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-selectedcriteretextehover" value="<?php if(isset($bms_get_options['selectedcriteretextehover'])){echo esc_textarea(htmlspecialchars($bms_get_options['selectedcriteretextehover']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Selected Criteria Border','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-selectedcriterebordercolor" value="<?php if(isset($bms_get_options['selectedcriterebordercolor'])){echo esc_textarea(htmlspecialchars($bms_get_options['selectedcriterebordercolor']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Selected Criteria BG Hover','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-selectedcriterehovercolor" value="<?php if(isset($bms_get_options['selectedcriterehovercolor'])){echo esc_textarea(htmlspecialchars($bms_get_options['selectedcriterehovercolor']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Cancel Selected Criteria Text','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-cancelselectedcriteretexte" value="<?php if(isset($bms_get_options['cancelselectedcriteretexte'])){echo esc_textarea(htmlspecialchars($bms_get_options['cancelselectedcriteretexte']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Cancel Selected Criteria BG','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-cancelselectedcriterebg" value="<?php if(isset($bms_get_options['cancelselectedcriterebg'])){echo esc_textarea(htmlspecialchars($bms_get_options['cancelselectedcriterebg']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Cancel Selected Criteria Border','beautifulmultiselectsearch'); ?></h4><br>
					<input type="text" name="bmsadmin-cancelselectedcritereborder" value="<?php if(isset($bms_get_options['cancelselectedcritereborder'])){echo esc_textarea(htmlspecialchars($bms_get_options['cancelselectedcritereborder']));} ?>" class="bms-color-field" data-default-color="" /><br>
			</div>
		<br><br>
		<?php
		if(isset($bms_get_options['crosscolor'])){$crosscolorselected = sanitize_text_field(htmlspecialchars($bms_get_options['crosscolor']));}else{$crosscolorselected="";}
		if(isset($bms_get_options['crosscolorhover'])){$crosscolorhoverselected = sanitize_text_field(htmlspecialchars($bms_get_options['crosscolorhover']));}else{$crosscolorhoverselected="";}
		if(isset($bms_get_options['bulletsquare'])){$bulletsquare = sanitize_text_field(htmlspecialchars($bms_get_options['bulletsquare']));}else{$bulletsquare="";}
		if(isset($bms_get_options['bulletcircle'])){$bulletcircle = sanitize_text_field(htmlspecialchars($bms_get_options['bulletcircle']));}else{$bulletcircle="";}
		if(isset($bms_get_options['qmcolor'])){$qmcolor = sanitize_text_field(htmlspecialchars($bms_get_options['qmcolor']));}else{$qmcolor="";}
		if(isset($bms_get_options['noqm'])){$noqm = sanitize_text_field(htmlspecialchars($bms_get_options['noqm']));}else{$noqm="";}
		if(isset($bms_get_options['qmsd'])){$qmsd = sanitize_text_field(htmlspecialchars($bms_get_options['qmsd']));}else{$qmsd="";}
		?>
		<input type="submit" class='button-primary' name="form-bms-adminoptionspage" value="<?php esc_attr_e('Save Changes'); ?>" /><br><br>
		<div class="colonne">
			<h4><?php _e('Bullet','beautifulmultiselectsearch'); ?></h4>
			<input type="radio" name="bmsadmin-bullet" <?php if($bulletsquare == 'yes'){echo('checked="checked"');}?>  value="square">
						<label for="square"><?php _e('Square','beautifulmultiselectsearch'); ?></label>
			</input>
			<input type="radio" name="bmsadmin-bullet" <?php if($bulletcircle == 'yes'){echo('checked="checked"');}?> value="circle">
						<label for="square"><?php _e('Circle','beautifulmultiselectsearch'); ?></label>
			</input><br><br>
			<?php _e('Width','beautifulmultiselectsearch'); ?>
			<input type="text" size="2" name="bmsadmin-bulletsize" value="<?php echo intval(htmlspecialchars($bms_get_options['bulletsize'])); ?>"  /> px <?php _e('(0 to 99)','beautifulmultiselectsearch'); ?><br>
			<?php
					if (isset($error_bulletwidth)){
						if ($error_bulletwidth==true) {
							echo '<span class="advancedadminerror">';
							_e('! Please enter a number between 0 and 99','beautifulmultiselectsearch');
							echo '</span>';
							echo '<br>';
						}
					}
				?>
		</div>
		<div class="colonne">
				<h4><?php _e('Selected Criteria Cross Color','beautifulmultiselectsearch'); ?></h4>
				<select id="bmsadmin-crosscolor" name="bmsadmin-crosscolor">
					<option <?php if($crosscolorselected == 'Dark Grey'){echo("selected");}?>>Dark Grey</option>
					<option <?php if($crosscolorselected == 'White'){echo("selected");}?>>White</option>
					<option <?php if($crosscolorselected == 'Grey'){echo("selected");}?>>Grey</option>
					<option <?php if($crosscolorselected == ''){echo("selected");}?>></option>
				</select><br>
		</div>
		<div class="colonne">
				<h4><?php _e('Selected Criteria Cross Color Hover','beautifulmultiselectsearch'); ?></h4>
				<select id="bmsadmin-crosscolorhover" name="bmsadmin-crosscolorhover">
					<option <?php if($crosscolorhoverselected == 'Dark Grey'){echo("selected");}?>>Dark Grey</option>
					<option <?php if($crosscolorhoverselected == 'White'){echo("selected");}?>>White</option>
					<option <?php if($crosscolorhoverselected == 'Grey'){echo("selected");}?>>Grey</option>
					<option <?php if($crosscolorhoverselected == ''){echo("selected");}?>></option>
				</select><br>
		</div>
		<div class="colonne">
				<h4><?php _e('Question Mark Color','beautifulmultiselectsearch'); ?></h4>
				<select id="bmsadmin-qmcolor" name="bmsadmin-qmcolor">
					<option <?php if($qmcolor == 'White'){echo("selected");}?>>White</option>
					<option <?php if($qmcolor == 'Grey'){echo("selected");}?>>Grey</option>
					<option <?php if($qmcolor == 'Black'){echo("selected");}?>>Black</option>
				</select>
				<h4><?php _e('Question Mark BG Color','beautifulmultiselectsearch'); ?></h4>
					<input type="text" name="bmsadmin-qmbg" value="<?php echo sanitize_text_field(htmlspecialchars($bms_get_options['qmbg'])); ?>" class="bms-color-field" data-default-color="" /><br>
				<h4><?php _e('Question Mark Border Color','beautifulmultiselectsearch'); ?></h4>
				<input type="text" name="bmsadmin-qmsdbdcolor" value="<?php echo sanitize_text_field(htmlspecialchars($bms_get_options['qmsdbdcolor'])); ?>" class="bms-color-field" data-default-color="" /><br>
				<h4><?php _e('Question Mark Border Radius','beautifulmultiselectsearch'); ?></h4>
				0 to 50 (0=square, 50=circle)<br>
				<?php
					if (isset($error_QM_border_radius)){
						if ($error_QM_border_radius==true) {
							echo '<span class="advancedadminerror">';
							_e('! Please enter a number between 0 and 50','beautifulmultiselectsearch');
							echo '</span>';
							echo '<br>';
						}
					}
				?>
				<input type="text" size="2" name="bmsadmin-qmradius" value="<?php
					if (isset($bms_get_options['qmradius'])){
						echo intval($bms_get_options['qmradius']);
					}
				?>"  /> %<br><br>
				<?php 
					if (isset($_POST['bmsadmin-qmradius'])){
						if ((($_POST['bmsadmin-qmradius']!='')&&(!preg_match('#^[0-9]{1}$|^[0-9]{2}$#',$_POST['bmsadmin-qmradius'])))||($_POST['bmsadmin-qmradius']>50)) {
							$erroradminform=true;
						}
					}
				?>
				<?php
					if (isset($error_pxmarginwithtitle)){
						if ($error_pxmarginwithtitle==true) {
							echo '<span class="advancedadminerror">';
							_e('! Please enter a number between 0 and 99','beautifulmultiselectsearch');
							echo '</span>';
							echo '<br>';
						}
					}
				?>
				<input type="text" size="2" name="bmsadmin-qmmt" value="<?php echo intval(htmlspecialchars($bms_get_options['qmmt'])); ?>"  /> px - <?php _e('margin with title (0 to 99)','beautifulmultiselectsearch'); ?><br><br>
				<?php 
					if (isset($_POST['bmsadmin-qmmt'])){
						if (($_POST['bmsadmin-qmmt']!='')&&(!preg_match('#^[0-9]{1}$|^[0-9]{2}$#',$_POST['bmsadmin-qmmt']))) {
						$erroradminform=true;
					}
				}?>
				<input type="checkbox" name="bmsadmin-noqm" id="bmsadmin-noqm" <?php if($noqm == 'on'){echo("checked='checked'");}?>><label for="bmsadmin-noqm"><?php _e('No Question Mark','beautifulmultiselectsearch'); ?></label>
				<h4><?php _e('Question Mark Shadow','beautifulmultiselectsearch'); ?></h4>
				<input type="checkbox" name="bmsadmin-qmsd" id="bmsadmin-qmsd" <?php if($qmsd == 'on'){echo("checked='checked'");}?>><label for="bmsadmin-qmsd"><?php _e('Question Mark Shadow','beautifulmultiselectsearch'); ?></label><br><br>
				<input type="text" name="bmsadmin-qmsdcolor" value="<?php echo sanitize_text_field(htmlspecialchars($bms_get_options['qmsdcolor'])); ?>" class="bms-color-field" data-default-color="" /><br>
				<?php
				if (isset($error_questionmark_xshadow)){
					if ($error_questionmark_xshadow) {
							echo '<span class="advancedadminerror">';
							_e('! Please enter a number between 0 and 9','beautifulmultiselectsearch');
							echo '</span>';
							echo '<br>';
					}
				}
				?>
				<input type="text" size="2" name="bmsadmin-qmsdx" value="<?php echo intval($bms_get_options['qmsdx']); ?>"  /> px - x <?php _e('shadow','beautifulmultiselectsearch'); ?>(0 to 9)<br><br>
				<?php
				if (isset($error_questionmark_yshadow)){
					if ($error_questionmark_yshadow==true) {
						echo '<span class="advancedadminerror">';
						_e('! Please enter a number between 0 and 9','beautifulmultiselectsearch');
						echo '</span>';
						echo '<br>';
					}
				}
				?>
				<input type="text" size="2" name="bmsadmin-qmsdy" value="<?php echo intval($bms_get_options['qmsdy']); ?>"  /> px - y <?php _e('shadow','beautifulmultiselectsearch'); ?>(0 to 9)<br><br>
		</div><br><br>
		<input type="submit" class='button-primary' name="form-bms-adminoptionspage" value="<?php esc_attr_e('Save Changes'); ?>" />

            <?php wp_nonce_field( 'cpc_bms_saveform_adminoptions', 'cpc_bms_nonce_form_adminoptions' ); ?>

        </form>
		<br>
		<!--
		--------------------------------------
		--------------------------------------
		AFFICHAGE DU FORMULAIRE CLEAR ALL VALUES
		--------------------------------------	
		--------------------------------------
		-->
		<div class="ligne"></div>
		<br>
		<div><?php _e('CLEAR ALL VALUES','beautifulmultiselectsearch'); ?></div>
		<br>
		<form class="advancedadminoptionsform" action="" method="post">
		<input type="submit" class="button-primary"  name="cpc_bms_form-dadminclearallvalues" id="cpc_bms_form-dadminclearallvalues" value="<?php esc_attr_e('Delete'); ?>" />
		</form>
		<br><br><br>
	<!----------------------->
	<!---- TRAITEMENTS ------>
	<!----------------------->
	<?php
	if (isset($_GET['clearoptions'])){
		if ($_GET['clearoptions']=='yes') {
			$my_post = array(
					  'post_type'	  => 'page',
					  'post_title'    => 'Beautiful Multiselect Search1',
					  'post_content'  => '',
					  'post_status'   => 'publish',
					  'post_author'   => 1,
					  'page_template'  => 'template-beautiful-multiselect-search1.php'
					);
					// Insert the post into the database
			wp_insert_post( $my_post );
            cpc_bms_Beautiful_Multiselect_Search_Admin::reset_cpc_bms_admin_options();
		}
	}
	?>
    <div class="colonne">
        <h4><?php _e('Send your theme and contribute to the color theme library. Copy and paste the following text and send it to contact@100p100digital.com, you can suggest a name for your theme, thank you !!!! :-) ','beautifulmultiselectsearch'); ?></h4>
        <? if (get_option('cpc_bms_admin_options')){
            $cpc_bms_admin_alloptions=get_option('cpc_bms_admin_options');
            foreach ($cpc_bms_admin_alloptions as $key => $value){
                echo(esc_textarea($key).' '.esc_textarea($value).'<br>');
            }
        } ?>
        <br>
    </div>
</div>