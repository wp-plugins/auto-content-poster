<div class="wrap">
	<h2><?php _e('Auto Content Poster - Advance Settings','auto-content-poster');?></h2>

	<form method="post" action="options.php" name="adv_form" onsubmit="return validate();">
		<?php settings_fields( 'ACP_advance_settings' ); ?>
		<?php $advoptions = get_option('ACP_advance_settings'); ?> 
		<table class="form-table">
			<tr valign="top"><th scope="row"><?php _e('How many post(product) you want to get for each advertiser','auto-content-poster');?> ?</th>
				<td><input type="text" name="ACP_advance_settings[post_record]" value="<?php if(!empty($advoptions['post_record']))echo $advoptions['post_record']; ?>" /></td>
			</tr>
			<tr valign="top"><th scope="row"><?php _e('Choose option for category assignment: ','auto-content-poster');?></th>
       <td> <input type="radio" name="ACP_advance_settings[category]" value="auto"<?php checked( 'auto' == $advoptions['category'] ); ?> /><?php _e('Automatically post in category based on advertiser\'s category in CJ','auto-content-poster');?> </td><br />
<td><input type="radio" name="ACP_advance_settings[category]" value="manual"<?php checked( 'manual' == $advoptions['category'] ); ?> /><?php _e('Enter Category name: ','auto-content-poster');?><input type="text" name="ACP_advance_settings[category_name]" value="<?php if(!empty($advoptions['category_name']))echo $advoptions['category_name'];?>"/></td>
				
			</tr>
						
		</table>
		 <?php submit_button();?>
	</form>
</div>