<?php
  /*
  * Add new menu to the Admin Control Panel
  */

  // include all assets
  function cw_admin_enqueue_script() {
    // delete_option('cw_settings');
    if (!get_option('cw_settings')) {
      $default_settings = '{"license_key":"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890","windows_status":"active","windows_location":"front_end","windows_count":"1","overlay_windows":[{"tabs":[{"color":"#717171","title":"TAB-1","tab_dividers":"none","contents":[{"url_content":"URL Content","embedded_content":"Embedded Content","api_key_content":"Api-Key Content"}]}],"window_position":"bottom","window_size":"tab","window_dialog_size":"tab","tab_type":"full","window_placement":{"type":"all","pages":[]},"window_dividers":"none"}]}';
      add_option('cw_settings', $default_settings);
    }
    wp_enqueue_style('jquery-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css?v=' . rand());
    wp_enqueue_style('font-awesome', '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('farbtastic-colorpicker', CWPL_URL . 'assets/plugins/farbtastic/farbtastic.css?v=' . rand());
    wp_enqueue_style('global-style', CWPL_URL . 'assets/global.css?v=' . rand());

    wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js?v=' .rand());
    wp_enqueue_script('farbtastic-colorpicker',  CWPL_URL . 'assets/plugins/farbtastic/farbtastic.js?v=' . rand());

  }

  add_action( 'admin_enqueue_scripts', 'cw_admin_enqueue_script' );

  function cw_enqueue_script() {
    global $post;
    wp_enqueue_style('cw-overlay-style', CWPL_URL . 'assets/css/cw_overlay.css?v=' . rand());

    wp_enqueue_script('jquery-script',  'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js?v' . rand());
    wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js?v=' .rand());
    wp_enqueue_script('cw-overlay-script',  CWPL_URL . 'assets/js/cw_overlay.js?v=' . rand());
    wp_localize_script('cw-overlay-script', 'cw_global_vars', array(
      'current_page_id' => $post->ID
    ));
  }
  add_action( 'wp_enqueue_scripts', 'cw_enqueue_script' );


  // Add a new top level menu link to the Amin Panel
  function cw_add_admin_link() {
    add_menu_page(
      'Settings',
      'Condos Overlay',
      'manage_options',
      'cw_settings',
      'cw_settings_page'
    );
  }

  // Hook the 'admin_menu' action hook
  add_action('admin_menu', 'cw_add_admin_link');

  function cw_settings_page() {
    require_once plugin_dir_path(__FILE__) . '/cw-settings.php';
  }

  function save_cw_settings() {
    global $wpdb;
    $cw_settings = $_POST['cw_settings'];
    $settings = get_option('cw_settings');
    if (!empty($settings)) {
      update_option('cw_settings', json_encode($cw_settings));
    }
    else {
      add_option('cw_settings', json_encode($cw_settings));
    }
    echo 'ok'; exit;
  }
  add_action('wp_ajax_nopriv_save_cw_settings', 'save_cw_settings');
  add_action('wp_ajax_save_cw_settings', 'save_cw_settings');

  function get_cw_settings() {
    $settings = get_option('cw_settings');
    echo $settings; exit;
  }
  add_action('wp_ajax_nopriv_get_cw_settings', 'get_cw_settings');
  add_action('wp_ajax_get_cw_settings', 'get_cw_settings');
