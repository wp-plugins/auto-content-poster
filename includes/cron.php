<?php 
$path = explode( "wp-content" , __FILE__ );
require_once($path[0]."wp-config.php" );
$advoptions = get_option('ACP_advance_settings');
$adid3 = $advoptions['adid3'];
ACPposter();
if(!empty($adid3)){
		ACPposterIndv();
	}
?>