<?php
/**
 * Plugin Name:       Testplugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the user list  with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2.19 
 * Author:            John Smith
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 * 
 */

defined('ABSPATH')||exit;

add_action('init','my_function');


function my_function()
  {
    add_shortcode('user_table','list_of_users');
    add_action('wp_enqueue_scripts', 'register_user_scripts');
    add_action('wp_ajax_register_user_front_end', 'register_user_front_end_cv');
    add_action('wp_ajax_nopriv_register_user_front_end', 'register_user_front_end_cv');

  }

function list_of_users(){
  if( is_user_logged_in() and current_user_can('administrator')){
    include_once dirname(__FILE__).'/user_table.php';
  }
  else{
    _e('This is Restricted');
    exit;
  }
    
    

}


function register_user_scripts() {
    // Enqueue script
    wp_register_script('my_script', plugins_url() . '/Testplugin/assests/my.js', array('jquery'), '1.2.3', false);
    wp_enqueue_style('my_script', plugins_url() . '/Testplugin/assests/mystyle.css');
    wp_enqueue_script('my_script');
    wp_localize_script( 'my_script', 'my_vars', array(
          'my_ajax_url' => admin_url( 'admin-ajax.php' ),
        )
    );
 }

 function register_user_front_end_cv() {
   
  $user_role = $_POST['user_role'];
    $user_order = $_POST['user_order'];
    $order_by = $_POST['order_by'];

    
    $args1 = array(
      'role' => $user_role,
      'order' =>  $user_order,
      'orderby' =>  $order_by,
     );
    
    global  $wpdb;
    $result=  $wpdb->get_results( "SELECT  wp_users.user_login , wp_users.display_name, '".$args1['role']."' as meta_value
          FROM wp_users INNER JOIN wp_usermeta 
          ON wp_users.ID = wp_usermeta.user_id 
          WHERE wp_usermeta.meta_key = 'wp_capabilities' 
          AND wp_usermeta.meta_value LIKE '%".$args1['role']."%' 
          ORDER BY ".$args1['orderby']." ".$args1['order']." ");

    $result = json_decode(json_encode($result), true);   
    

   
    echo json_encode($result);

   
    die();
         
 
  
 }
