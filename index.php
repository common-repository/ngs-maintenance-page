<?php
    /**
    * NGS-Maintenance-Page
    *
    * @category         Wordpress-plugin
    * @package          NGS_Maintenance_Page
    * @author           Nils Guder <nilsguder@neue-gute-software.de>
    * @copyright        2016 Nils Guder
    * @license          GNU GENERAL PUBLIC LICENSE Version 2
    * @link             http://neue-gute-software.de/plugins/ngs-maintenance-page/
    * @wordpress-plugin
    * Plugin Name: NGS Maintenance Page
    * Plugin URI:  http://neue-gute-software.de/plugins/ngs-maintenance-page/
    * Description: Shows a maintenance page to visitors
    * Version:     1.1.0
    * Author:      Nils Guder
    * Author URI:  http://neue-gute-software.de
    * Text Domain: ngs-maintenance-page
    */

    namespace NGSMaintenancePage;
    
    // Exit if accessed directly
    if( !defined( 'ABSPATH' ) ) {
        exit;
    }
      
    require 'modules/Base.php';

    new Base();
