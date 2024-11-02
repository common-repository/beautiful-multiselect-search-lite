<div class='wrap-options'>

	<?php
		/***************************************************/
		/*                INITIALISATION                   */
		/***************************************************/
		if(!isset($erroradmintextform)){$erroradmintextform=false;}
	?>
	
	<?php 
	/*****************************************************/
	/* TRAITEMENT ENVOIE FORMULAIRE TEXT MODIFICATION    */
	/*****************************************************/
    if (isset($_POST['form-bms-admintextmodpage'])){
        if (
            ! isset( $_POST['cpc_bms_nonce_form_textmodifications_admin'] )
            || ! wp_verify_nonce( $_POST['cpc_bms_nonce_form_textmodifications_admin'], 'cpc_bms_saveform_textmodifications_admin' )
        ) {
            print 'Sorry, your nonce did not verify.';
            exit;
        } else {

            if ($erroradmintextform == false) {

                /* suppression traitement gfont */

                if ($_POST['bmstext-search_selection']) {
                    $bms_options['search_selection'] = wp_kses_post($_POST['bmstext-search_selection']);
                    update_option('cpc_bms_admin_text_mod', $bms_options);
                } else {
                    $bms_options['search_selection'] = '';
                    update_option('cpc_bms_admin_text_mod', $bms_options);
                }
                if ($_POST['bmstext-search_erase']) {
                    $bms_options['search_erase'] = wp_kses_post($_POST['bmstext-search_erase']);
                    update_option('cpc_bms_admin_text_mod', $bms_options);
                } else {
                    $bms_options['search_erase'] = '';
                    update_option('cpc_bms_admin_text_mod', $bms_options);
                }
                if ($_POST['bmstext-result_header']) {
                    $bms_options['result_header'] = wp_kses_post($_POST['bmstext-result_header']);
                    update_option('cpc_bms_admin_text_mod', $bms_options);
                } else {
                    $bms_options['result_header'] = '';
                    update_option('cpc_bms_admin_text_mod', $bms_options);
                }
                if ($_POST['bmstext-result_more']) {
                    $bms_options['result_more'] = wp_kses_post($_POST['bmstext-result_more']);
                    update_option('cpc_bms_admin_text_mod', $bms_options);
                } else {
                    $bms_options['result_more'] = '';
                    update_option('cpc_bms_admin_text_mod', $bms_options);
                }

            }
        }
    }

	/***************************************************/
	/* TRAITEMENT FORMULAIRE CLEAR ALL VALUES          */
	/***************************************************/
	if (isset($_POST['cpc_bms_form-textadminclearallvalues'])){
        cpc_bms_Beautiful_Multiselect_Search_Admin::cpc_bms_reset_text_modifications();
	}
	?>
	<?php
	//------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------
	// récuperation des variables en base de données après la réception du formulaire et le traitement
	//------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------
	$bms_get_textmod=get_option('cpc_bms_admin_text_mod');
	?>
	<!--
	--------------------------------------
	--------------------------------------
	AFFICHAGE FORMULAIRE TEXT MODIFICATION
	--------------------------------------	
	--------------------------------------
	-->
	<div class="ligne"></div><br>
	<div><?php _e('CHANGE COLORS','beautifulmultiselectsearch'); ?></div>
	<br>
	<form class="admintextmodificationform" action="" method="post">

		<input type="submit" class='button-primary' name="form-bms-admintextmodpage" id="form-bms-admintextmodpage" value="<?php esc_attr_e('Save Changes'); ?>" /><br><br>
		<div class="colonne">
				<h4><?php _e('SEARCH COLOMN TEXT MODIFICATION','beautifulmultiselectsearch'); ?></h4>
					<input type="text" size="24" maxlength="24" name="bmstext-search_selection" value="<?php if(isset($bms_get_textmod['search_selection'])){echo htmlspecialchars($bms_get_textmod['search_selection']);} ?>" placeholder="YOUR SELECTION"/><br>

					<?php
						if(isset($bms_get_textmod['search_gfontname'])){$search_text_gfontname = $bms_get_textmod['search_gfontname'];}else{$search_text_gfontname="";}
						if(isset($bms_get_textmod['search_fontsize'])){$search_text_fontsize = $bms_get_textmod['search_fontsize'];}else{$search_text_fontsize="";}
						if(isset($bms_get_textmod['search_fontweight'])){$search_text_fontweight = $bms_get_textmod['search_fontweight'];}else{$search_text_fontweight="";}
					?>
					<input type="text" size="24" maxlength="34" name="bmstext-search_erase" value="<?php if(isset($bms_get_textmod['search_erase'])){echo htmlspecialchars($bms_get_textmod['search_erase']);} ?>" placeholder="DELETE ALL CRITERIAS"/><br>



		</div>
		<div class="colonne">
				<h4><?php _e('RESULT COLOMN TEXT MODIFICATION','beautifulmultiselectsearch'); ?></h4>
					<input type="text" size="80" maxlength="90" name="bmstext-result_header" value="<?php if(isset($bms_get_textmod['result_header'])){echo htmlspecialchars($bms_get_textmod['result_header']);} ?>" placeholder="Search results" /><br>
					<input size="24" type="text" maxlength="24" name="bmstext-result_more" value="<?php if(isset($bms_get_textmod['result_more'])){echo htmlspecialchars($bms_get_textmod['result_more']);} ?>" placeholder="Read more"/><br>
		</div>
        <?php wp_nonce_field( 'cpc_bms_saveform_textmodifications_admin', 'cpc_bms_nonce_form_textmodifications_admin' ); ?>

	</form>
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
		
		<input type="submit" class="button-primary"  name="cpc_bms_form-textadminclearallvalues" id="cpc_bms_form-textadminclearallvalues" value="<?php esc_attr_e('Delete'); ?>" />
		
		</form>

		<br><br><br>

</div>