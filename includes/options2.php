<div class="wrap">
	<h2><?php _e('Auto Content Poster - Advance Settings','auto-content-poster');?></h2>

	<form method="post" action="options.php" name="adv_form" onsubmit="return validate();">
		<?php settings_fields( 'ACP_advance_settings' ); ?>
		<?php $advoptions = get_option('ACP_advance_settings'); ?> 
		<table class="form-table">
			<tr valign="top"><th scope="row"><?php _e('How many post(product) you want to get for each advertiser','auto-content-poster');?> ?</th>
				<td><input type="number" name="ACP_advance_settings[post_record]" value="<?php if(!empty($advoptions['post_record']))echo $advoptions['post_record']; ?>" pattern="[0-9]{1}" oninvalid="setCustomValidity('Please enter numbers only, Maximum 9')" onchange="try{setCustomValidity('')}catch(e){}"/></td>
			</tr>
			<tr valign="top"><th scope="row"><?php _e('Choose option for category assignment: ','auto-content-poster');?></th>
       <td style="width: 180px;"> <input type="radio" name="ACP_advance_settings[category]" value="auto"<?php checked( 'auto' == $advoptions['category'] ); ?> /><?php _e('Automatically post in category based on advertiser\'s category in CJ','auto-content-poster');?> </td>
<td><input type="radio" name="ACP_advance_settings[category]" value="manual"<?php checked( 'manual' == $advoptions['category'] ); ?> /><?php _e('Enter Category name: ','auto-content-poster');?><input type="text" name="ACP_advance_settings[category_name]" value="<?php if(!empty($advoptions['category_name']))echo $advoptions['category_name'];?>"/></td>
				
			</tr>
			<tr valign="top"><th scope="row"><?php _e('Choose an Interval: ','auto-content-poster');?></th>
       <td style="width: 100px;"> <input type="radio" name="ACP_advance_settings[interval]" value="hourly"<?php checked( 'hourly' == $advoptions['interval'] ); ?> /><?php _e('Per Hour','auto-content-poster');?> </td><td style="width: 100px;"><input type="radio" name="ACP_advance_settings[interval]" value="twicedaily"<?php checked( 'twicedaily' == $advoptions['interval'] ); ?> /><?php _e('Twice Daily ','auto-content-poster');?></td><td style="width: 100px;"><input type="radio" name="ACP_advance_settings[interval]" value="daily"<?php checked( 'daily' == $advoptions['interval'] ); ?> /><?php _e('Daily ','auto-content-poster');?></td></tr>
		</table>
		 <?php submit_button();?>
	</form>
</div>