<?php
/**
* Plugin Name: Helpi5
* Plugin URI: https://www.helpi5.com/
* Description: Integrations help pages from Helpi5.com
* Version: 1.0.0
* Author: helpi5inc
**/

define( 'HELPI5_FILE', __FILE__ );
define( 'HELPI5_DIR', dirname( __FILE__ ) );
define( 'HELPI5_VERSION', '1.0.0' );

include 'inc/class.Helpi5_Plugin.php';

Helpi5_Plugin::init();
