<?php
/*
Plugin Name: Nat Med Trans Integration
Plugin URI: http://www.codeable.io
Description: Nat Med Trans Integration
Author: Anthony Brown
Version: 1.0.0
Author URI: http://worcesterwideweb.com
*/



add_action('plugins_loaded', 'Init_NatMedTrans');

function Init_NatMedTrans(){
$NatMedTrans = new NatMedTrans;

include_once'admin/settings.php';

add_action('wp_enqueue_scripts',array($NatMedTrans, 'scripts'));	
add_shortcode('natmedtrans', array($NatMedTrans,'button'));
add_action('wp_footer',array($NatMedTrans, 'wp_footer'));



add_action( 'wp_ajax_nmt_ajax_get_booking', array($NatMedTrans,'ajax_get_booking' ));
add_action( 'wp_ajax_nopriv_nmt_ajax_get_booking',array($NatMedTrans, 'ajax_get_booking' ));

}
class NatMedTrans{
	
	
	
	
function __construct(){
	
	
	
	
}
function get_option($option){
	
$options = get_option( 'natmedtrans_settings' );

return $options[$option];	
	
}
function ajax_get_booking(){
	$message = array();
	$message['url'] = '';
	$message['error'] = '';
	
	$token = get_transient( 'nmtt_token');

	if($token === false){
		
		$url = ''.$this->get_option('natmed_appurl').'/oauth/token';
		$response = wp_remote_post( $url, array(
		'method' => 'POST',
		'timeout' => 45,	
		'httpversion' => '1.0',	
		'headers'  => array(
			'Content-type: application/x-www-form-urlencoded'
		),
		 'body' => array(
			'grant_type' => 'client_credentials',
			'client_id' => $this->get_option('natmed_clientid'),
			'client_secret' => $this->get_option('natmed_clientsecret'),
		),
		)
	);
	
	
	if($response){
	$token_data = json_decode($response['body']);
	$token = $token_data->access_token;
	set_transient( 'nmtt_token', $token_data->access_token, 1800);	
	}
	
	}
	
	
	
	
	$message['url'] = ''.$this->get_option('natmed_appurl').'/memberappt/index?token='.$token .'';
	echo json_encode($message);
	die();
}
function wp_footer(){
	
	?>
<div class="remodal" data-remodal-id="natmedtrans">
  <button data-remodal-action="close" class="remodal-close"></button>
 
<div class="natmedtrans-wrapper"></div>
</div>
<style type="text/css">

<?php if($this->get_option('natmed_width')){ ?>
.remodal {
	margin-top:30px;
	padding:25px 20px 20px 20px;
    max-width: <?php echo $this->get_option('natmed_width'); ?>;
}
<?php  } ?>

</style>



	<?php
}
function button($atts){
	
		$atts = shortcode_atts( array(
		'class' => '',
		'text' => 'Open Modal',
		'id' => ''
	), $atts, 'natmedtrans' );
	
	
	return '<a href="#natmedtrans" id="'.$atts['id'].'" class="'.$atts['class'].'">'.$atts['text'].'</a>';
	
}

function scripts(){
	
	
	
			wp_enqueue_script('jquery');
		   
		    wp_enqueue_script('nmt-remodal', plugins_url('js/remodal.js', __FILE__), array('jquery'));  
			  wp_enqueue_script('nmt-scripts', plugins_url('js/scripts.js', __FILE__), array('jquery','nmt-remodal'));
			wp_enqueue_style('nmt-style', plugins_url('css/remodal.css', __FILE__));  
			
			wp_localize_script( 'nmt-scripts', 'nmt_var', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ));
			
	
}
	
	
}
