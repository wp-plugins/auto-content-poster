<?php
/*
Plugin Name: Auto Content Poster
Text Domain: auto-content-poster
Plugin URI: http://www.auto-poster.com
Description: Allows users to automatically post products/link from commission junction API to WordPress.
Version: 1.0
Author: Bhavin Toliya
Author URI: http://www.auto-poster.com
License: GPL v2.
*/
ini_set('display_errors', 1 ); 
set_time_limit(600);

class ACP_Wordpress {

	//Install default data
	public function activate() {
		$options = array( 'advertiser_relationship' => 'joined' ,
		 'cache_duration' => '3600');
    if ( ! get_option('ACP_settings')){
      add_option('ACP_settings' , $options);
    } else {
      update_option('ACP_settings' , $options);
	}
	}
	
	//uninstall plugin
	

	//Add needed items on admin page load.
	public function add_admin_items() {
		add_options_page('Auto Content Poster Settings', 'ACP Settings', 'administrator', 'ACPoptions', array($this,'ACP_options'));
		
	}
	public function add_advance_items() {
		 $page_hook_suffix = add_options_page('Auto Content Poster Advance Settings', 'ACP Advance Settings', 'administrator', 'PostSetting', array($this,'ACP_options2'));
		 add_action('admin_print_scripts-' . $page_hook_suffix, array($this,'ACP_scripts'));
	}
	
	public function ACP_scripts(){
		 wp_enqueue_script( 'ACP-script' );
	}

	public function register_aioasettings() {
		register_setting( 'ACP_settings', 'ACP_settings' );
		
	}	
	public function register_advance_settings() {
		$advoptions = array();
		 add_option('ACP_advance_settings' , $advoptions);
		register_setting( 'ACP_advance_settings', 'ACP_advance_settings' );
		wp_register_script( 'ACP-script', plugins_url( 'js/acp.js', __FILE__ ) );
	}	
	public function ACP_options() {
		include('includes/options-page.php');
	}
	public function ACP_options2() {
		include('includes/options2.php');
	}
	
}

function ACP_deactivate() {
		global $wpdb;
		delete_option('ACP_settings');
		delete_option('ACP_advance_settings');
		$q = "DROP TABLE bestcjdb";
		$wpdb->query($q);
	}
function ACP_cj($b){
		global $api_key;
	$url = 'https://advertiser-lookup.api.cj.com/v3/advertiser-lookup?advertiser-ids=joined'.
			'&records-per-page=100'.
			'&page-number='.$b;
		//Request results from CJ REST API and return results as XML.
		$headers = array( 'Authorization' => $api_key );
		$request = new WP_Http;
		$result = $request->request( $url , array( 'method' => 'GET', 'headers' => $headers, 'sslverify' => false ) );
		if ( is_wp_error($result) ) {
			return $result;
		} else {
		$xml = new SimpleXMLElement($result['body']);
			 return $xml;
		}
}
function ACP_alltodb(){
			
	
		global $wpdb;		//wordpress class

$sql = "CREATE TABLE bestcjdb( 
       id INT AUTO_INCREMENT,
	   adid INT,
	   adname TEXT,
	   adcat VARCHAR(20),
	   tmp INT,
	   PRIMARY KEY ( id )); ";
$sql2 = "SHOW TABLES LIKE 'bestcjdb'";
$retval =  $wpdb->query($sql2); //wpdb class method

//table check if exits or not
if($retval == 0)
{
   $wpdb->query($sql);
  
}else{
	$wpdb->query("TRUNCATE TABLE `bestcjdb`");
}

