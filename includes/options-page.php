<?php if( isset($_GET['settings-updated']) ) { ?>
    <div id="message" class="updated">
        <p><strong><?php _e('Good Work ! Now please go to Settings->ACP Advance Settings','auto-content-poster') ?></strong></p>
    </div>
<?php } ?>
<div class="wrap">
	<h2><?php _e('Auto Content Poster - Settings','auto-content-poster');?></h2>
	<form method="post" action="options.php">
		<?php settings_fields( 'ACP_settings' ); ?>
		<?php $options = get_option('ACP_settings'); ?> 
		<table class="form-table">
			<tr valign="top"><th scope="row"><?php _e('CJ Website ID','auto-content-poster');?></th>
				<td><input type="text" name="ACP_settings[cj_site_id]" value="<?php if(!empty($options['cj_site_id']))echo $options['cj_site_id']; ?>" /></td>
			</tr>
			<tr valign="top"><th scope="row"><?php _e('CJ API KEY','auto-content-poster');?></th>
				<td><input type="text" name="ACP_settings[ACP_key]" value="<?php if(!empty($options['ACP_key']))echo $options['ACP_key']; ?>" /></td>
			</tr>
						
		</table>
		 <?php submit_button();?>
	</form>
</div>