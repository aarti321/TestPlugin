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

class TestPlugin{
  public function __construct(){
    add_action('init',array($this,'my_function'));

  }
  function my_function()
  {
    add_shortcode('user_table',array($this,'list_of_users'));
    add_action('wp_enqueue_scripts', array($this,'enqueue_user_scripts'));
    add_action('wp_ajax_list_user_front_end', array($this,'list_user_front_list'));
    add_action('wp_ajax_nopriv_register_user_front_end', array($this,'list_user_front_list'));

  }

function list_of_users(){
  ob_start();
  if( is_user_logged_in() and current_user_can('administrator')){
    include_once dirname(__FILE__).'/user_table.php';
  }
  else{
    _e('This is Restricted','testplugin');
    exit;
  }
    
    
  return ob_get_clean();
}


function enqueue_user_scripts() {
    // Enqueue script
    wp_register_script('my_script', plugins_url() . '/Testplugin-master/assests/my.js', array('jquery'), '1.2.3', false);
    wp_enqueue_style('my_script', plugins_url() . '/Testplugin-master/assests/mystyle.css');
    wp_enqueue_script('my_script');
    wp_localize_script( 'my_script', 'my_vars', array(
          'my_ajax_url' => admin_url( 'admin-ajax.php' ),
          'ajax_nonce' => wp_create_nonce('user_list'),

        )
    );
 }

 function list_user_front_list() {
   
   check_ajax_referer('user_list','nonce');
    $user_order = sanitize_key($_POST['user_order']);
    $order_by = sanitize_key($_POST['order_by']);
    $user_role = sanitize_key($_POST['user_role']);

    
    $args1 = array(
      
      'order' =>  $user_order,
      'orderby' =>  $order_by,
      'role' => $user_role,
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
}
new TestPlugin;