$pn=1;
$advs = ACP_cj($pn);
foreach ($advs->advertisers[0] as $adv) 
		{
	$adn = str_replace("'","",$adv->{'advertiser-name'});
			$adc = str_replace("'","",$adv->{'primary-category'}->child);
	$wpdb->query("INSERT INTO `bestcjdb`(`id`,`adid`,`adname`,`adcat`)
VALUES(NULL,'".$adv->{'advertiser-id'}."','".$adn."','".$adc."')");
		}
$attributes = $advs->advertisers->attributes();
$n = $attributes->{'total-matched'};
$t = (int)($attributes->{'total-matched'}/100);
$s = $attributes->{'total-matched'}%100;
if($s!=0){
	$t+=1;
}

if($t>=2){
for($i=2;$i<=$t;$i++){
	$advs = ACP_cj($i);
	foreach ($advs->advertisers[0] as $adv) 
		{
			$adn = str_replace("'","",$adv->{'advertiser-name'});
			$adc = str_replace("'","",$adv->{'primary-category'}->child);
	$wpdb->query("INSERT INTO `bestcjdb`(`id`,`adid`,`adname`,`adcat`)
VALUES(NULL,'".$adv->{'advertiser-id'}."','".$adn."','".$adc."')");
		}
  }
 }
 $wpdb->query('UPDATE bestcjdb SET tmp=1 WHERE id=1');
}	
function ACP_checkdb(){
	global $wpdb;
	$sql2 = "SHOW TABLES LIKE 'bestcjdb'";
$retval =  $wpdb->query($sql2); //wpdb class method

//table check if exits or not
if($retval == 0)
{
   return true;
  
}else{
	return false;
}
}
function ACPposter(){
		global $wpdb,$api_key,$webid,$record,$cat;
		$r = $wpdb->get_results('SELECT MAX(id) FROM bestcjdb');
		$max = $r[0]->{'MAX(id)'};
		$r2 = $wpdb->get_results('SELECT tmp FROM bestcjdb WHERE id=1');
		$b = $r2[0]->tmp;
		$resu = $wpdb->get_results('SELECT adid,adname,adcat FROM bestcjdb WHERE id='.$b);
		
		if($b<$max){
		$wpdb->query('UPDATE bestcjdb SET tmp=tmp+1 WHERE id=1');
		}else{
		$wpdb->query('UPDATE bestcjdb SET tmp=1 WHERE id=1');
		_e('all precessed');
		}
		$url = 'https://product-search.api.cj.com/v2/product-search?website-id=5654397'.
			'&advertiser-ids='.$resu[0]->adid.
			'&records-per-page='.$record;
		$headers = array( 'Authorization' => $api_key );
		$request = new WP_Http;
		$result = $request->request( $url , array( 'method' => 'GET', 'headers' => $headers, 'sslverify' => false ) );
		$data = new SimpleXMLElement($result['body']);
		$attributes = $data->products->attributes();
	
		if ($attributes->{'total-matched'} == 0)
		{
			//if products not availabe for given advertiser id then getting text link
			$url = 'https://linksearch.api.cj.com/v2/link-search?website-id='.$webid.'&advertiser-ids='.$resu[0]->adid.'&link-type=text+link&records-per-page=1';
		$headers = array( 'Authorization' => $api_key );
		$request = new WP_Http;
		$result = $request->request( $url , array( 'method' => 'GET', 'headers' => $headers, 'sslverify' => false ) );
		$data = new SimpleXMLElement($result['body']);
		foreach ($data->links[0] as $link) 
							{
							// Sanitize data.
							$pd = $link->{'link-code-html'};
							preg_match("/a[\s]+[^>]*?href[\s]?=[\s\"\']+".
										"(.*?)[\"\']+.*?>"."([^<]+|.*?)?<\/a>/",$pd,$matches);
							preg_match('#<img\s+src\s*=\s*"([^"]+)"#i',$pd,$mat);
							if($cat){
								$ids = get_term_by('slug', $cat, 'link_category');//wordpress function
								if($ids){
									$id = (int)$ids->term_id;
								}else{
									$id = wp_create_category($cat);
								}
							}else{
								$ids = get_term_by('slug', $resu[0]->adcat, 'link_category');//wordpress function
								if($ids){
									$id = (int)$ids->term_id;
								}else{
									$id = wp_create_category($resu[0]->adcat);
								}
							}
							$p = array('link_name'    => $link->{'advertiser-name'},
  										'link_url'  => $matches[1],
 			 							'link_description' =>$link->description,
										'link_image' => $mat[1],
										'link_category'  =>$id,
										'link_target' => '_blank');
							$pr = wp_insert_link( $p, true );//wordpress function
							wp_reset_query();  // Restore global post data stomped by the_post().
							}
		}else{
				foreach ($data->products[0] as $product) 
				{
				// Sanitize data.
				$price = number_format((float)$product->price, 2, '.', ' ');
				$image = '<a href="'.$product->{'buy-url'}.'"><img src="'.$product->{'image-url'}							 .'" style="float: right"/></a>';
				$pd =  $image.$product->description .'--Price ='.$product->currency.' '.
					   ' ,Retail Price ='.$product->{'retail-price'}.' ,Our Sale Price is '.
					   $product->{'sale-price'}.'<a href="'.$product->{'buy-url'}.
						'">...So hurry Buy it Now!</a>';
				if($cat){
					$ids = get_term_by('slug', $cat, 'link_category');//wordpress function
					if($ids){
						$id = (int)$ids->term_id;
					}else{
						$id = wp_create_category($cat);
					}
				}else{
					$ids = get_term_by('slug', $resu[0]->adcat, 'link_category');//wordpress function
					if($ids){
						$id = (int)$ids->term_id;
					}else{
						$id = wp_create_category($resu[0]->adcat);
					}
				}
				$p = array('post_title'    => $product->name,
  					'post_content'  => $pd,
 				 	'post_status'   => 'publish',
  					'post_author'   => 1,
  					'post_category'  =>array($id));
				$pr = wp_insert_post($p);
				
				
				}
			}
	
}

if( class_exists( 'ACP_Wordpress' ) ) {
	$ACP = new ACP_Wordpress();
	
	//actions
	add_action('admin_menu', array(&$ACP,'add_admin_items') );
	add_action( 'admin_init', array(&$ACP,'register_aioasettings') );
	
	
	
	//registration hooks
	register_activation_hook( __FILE__, array(&$ACP, 'activate'));
	register_deactivation_hook( __FILE__, 'ACP_deactivate');
	$options = get_option('ACP_settings');
	$advoptions = get_option('ACP_advance_settings');
	$c = ACP_checkdb();
 if(!empty($options['ACP_key']) and $c == true){
		$api_key = $options['ACP_key'];
		ACP_alltodb();
	}
 if(!empty($options['ACP_key'])){
		add_action('admin_menu', array(&$ACP,'add_advance_items') );
	add_action( 'admin_init', array(&$ACP,'register_advance_settings') );
	}
 if(!empty($advoptions['post_record'])){
 	/*add_filter('cron_schedules', 'filter_cron_schedules');
	function filter_cron_schedules($param) {
     return array('minute' => array(
          'interval' => 60, // seconds
          'display'  => __('Every minute')
     ));
}*/
	if(!empty($advoptions['category']) and $advoptions['category']=='manual' and !empty($advoptions['category_name'])){
		$cat = strtolower($advoptions['category_name']);
	}else{
		$cat = FALSE;
	}
 	include_once(ABSPATH.'wp-admin/includes/taxonomy.php');
	$record = $advoptions['post_record'];
	$api_key = $options['ACP_key'];
	$webid = $options['cj_site_id'];
	if(!wp_next_scheduled('ACPdailyevent')){
		wp_schedule_event(time(),'daily','ACPdailyevent');
	}
	add_action('ACPdailyevent','ACPposter');
	
}
}


if (!get_option('link_manager_enabled')){
	add_filter( 'pre_option_link_manager_enabled', '__return_true' );//wordpress option
}
?>