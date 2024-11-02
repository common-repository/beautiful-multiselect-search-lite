<?php
?><div class='wrap-options'>
	
	<?php
		/***************************************************/
		/*                INITIALISATION                   */
		/***************************************************/
        $erroradvancedadminform=false;
		$error_cpc_bms_erroraa1=false;
		$error_cpc_bms_erroraa2=false;
		$error_cpc_bms_erroraa3=false;
		$error_cpc_bms_erroraa4=false;
		/************************************************************************/
		/* CONTRÖLE DES ERREURS ENVOYEES PAR LE FORMULAIRE DES OPTIONS AVANCEES */
		/************************************************************************/
        if (isset($_POST['bmsadvancedadmin-widthsearchwrap'])){
            if (!ctype_digit($_POST['bmsadvancedadmin-widthsearchwrap'])||(intval($_POST['bmsadvancedadmin-widthsearchwrap'])>90)||(intval($_POST['bmsadvancedadmin-widthsearchwrap'])<10)) {
                $erroradvancedadminform=true;
                $error_cpc_bms_erroraa1=true;
            }
        }
		else {$error_cpc_bms_erroraa1=false;}
        if (isset($_POST['bmsadvancedadmin-widthresultwrap'])){
            if (!ctype_digit($_POST['bmsadvancedadmin-widthresultwrap'])||(intval($_POST['bmsadvancedadmin-widthresultwrap'])>90)||(intval($_POST['bmsadvancedadmin-widthresultwrap'])<10)) {
                $erroradvancedadminform=true;
                $error_cpc_bms_erroraa2=true;
            }
        }
		else {$error_cpc_bms_erroraa2=false;}
		if ((isset($_POST['bmsadvancedadmin-widthsearchwrap']))&&(isset($_POST['bmsadvancedadmin-widthresultwrap']))&&((intval($_POST['bmsadvancedadmin-widthsearchwrap'])+intval($_POST['bmsadvancedadmin-widthresultwrap']))>100)) {
			$erroradvancedadminform=true;
			$error_cpc_bms_erroraa3=true;
		}
		else {$error_cpc_bms_erroraa3=false;}
        if (isset($_POST['bmsadvancedadmin-nbcharresultpost'])&&($_POST['bmsadvancedadmin-nbcharresultpost']!="")){
            if (!ctype_digit($_POST['bmsadvancedadmin-nbcharresultpost'])||(intval($_POST['bmsadvancedadmin-nbcharresultpost'])<10)||(intval($_POST['bmsadvancedadmin-nbcharresultpost'])>9999)) {
                $erroradvancedadminform=true;
            }
        }
        if (isset($_POST['bmsadvancedadmin-mtopbmswrap'])&&($_POST['bmsadvancedadmin-mtopbmswrap']!="")){
            $cpc_ms_mtopbmswrap=$_POST['bmsadvancedadmin-mtopbmswrap'];
            $cpc_ms_mtopbmswrap_int=intval($_POST['bmsadvancedadmin-mtopbmswrap']);
            if ((!ctype_digit($cpc_ms_mtopbmswrap))||($cpc_ms_mtopbmswrap_int<0)||($cpc_ms_mtopbmswrap_int>9999)) {
                $erroradvancedadminform=true;
                $error_cpc_bms_erroraa4=true;
            }
        }
        else{$error_cpc_bms_erroraa4=false;}

        if (isset($_POST['bmsadvancedadmin-mbottombmswrap'])&&($_POST['bmsadvancedadmin-mbottombmswrap']!="")){
            $cpc_ms_mbottombmswrap=$_POST['bmsadvancedadmin-mbottombmswrap'];
            $cpc_ms_mbottombmswrap_int=intval($_POST['bmsadvancedadmin-mbottombmswrap']);
            if ((!ctype_digit($cpc_ms_mbottombmswrap))||($cpc_ms_mbottombmswrap_int<0)||($cpc_ms_mbottombmswrap_int>9999)) {
                $erroradvancedadminform=true;
            }
        }
        if (isset($_POST['bmsadvancedadmin-ptopbmswrap'])&&($_POST['bmsadvancedadmin-ptopbmswrap']!="")){
            $cpc_ms_ptopbmswrap=$_POST['bmsadvancedadmin-ptopbmswrap'];
            $cpc_ms_ptopbmswrap_int=intval($_POST['bmsadvancedadmin-ptopbmswrap']);
            if ((!ctype_digit($cpc_ms_ptopbmswrap))||($cpc_ms_ptopbmswrap_int<0)||($cpc_ms_ptopbmswrap_int>9999)) {
                $erroradvancedadminform=true;
            }
        }
        if (isset($_POST['bmsadvancedadmin-mleftbmswrap'])&&($_POST['bmsadvancedadmin-mleftbmswrap']!="")){
            $cpc_ms_mleftbmswrap=$_POST['bmsadvancedadmin-mleftbmswrap'];
            $cpc_ms_mleftbmswrap_int=intval($_POST['bmsadvancedadmin-mleftbmswrap']);
            if ((!ctype_digit($cpc_ms_mleftbmswrap))||($cpc_ms_mleftbmswrap_int<0)||($cpc_ms_mleftbmswrap_int>9999)) {
                $erroradvancedadminform=true;
            }
        }
        if (isset($_POST['bmsadvancedadmin-mrightbmswrap'])&&($_POST['bmsadvancedadmin-mrightbmswrap']!="")){
            $cpc_ms_mrightbmswrap=$_POST['bmsadvancedadmin-mrightbmswrap'];
            $cpc_ms_mrightbmswrap_int=intval($_POST['bmsadvancedadmin-mrightbmswrap']);
            if ((!ctype_digit($cpc_ms_mrightbmswrap))||($cpc_ms_mrightbmswrap_int<0)||($cpc_ms_mrightbmswrap_int>9999)) {
                $erroradvancedadminform=true;
            }
        }
		/**********************************************/
		/* TRAITEMENT FORMULAIRE DES OPTIONS AVANCEES */
		/**********************************************/
		if (isset($_POST['form-bms-advancedadminoptionspage'])){

            if (
                !isset($_POST['cpc_bms_nonce_form_aadminoptions'])
                || !wp_verify_nonce($_POST['cpc_bms_nonce_form_aadminoptions'], 'cpc_bms_saveform_aadminoptions')
            ) {
                print 'Sorry, your nonce did not verify.';
                exit;
            } else {
                if ($erroradvancedadminform == false) {
                    $bms_get_aoptions['resultpp'] = "";
                    if (isset($_POST['bmsadvancedadmin-bmssearchwrapfloat'])) {
                        $bms_a_options['bmssearchwrapfloat'] = sanitize_text_field($_POST['bmsadvancedadmin-bmssearchwrapfloat']);
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    } else {
                        $bms_a_options['bmssearchwrapfloat'] = '';
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    }
                    if (isset($_POST['bmsadvancedadmin-nbcharresultpost'])) {
                        $bms_a_options['nbchar'] = sanitize_text_field($_POST['bmsadvancedadmin-nbcharresultpost']);
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    } else {
                        $bms_a_options['nbchar'] = '';
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    }
                    if (isset($_POST['bmsadvancedadmin-showallpost'])) {
                        $bms_a_options['showallpost'] = sanitize_text_field($_POST['bmsadvancedadmin-showallpost']);
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    } else {
                        $bms_a_options['showallpost'] = '';
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    }
                    if (isset($_POST['bmsadvancedadmin-widthsearchwrap'])) {
                        $bms_a_options['widthsearchwrap'] = sanitize_text_field($_POST['bmsadvancedadmin-widthsearchwrap']);
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    } else {
                        $bms_a_options['widthsearchwrap'] = "";
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    }
                    if (isset($_POST['bmsadvancedadmin-widthresultwrap'])) {
                        $bms_a_options['widthresultwrap'] = sanitize_text_field($_POST['bmsadvancedadmin-widthresultwrap']);
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    } else {
                        $bms_a_options['widthresultwrap'] = "";
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    }
                    if (isset($_POST['bmsadvancedadmin-mtopbmswrap'])) {
                        $bms_a_options['mtopbmswrap'] = sanitize_text_field($_POST['bmsadvancedadmin-mtopbmswrap']);
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    } else {
                        $bms_a_options['mtopbmswrap'] = "";
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    }
                    if ($_POST['bmsadvancedadmin-mtopbmswrap_unit']) {
                        $bms_a_options['mtopbmswrap_unit'] = sanitize_text_field($_POST['bmsadvancedadmin-mtopbmswrap_unit']);
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    }
                    if (isset($_POST['bmsadvancedadmin-mbottombmswrap'])) {
                        $bms_a_options['mbottombmswrap'] = sanitize_text_field($_POST['bmsadvancedadmin-mbottombmswrap']);
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    } else {
                        $bms_a_options['mbottombmswrap'] = "";
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    }
                    if ($_POST['bmsadvancedadmin-mbottombmswrap_unit']) {
                        $bms_a_options['mbottombmswrap_unit'] = sanitize_text_field($_POST['bmsadvancedadmin-mbottombmswrap_unit']);
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    }
                    if (isset($_POST['bmsadvancedadmin-mrightbmswrap'])) {
                        $bms_a_options['mrightbmswrap'] = sanitize_text_field($_POST['bmsadvancedadmin-mrightbmswrap']);
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    } else {
                        $bms_a_options['mrightbmswrap'] = "";
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    }

                    if (isset($_POST['bmsadvancedadmin-mrightbmswrap_unit'])) {
                        $bms_a_options['mrightbmswrap_unit'] = sanitize_text_field($_POST['bmsadvancedadmin-mrightbmswrap_unit']);
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    }
                    if (isset($_POST['bmsadvancedadmin-ptopbmswrap'])) {
                        $bms_a_options['ptopbmswrap'] = sanitize_text_field($_POST['bmsadvancedadmin-ptopbmswrap']);
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    } else {
                        $bms_a_options['ptopbmswrap'] = "";
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    }
                    if (isset($_POST['bmsadvancedadmin-ptopbmswrap_unit'])) {
                        $bms_a_options['ptopbmswrap_unit'] = sanitize_text_field($_POST['bmsadvancedadmin-ptopbmswrap_unit']);
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    }

                    if (isset($_POST['bmsadvancedadmin-mleftbmswrap'])) {
                        $bms_a_options['mleftbmswrap'] = sanitize_text_field($_POST['bmsadvancedadmin-mleftbmswrap']);
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    } else {
                        $bms_a_options['mleftbmswrap'] = "";
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    }
                    if (isset($_POST['bmsadvancedadmin-mtopbmswrap_unit'])) {
                        $bms_a_options['mleftbmswrap_unit'] = sanitize_text_field($_POST['bmsadvancedadmin-mleftbmswrap_unit']);
                        update_option('cpc_bms_advanced_admin_options', $bms_a_options);
                    }
                }
            }
		}
		/**********************************************/
		/* TRAITEMENT FORMULAIRE LOAD MINIMAL CSS     */
		/**********************************************/
		
		if (isset($_POST['cpc_bms_form-advancedadminloadminimalcss'])){
			$error_cpc_bms_erroraa1=$error_cpc_bms_erroraa2=$error_cpc_bms_erroraa3=$error_cpc_bms_erroraa4=false;
            cpc_bms_Beautiful_Multiselect_Search_Admin::cpc_bms_loadbmstheme($minimalbmscssarray,"cpc_bms_advanced_admin_options");
		}
		
		//------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------
		// récuperation des variables en base de données après la réception du formulaire et le traitement
		//------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------
		$bms_get_aoptions=get_option('cpc_bms_advanced_admin_options'); 

		echo '<span>';
		_e('Please be sure that you have CSS knowledge before changing these parameters.','beautifulmultiselectsearch');
		echo '</span>';
		echo '<br>';
		echo '<br>';
		/* modification du code des options non disponible en version Lite */
		$bmspagination="";
		$bmscount="";
		$bmscountcat="";
		$bmsresultpp="";
		if (isset($bms_get_aoptions['showallpost'])){$bmsshowallpost= $bms_get_aoptions['showallpost'];}else{$bmsshowallpost="";}	
		?>
		<div class="ligne"></div><br>
		<!--
		-------------------------------------
		-------------------------------------
		AFFICHAGE FORMULAIRE LOAD MINIMAL CSS
		-------------------------------------	
		-------------------------------------
		-->
		<?php _e('LOAD MINIMAL Advanced CSS','beautifulmultiselectsearch'); ?><br><br>
		<div>
		<form class="advancedadminoptionsform" action="" method="post">
			<input type="submit" class="button-primary"  name="cpc_bms_form-advancedadminloadminimalcss" id="cpc_bms_form-advancedadminloadminimalcss" value="<?php esc_attr_e('Load'); ?>" /><br><br>
		</form>
		</div>
		<!--
		-------------------------------------
		-------------------------------------
		AFFICHAGE FORMULAIRE OPTIONS AVANCEES
		-------------------------------------	
		------------------------------------
		-->
		<div class="ligne"></div><br>
		<form class="advancedadminoptionsform" action="" method="post">

		<input type="submit" class='button-primary' name="form-bms-advancedadminoptionspage" id="form-bms-advancedadminoptionspage" value="<?php esc_attr_e('Save Changes'); ?>" /><br><br>

				<input type="text" size="4" name="bmsadvancedadmin-nbcharresultpost" value="<?php if(isset($bms_get_aoptions['nbchar'])){echo $bms_get_aoptions['nbchar'];} ?>"  /> <?php _e('Number of characters in the post result','beautifulmultiselectsearch'); ?> (10 - 9999)<br><br>
				<input type="checkbox" name="bmsadvancedadmin-showallpost" id="bmsadvancedadmin-showallpost" <?php if($bmsshowallpost == 'on'){echo("checked='checked'");}?>><label for="bmsadvancedadmin-showallpost"><?php _e('Show all the post characters within the search result','beautifulmultiselectsearch'); ?></label><br><br>
				
			<div class="colonne">
				<h4><?php _e('Search Wrap Width','beautifulmultiselectsearch'); ?></h4>
					<input type="text" size="2" name="bmsadvancedadmin-widthsearchwrap" value="<?php if (isset($bms_get_aoptions['widthsearchwrap'])){echo $bms_get_aoptions['widthsearchwrap'];} ?>" /> %<br>	
				<?php	
					
					if ($error_cpc_bms_erroraa1==true) {
						echo '<span class="advancedadminerror">';
						_e('! Please enter a number between 10 and 90','beautifulmultiselectsearch');
						echo '</span>';
						echo '<br>';
					}
				?>
			</div>
			<div class="colonne">
				<h4><?php _e('Result Wrap Width','beautifulmultiselectsearch'); ?></h4>
					<input type="text" size="2" name="bmsadvancedadmin-widthresultwrap" value="<?php if (isset($bms_get_aoptions['widthresultwrap'])){echo $bms_get_aoptions['widthresultwrap'];} ?>"  /> %<br>
				<?php
				
				if ($error_cpc_bms_erroraa2==true) {
						echo '<span class="advancedadminerror">';
						_e('! Please enter a number between 10 and 90','beautifulmultiselectsearch');
						echo '</span>';
						echo '<br>';
					}
				?>
			</div><br>
			<?php 
			if ($error_cpc_bms_erroraa3==true) {
				echo '<br>';
				echo '<span class="advancedadminerror">';
				_e('! The addition of Search Wrap Width and Result Wrap Widht must be <=100','beautifulmultiselectsearch');
				echo '</span>';
				echo '<br>';
			}
			if (($erroradvancedadminform==true)||($error_cpc_bms_erroraa3==true)||($error_cpc_bms_erroraa1==true)||($error_cpc_bms_erroraa2==true)||($error_cpc_bms_erroraa4==true)) {
				echo '<br>';
				echo '<span class="advancedadminerror">';
				_e('SAVE FAILED');
				echo '</span>';
				echo '<br>';
			}
			?>
			<br><br>
			<input type="submit" class='button-primary' name="form-bms-advancedadminoptionspage" value="<?php esc_attr_e('Save Changes'); ?>" /><br><br>
			<?php
				if (isset($bms_get_aoptions['mtopbmswrap_unit'])){$mwraptopunit = sanitize_text_field($bms_get_aoptions['mtopbmswrap_unit']);}else{$mwraptopunit="px";}
				if (isset($bms_get_aoptions['mbottombmswrap_unit'])){$mwrapbottomunit = sanitize_text_field($bms_get_aoptions['mbottombmswrap_unit']);}else{$mwrapbottomunit="px";}
				if (isset($bms_get_aoptions['mrightbmswrap_unit'])){$mwraprightunit = sanitize_text_field($bms_get_aoptions['mrightbmswrap_unit']);}else{$mwraprightunit="px";}
				if (isset($bms_get_aoptions['mleftbmswrap_unit'])){$mwrapleftunit = sanitize_text_field($bms_get_aoptions['mleftbmswrap_unit']);}else{$mwrapleftunit="px";}
				if (isset($bms_get_aoptions['ptopbmswrap_unit'])){$pwraptopunit = sanitize_text_field($bms_get_aoptions['ptopbmswrap_unit']);}else{$pwraptopunit="px";}
				if (isset($bms_get_aoptions['bmssearchwrapfloat'])){$bmssearchwrapfloat = sanitize_text_field($bms_get_aoptions['bmssearchwrapfloat']);}
			?>
			<div class="colonne">
				<h4><?php _e('Margin Top BMS Global Wrap','beautifulmultiselectsearch'); ?></h4>
					<input type="text" size="2" name="bmsadvancedadmin-mtopbmswrap" value="<?php if (isset($bms_get_aoptions['mtopbmswrap'])){echo esc_textarea($bms_get_aoptions['mtopbmswrap']);} ?>"  />
					<select id="bmsadvancedadmin-mtopbmswrap_unit" name="bmsadvancedadmin-mtopbmswrap_unit" style='vertical-align: top;'>
						<option <?php if($mwraptopunit == 'px'){echo("selected");}?>>px</option>
						<option <?php if($mwraptopunit == '%'){echo("selected");}?>>%</option>
					</select><br>
					<br>
				<?php	
					if ($error_cpc_bms_erroraa4==true) {
						echo '<span class="advancedadminerror">';
						_e('! The value should be < 9999','beautifulmultiselectsearch');
						echo '</span>';
						echo '<br>';
					}
				?>
			</div>
			<div class="colonne">
				<h4><?php _e('Margin Bottom BMS Global Wrap','beautifulmultiselectsearch'); ?></h4>
					<input type="text" size="2" name="bmsadvancedadmin-mbottombmswrap" value="<?php if (isset($bms_get_aoptions['mbottombmswrap'])){echo esc_textarea($bms_get_aoptions['mbottombmswrap']);} ?>"  />
					<select id="bmsadvancedadmin-mbottombmswrap_unit" name="bmsadvancedadmin-mbottombmswrap_unit" style='vertical-align: top;'>
						<option <?php if($mwrapbottomunit == 'px'){echo("selected");}?>>px</option>
						<option <?php if($mwrapbottomunit == '%'){echo("selected");}?>>%</option>
					</select><br>
					<br>
			</div>
			<div class="colonne">
				<h4><?php _e('Margin Right BMS Global Wrap','beautifulmultiselectsearch'); ?></h4>
					<input type="text" size="2" name="bmsadvancedadmin-mrightbmswrap" value="<?php if (isset($bms_get_aoptions['mrightbmswrap'])){echo esc_textarea($bms_get_aoptions['mrightbmswrap']);} ?>"  />
					<select id="bmsadvancedadmin-mrightbmswrap_unit" name="bmsadvancedadmin-mrightbmswrap_unit" style='vertical-align: top;'>
						<option <?php if($mwraprightunit == 'px'){echo("selected");}?>>px</option>
						<option <?php if($mwraprightunit == '%'){echo("selected");}?>>%</option>
					</select><br>
			</div>
			<div class="colonne">
				<h4><?php _e('Margin Left BMS Global Wrap','beautifulmultiselectsearch'); ?></h4>
					<input type="text" size="2" name="bmsadvancedadmin-mleftbmswrap" value="<?php if (isset($bms_get_aoptions['mleftbmswrap'])){echo esc_textarea($bms_get_aoptions['mleftbmswrap']);} ?>"  />
					<select id="bmsadvancedadmin-mleftbmswrap_unit" name="bmsadvancedadmin-mleftbmswrap_unit" style='vertical-align: top;'>
						<option <?php if($mwrapleftunit == 'px'){echo("selected");}?>>px</option>
						<option <?php if($mwrapleftunit == '%'){echo("selected");}?>>%</option>
					</select><br>
			</div><br>
			<div class="colonne">
				<h4><?php _e('Padding Top BMS Global Wrap','beautifulmultiselectsearch'); ?></h4>
					<input type="text" size="2" name="bmsadvancedadmin-ptopbmswrap" value="<?php if (isset($bms_get_aoptions['ptopbmswrap'])){echo esc_textarea($bms_get_aoptions['ptopbmswrap']);} ?>"  />
					<select id="bmsadvancedadmin-ptopbmswrap_unit" name="bmsadvancedadmin-ptopbmswrap_unit" style='vertical-align: top;'>
						<option <?php if($pwraptopunit == 'px'){echo("selected");}?>>px</option>
						<option <?php if($pwraptopunit == '%'){echo("selected");}?>>%</option>
					</select><br>
					
			</div>
			<div class="colonne">
				<h4><?php _e('Search Colomn Position','beautifulmultiselectsearch'); ?></h4>
					<select id="bmsadvancedadmin-bmssearchwrapfloat" name="bmsadvancedadmin-bmssearchwrapfloat" style='vertical-align: top;'>
						<option <?php if($bmssearchwrapfloat == ''){echo("selected");}?>></option>
						<option <?php if($bmssearchwrapfloat == 'left'){echo("selected");}?>>left</option>
						<option <?php if($bmssearchwrapfloat == 'right'){echo("selected");}?>>right</option>
					</select><br>
					<br>
			</div>
			<br><br>
			<br><br>
            <?php wp_nonce_field( 'cpc_bms_saveform_aadminoptions', 'cpc_bms_nonce_form_aadminoptions' ); ?>

        </form>
</div>