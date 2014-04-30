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
			
			<tr valign="top"><th scope="row"><?php _e('Amazon AccessKey ID:','auto-content-poster');?></th>
				<td><input type="text" name="ACP_settings[ACP_amz_key]" value="<?php if(!empty($options['ACP_amz_key']))echo $options['ACP_amz_key']; ?>" /></td>
			</tr>
			
			<tr valign="top"><th scope="row"><?php _e('Amazon Private(Secret)key:','auto-content-poster');?></th>
				<td><input type="text" name="ACP_settings[ACP_amz_pkey]" value="<?php if(!empty($options['ACP_amz_pkey']))echo $options['ACP_amz_pkey']; ?>" /></td>
			</tr>
			<tr valign="top"><th scope="row"><?php _e('Amazon Associate Tag:','auto-content-poster');?></th>
				<td><input type="text" name="ACP_settings[ACP_amz_atag]" value="<?php if(!empty($options['ACP_amz_atag']))echo $options['ACP_amz_atag']; ?>" /></td>
			</tr>
			<tr valign="top"><th scope="row"><?php _e('Select Amazon Associate Region:','auto-content-poster');?></th>
				<td><select name="ACP_settings[rselect]" id="rselect">
				<option value="com" <?php selected('com' == $advoptions['rselect']);?>>USA</option>
				<option value="ca" <?php selected('ca' == $advoptions['rselect']);?>>Canada</option>
				<option value="co.uk" <?php selected('co.uk' == $advoptions['rselect']);?>>UK</option>
				<option value="cn" <?php selected('cn' == $advoptions['rselect']);?>>China</option>
				<option value="in" <?php selected('in' == $advoptions['rselect']);?>>India</option>
				<option value="fr" <?php selected('fr' == $advoptions['rselect']);?>>France</option>
				<option value="de" <?php selected('de' == $advoptions['rselect']);?>>Germany</option>
				<option value="es" <?php selected('es' == $advoptions['rselect']);?>>Spain</option>
				<option value="it" <?php selected('it' == $advoptions['rselect']);?>>Italy</option>
				<option value="co.jp" <?php selected('co.jp' == $advoptions['rselect']);?>>Japan</option>
				</select>
				</td>
			</tr>
			<tr valign="top"><th scope="row"><?php _e('Ebay Affiliate ID(CampaignID):','auto-content-poster');?></th>
				<td><input type="text" name="ACP_settings[ACP_ebay_key]" value="<?php if(!empty($options['ACP_ebay_key']))echo $options['ACP_ebay_key']; ?>" /></td>
			</tr>	
			<tr valign="top"><th scope="row"><?php _e('Select Ebay Country(ebay-site):','auto-content-poster');?></th>
			<td>
				<select name="ACP_settings[eb_select]" id="ACP_eb_select">
					<option value="0" <?php if($options['eb_select']=="0"){_e('selected');}?>><?php _e("United States","auto-content-poster") ?></option>
					<option value="2" <?php if($options['eb_select']=="2"){_e('selected');}?>><?php _e("Canada","auto-content-poster") ?></option>
					<option value="3" <?php if($options['eb_select']=="3"){_e('selected');}?>><?php _e("United kingdom","auto-content-poster") ?></option>
					<option value="15" <?php if($options['eb_select']=="15"){_e('selected');}?>><?php _e("Australia","auto-content-poster") ?></option>
					<option value="16" <?php if($options['eb_select']=="16"){_e('selected');}?>><?php _e("Austria","auto-content-poster") ?></option>
					<option value="23" <?php if($options['eb_select']=="23"){_e('selected');}?>><?php _e("Belgium (French)","auto-content-poster") ?></option>
					<option value="71" <?php if($options['eb_select']=="71"){_e('selected');}?>><?php _e("France","auto-content-poster") ?></option>
					<option value="77" <?php if($options['eb_select']=="77"){_e('selected');}?>><?php _e("Germany","auto-content-poster") ?></option>
					<option value="100" <?php if($options['eb_select']=="100"){_e('selected');}?>><?php _e("eBay Motors","auto-content-poster") ?></option>
					<option value="101" <?php if($options['eb_select']=="101"){_e('selected');}?>><?php _e("Italy","auto-content-poster") ?></option>
					<option value="123" <?php if($options['eb_select']=="123"){_e('selected');}?>><?php _e("Belgium (Dutch)","auto-content-poster") ?></option>
					<option value="146" <?php if($options['eb_select']=="146"){_e('selected');}?>><?php _e("Netherlands","auto-content-poster") ?></option>
					<option value="186" <?php if($options['eb_select']=="186"){_e('selected');}?>><?php _e("Spain","auto-content-poster") ?></option>
					<option value="193" <?php if($options['eb_select']=="193"){_e('selected');}?>><?php _e("Switzerland","auto-content-poster") ?></option>
					<option value="196" <?php if($options['eb_select']=="196"){_e('selected');}?>><?php _e("Taiwan","auto-content-poster") ?></option>
					<option value="223" <?php if($options['eb_select']=="223"){_e('selected');}?>><?php _e("China","auto-content-poster") ?></option>
					<option value="203" <?php if($options['eb_select']=='203') {_e('selected');}?>><?php _e("India","auto-content-poster") ?></option>
					<option value="205" <?php if($options['eb_select']=='205') {_e('selected');}?>><?php _e("Ireland","auto-content-poster") ?></option>
				</select>
			</td>
			</tr>
						
		</table>
		 <?php submit_button();?>
	</form>
	<p style="font-size: 16px; color: #4db805">If you found my plugin usefull then please <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6GLU2ZTKHSF2W">Donate</a> to support me, Thank you</p>
	<p>If you have a any problem in my plugin or wish to request a feature then do not hesitate to <a href="mailto:dr.bhavin.tolia@gmail.com">contact</a> me. OR <a href="http://www.acp.y5q.net">Visit plugin site</a></p>
</div>