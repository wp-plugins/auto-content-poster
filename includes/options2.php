<?php if( isset($_GET['settings-updated']) ) { ?>
    <div id="message" class="updated">
        <p><strong><?php _e('Great Work ! All done.','auto-content-poster') ?></strong></p>
    </div>
<?php } ?>
<?php if( isset($_GET['post_now']) == true and isset($_GET['adid'])) {
	
	$adid = $_GET['adid'];
	
	if($adid == 'random'){
		ACPposter();
	
	 ?>
	 <div id="message" class="updated">
        <p><strong><?php _e('One post/link created successfully.','auto-content-poster') ?></strong></p>
    </div>
<?php }else{
	$adid = (int)$adid;
	global $wpdb;
	$resu = $wpdb->get_results('SELECT adname,adcat FROM bestcjdb WHERE adid='.$adid);
	ACPposter($adid);
	?>
	 <div id="message" class="updated">
        <p><strong><?php _e('One post/link created successfully for '.$resu[0]->adname,'auto-content-poster') ?></strong></p>
    </div>
<?php } } ?>
<?php if( isset($_GET['refresh']) == true ) {
	ACP_refreshDB();
	 ?>
	 <div id="message" class="updated">
        <p><strong><?php _e('Database refreshed successfully, New advertisers are added.','auto-content-poster') ?></strong></p>
    </div>
<?php } ?>
<?php if(isset($_POST['submit2'])){
	$adids = $_POST['adid2'];
	$sticky = TRUE;
	foreach($adids as $id){
		$m = ACPposter($id,$sticky);
		echo $m;
	}
}?>
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
       <td style="width: 50%;"> <input type="radio" name="ACP_advance_settings[category]" value="auto"<?php checked( 'auto' == $advoptions['category'] ); ?> onclick="hide2();"/><?php _e('Automatically post in category based on advertiser\'s category in CJ','auto-content-poster');?> </td>
<td style="width: 50%;"><input type="radio" name="ACP_advance_settings[category]" value="manual"<?php checked( 'manual' == $advoptions['category'] ); ?> onclick="show2();"/><?php _e('Enter Category name: ','auto-content-poster');?><input type="text" id="category_name" name="ACP_advance_settings[category_name]" value="<?php if(!empty($advoptions['category_name']))echo $advoptions['category_name'];?>" style="display: none;"/></td>
				
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
		<tr valign="top"><th scope="row"><?php _e('Post now instantly: ','auto-content-poster');?></th>
		<td style="width: 100px;">
		<?php _e('Choose random OR specific advertiser for Post ','auto-content-poster');?>
			<select name="ACP_advance_settings[adid]" id="adid">
<option value="random" selected="selected">Random Advertiser</option><?php echo acp_alladvs();?></select>
			<a class="button-primary" href="javascript:if (document.getElementById('adid').value) window.open('options-general.php?page=PostSetting&post_now=true&adid='+document.getElementById('adid').value,'_self');">Post Now</a>
		</td>
		</tr>
		<tr valign="top"><th scope="row"><?php _e('Refresh advertiser\'s list in Database : ','auto-content-poster');?></th>
		<td style="width: 100px;">
			<a class="button-primary" href="options-general.php?page=PostSetting&refresh=true">Refresh Database</a>
			<br>Refreshing of database is depends on how frequently you joins new advertisers in CJ, Generally once a month is sufficient. Please note that plugin refreshs it automatically after all advertisers processed but you can refresh it here manually also. 
		</td>
		</tr>
	</table>
		 <?php submit_button();?>
	</form>
	<form method="post" action="#" name="adv_form2" >
	<table class="form-table">
	<tr valign="top"><th scope="row"><?php _e('Make featured post for selected advertisers: <br>(Hold Ctrl for multiple selection)','auto-content-poster');?></th>
		<td style="width: 100px;">
		<select name="adid2[]" id="stic" multiple="multiple" size="10">
<?php echo acp_alladvs();?></select>
			
		</td>
		</tr>
		</table>
		 <input class="button-primary" type="submit" name="submit2" value="Make Sticky"/>
	</form>
	<p style="font-size: 16px; color: #4db805">If you found my plugin usefull then please <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6GLU2ZTKHSF2W">Donate</a> to support me, Thank you</p>
	<b style="font-size: 14px; color: #860000">Pleass Read : </b>
	<p>By default my plugin uses Wordpress's built in cron functions to schedule posts. While no additional setup is necessary. But it have a few disadvantages, namely it will only run when a visitor visits your site.</p>
				
	<p>>As an alternative you can set up an Unix Cron Job in your webhosts control panel (often cPanel) to create automatic posts. This will use less ressources on your server and be more reliable than the Wordpress solution. To set up a cron job you need to use the following command: wget -O /dev/null <?php
echo plugins_url('cron.php', __FILE__ );
?></p>
	<p>If you have a any problem in my plugin or wish to request a feature then do not hesitate to <a href="mailto:dr.bhavin.tolia@gmail.com">contact</a> me. OR <a href="http://www.acp.y5q.net">Visit plugin site</a></p>
</div>