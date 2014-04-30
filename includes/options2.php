<?php if( isset($_GET['settings-updated']) ) { ?>
    <div id="message" class="updated">
        <p><strong><?php _e('Great Work ! All done.','auto-content-poster') ?></strong></p>
    </div>
<?php } ?>
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
       <td style="width: 180px;"> <input type="radio" name="ACP_advance_settings[category]" value="auto"<?php checked( 'auto' == $advoptions['category'] ); ?> onclick="hide2();"/><?php _e('Automatically post in category based on advertiser\'s category in CJ','auto-content-poster');?> </td>
<td><input type="radio" name="ACP_advance_settings[category]" value="manual"<?php checked( 'manual' == $advoptions['category'] ); ?> onclick="show2();"/><?php _e('Enter Category name: ','auto-content-poster');?><input type="text" id="category_name" name="ACP_advance_settings[category_name]" value="<?php if(!empty($advoptions['category_name']))echo $advoptions['category_name'];?>" style="display: none;"/></td>
				
			</tr>
			<tr valign="top"><th scope="row"><?php _e('Choose an Interval: ','auto-content-poster');?></th>
       <td style="width: 100px;"> <input type="radio" name="ACP_advance_settings[interval]" value="hourly"<?php checked( 'hourly' == $advoptions['interval'] ); ?> onclick="hide();"/><?php _e('Per Hour','auto-content-poster');?> </td>
       <td style="width: 100px;"><input type="radio" name="ACP_advance_settings[interval]" value="twicedaily"<?php checked( 'twicedaily' == $advoptions['interval'] ); ?> onclick="hide();"/><?php _e('Twice Daily ','auto-content-poster');?></td>
       <td style="width: 100px;"><input type="radio" name="ACP_advance_settings[interval]" value="daily"<?php checked( 'daily' == $advoptions['interval'] ); ?> onclick="hide();"/><?php _e('Daily ','auto-content-poster');?></td>
       
       </tr>
       <tr valign="top"><th scope="row"><?php _e('Choose all/specific category\'s advertisers from CJ: ','auto-content-poster');?></th>
       <td style="width: 100px;"> <input type="radio" value="auto_cj" name="ACP_advance_settings[category_cj]" <?php checked( 'auto_cj' == $advoptions['category_cj'] ); ?> onclick="hide3();"/><?php _e('Use all category of CJ ','auto-content-poster');?></td>
       <td style="width: 100px;"><input type="radio" value="manual_cj" name="ACP_advance_settings[category_cj]" <?php checked( 'manual_cj' == $advoptions['category_cj'] ); ?> onclick="show3();"/><?php _e('Choose below:(number shows available advertisers in that category) ','auto-content-poster');?><select name="ACP_advance_settings[cselect]" id="cselect" style="display: none;">
<option value="" selected="selected">Choose a category</option><?php echo ACP_select();?></select></td>

		</tr>
		</table>
		 <?php submit_button();?>
	</form>
</div>