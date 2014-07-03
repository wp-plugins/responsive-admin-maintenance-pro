<?php
/*
Plugin Name: Responsive Admin Maintenance Pro With Countdown
Plugin URI: http://freelancingcare.com
Description: Make your own Schedule Maintenance Page, Coming Soon Page, Under Construction Page by using that plugin.
Author: Freelancing Care
Author URI: https://profiles.wordpress.org/nirob19
License: Md Nurullah
Version: 2.1
*/

define( 'RAMPROWC_PLUGIN_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'RAMPROWC_TEMPLATES_DIR',     RAMPROWC_PLUGIN_DIR . trailingslashit( 'templates' ) );

$settings_data = get_option('fcwebmaintenance_settings');
if($settings_data==true){
    define( 'TEMPLATE_PATH',     RAMPROWC_TEMPLATES_DIR . trailingslashit( $settings_data['template'] ) );
    define( 'TEMPLATE_URL',     plugins_url('templates', __FILE__). '/'.$settings_data['template'] .'/' );
}

include_once(RAMPROWC_PLUGIN_DIR.'settings.php');
include_once(RAMPROWC_PLUGIN_DIR.'inc/functions.php');



?>