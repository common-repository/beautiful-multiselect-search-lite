<?php

?>
<div class='wrap'>	
		<div class="ligne"></div>
		<h3>BEAUTIFUL MULTISELECT SEARCH</h3><br>
		<?php
		if (get_option('cpc_bms_nb_bmsearch')){$j=get_option('cpc_bms_nb_bmsearch');}else {$j=1;}
		echo '<b><span style="font-size: 170%; font-weight: bold; color: green;">'.$j.'</b></span> Beautiful Multiselect Search have been created succesfully !';
		echo '<br><br>';
        _e('If you need more than 1 search, more than 5 search criteria,more color themes, a pagination, a predict number of post by category, a result counter, a full text search; with Support Access, the Pro version is available here :','beautifulmultiselectsearch');
        echo ' <a target="blank" href="'.cpc_bms_PRO_VERSION_URL.'">Pro Version</a>';
        echo '<br><br>';

		echo '<div class="ligne"></div><br>';

		for ( $i=0;$i<$j;$i++ ){
			if ($i>=1){
				echo '<div class="ligne"></div><br>';
			}
			echo '<h3><i> ';
			_e('How to use beautiful multiselect search ','beautifulmultiselectsearch');
			echo ($i+1);
			echo ' :</i></h3>';
			?>
			<h4><u><?php _e('STEP 1','beautifulmultiselectsearch'); ?>:</u></h4>
			<ul>
			<li><?php _e('Go to left menu','beautifulmultiselectsearch'); ?> <b>'<?php _e('Appearance','beautifulmultiselectsearch'); ?>'</b> <?php _e('and then','beautifulmultiselectsearch'); ?> <b>'<?php _e('Widgets','beautifulmultiselectsearch'); ?>'</b>.</li>
			<li><?php _e('Drag and Drop','beautifulmultiselectsearch'); ?> 'Beautiful Multiselect Search' <?php _e('Plugin from left','beautifulmultiselectsearch'); ?> '<?php _e('Available Widgets','beautifulmultiselectsearch'); ?>' <?php _e('to Right','beautifulmultiselectsearch'); ?> <b>'Beautiful MultiselectSearch<?php echo ($i+1); ?>'</b> <u>sidebar</u>. <?php _e('Then click on','beautifulmultiselectsearch'); ?> '<?php _e('Save','beautifulmultiselectsearch'); ?>' <?php _e('Button','beautifulmultiselectsearch'); ?>.</li>
			<li><?php _e('Choose the title, the default category (use when no criteria are selected), and the different main categories...Then click again on','beautifulmultiselectsearch'); ?> '<?php _e('Save','beautifulmultiselectsearch'); ?>' <?php _e('Button','beautifulmultiselectsearch'); ?>.</li>
			</ul>
			<h4><u><?php _e('STEP 2','beautifulmultiselectsearch'); ?>:</u></h4>
			<ul>
			<li><?php _e('Go to left menu','beautifulmultiselectsearch'); ?> <b>'<?php _e('Pages','beautifulmultiselectsearch'); ?>'</b> <?php _e('and then','beautifulmultiselectsearch'); ?> <b>'<?php _e('All Pages','beautifulmultiselectsearch'); ?>'</b>.</li>
			<li><?php _e('Click on Beautifull Multiselect Search','beautifulmultiselectsearch'); echo ($i+1);?> <u>Page </u><?php _e('and just change the page title as you want','beautifulmultiselectsearch'); ?>.</li>
			<li><?php _e('Then Click on','beautifulmultiselectsearch'); ?> '<?php _e('Publish','beautifulmultiselectsearch'); ?>'. <?php _e('It\'s done','beautifulmultiselectsearch'); ?> !</li>
			</ul>
			<?php

			echo '<br>';
		}
		?>
</div>