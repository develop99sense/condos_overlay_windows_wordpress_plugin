<?php
  /*
    Plugin Name: Condos Overlay Windows
    Description: This plugin will allow users to generate Content Windows that Overlay on-top pages on any Word Press Front-End or Admin Section and Customize the windows with content or pages, edit colors, labels, size options and more...
    Version 1.0
    Author: TEKware.
  */

  define('CWPL_URL', trailingslashit(plugins_url( '/', __FILE__ )));
  define('CWPL_PATH', plugin_dir_path(__FILE__));
  define('CWPL_VERSION', '1.0');
  define('CWPL_TW_LOGO', plugins_url('/assets/logos/TW_Logo.png', __FILE__));
  define('CWPL_CD_LOGO', plugins_url('/assets/logos/Condos_Logo2.png', __FILE__));
  // Inlude functions
  require_once plugin_dir_path(__FILE__) . 'includes/cw-functions.php';
