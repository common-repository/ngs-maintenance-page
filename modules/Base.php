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
    * Version:     1.0.0
    * Author:      Nils Guder
    * Author URI:  http://neue-gute-software.de
    * Text Domain: ngs-maintenance-page
    */

    namespace NGSMaintenancePage;
        
    // Exit if accessed directly
    if (!defined( 'ABSPATH' )) {
        exit;
    }
    
    /**
    * Base Class Doc Comment
    *
    * @category Class
    * @package  NGS_Maintenance_Page
    * @author   Nils Guder <nilsguder@neue-gute-software.de>
    * @license  GNU GENERAL PUBLIC LICENSE Version 2
    * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
    */
    class Base
    {
        /**
        * Function Doc Comment for __construct()
        * 
        * @category Function
        * @package  NGS_Maintenance_Page
        * @author   Nils Guder <nilsguder@neue-gute-software.de>
        * @license  GNU GENERAL PUBLIC LICENSE Version 2
        * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
        */    
        function __construct()
        {
            $this->_init();

        }

        /**
        * Function Doc Comment for _init()
        * 
        * @category Function
        * @package  NGS_Maintenance_Page
        * @author   Nils Guder <nilsguder@neue-gute-software.de>
        * @license  GNU GENERAL PUBLIC LICENSE Version 2
        * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
        * @return   null
        */
        function _init()
        {
            spl_autoload_register(
                function ($class_name) {
                    $class_file = substr(strrchr($class_name, '\\'), 1)  . '.php';
                    $file_name = plugin_dir_path(__FILE__)  . $class_file;
                    if (file_exists($file_name)) {
                        include_once $file_name;
                    }
                }
            );
  
            add_action('plugins_loaded', [$this, 'i18n']);
            add_action('plugins_loaded', [$this, 'loadBackend']);
            add_action('template_redirect', [$this, 'denyAccess']);
            
            
        }
        
        /**
        * Function Doc Comment for i18n()
        * 
        * @category Function
        * @package  NGS_Maintenance_Page
        * @author   Nils Guder <nilsguder@neue-gute-software.de>
        * @license  GNU GENERAL PUBLIC LICENSE Version 2
        * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
        * @return   null
        */   
        function loadBackend()
        {
            if (Helper::isBackend()) {
                new Backend();
            }
        }
        
        /**
        * Function Doc Comment for i18n()
        * 
        * @category Function
        * @package  NGS_Maintenance_Page
        * @author   Nils Guder <nilsguder@neue-gute-software.de>
        * @license  GNU GENERAL PUBLIC LICENSE Version 2
        * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
        * @return   null
        */          
        function i18n()
        {
            load_plugin_textdomain('ngs-maintenance-page', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages' );          
        }


        /**
        * Function Doc Comment for denyAccess()
        * 
        * @category Function
        * @package  NGS_Maintenance_Page
        * @author   Nils Guder <nilsguder@neue-gute-software.de>
        * @license  GNU GENERAL PUBLIC LICENSE Version 2
        * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
        * @return   false
        */    
        function denyAccess()
        {
            if (!is_user_logged_in() && Helper::isActive()) {
                Helper::render('templates/frontend/maintenance');
                die;
            }
            return false;
        }
    }