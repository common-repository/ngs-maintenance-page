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
    if (!defined('ABSPATH')) {
        exit;
    }

    /**
    * Helper Class Doc Comment
    *
    * @category Class
    * @package  NGS_Maintenance_Page
    * @author   Nils Guder <nilsguder@neue-gute-software.de>
    * @license  GNU GENERAL PUBLIC LICENSE Version 2
    * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
    */
    class Helper
    {
        /**
            * Function Doc Comment isBackend()
            * 
            * @category Function
            * @package  NGS_Maintenance_Page
            * @author   Nils Guder <nilsguder@neue-gute-software.de>
            * @license  GNU GENERAL PUBLIC LICENSE Version 2
            * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
            * @return   bool
            */    
        static function isBackend()
        {
            if (is_admin() 
                && !(defined('DOING_AJAX') && DOING_AJAX)
            ) {
                return true;
            }
            return false;
        }
        
        /**
            * Function Doc Comment isOptionsPage()
            * 
            * @category Function
            * @package  NGS_Maintenance_Page
            * @author   Nils Guder <nilsguder@neue-gute-software.de>
            * @license  GNU GENERAL PUBLIC LICENSE Version 2
            * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
            * @return   bool
            */    
        static function isOptionsPage()
        {
            if (self::isBackend() 
                && isset($_GET['page'])
                && $_GET['page'] == 'NGSMaintenancePage_page'
            ) {
                return true;
            }
            return false;
        }

        /**
            * Function Doc Comment for render()
            * 
            * @param string $template path to template to render
            *
            * @category Function
            * @package  NGS_Maintenance_Page
            * @author   Nils Guder <nilsguder@neue-gute-software.de>
            * @license  GNU GENERAL PUBLIC LICENSE Version 2
            * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
            * @return   null
            */    
        static function render($template)
        {
            $path = dirname(plugin_dir_path(__FILE__));
            if (file_exists($file_name = $path . '/' . $template . '.php')) {
                include $file_name;
            }
        }
            
        /**
            * Function Doc Comment for isSave()
            * 
            * @category Function
            * @package  NGS_Maintenance_Page
            * @author   Nils Guder <nilsguder@neue-gute-software.de>
            * @license  GNU GENERAL PUBLIC LICENSE Version 2
            * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
            * @return   bool
            */    
        static function isSave()
        {
            return ($_SERVER['REQUEST_METHOD'] == 'POST');
        }
        
        /**
            * Function Doc Comment for isActive()
            * 
            * @category Function
            * @package  NGS_Maintenance_Page
            * @author   Nils Guder <nilsguder@neue-gute-software.de>
            * @license  GNU GENERAL PUBLIC LICENSE Version 2
            * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
            * @return   bool
            */    
        static function isActive()
        {
                if (get_option('NGSMaintenancePage_maintenanceMode') == 'aktiv') {
                    return true;
                } else {
                    return false;
                }
        }

        /**
            * Function getPluginData() returns PluginData 
            * defined in index.php Document Doc Comment
            * 
            * @param array|string $headers     datafields to be returned
            * @param string       $return_type possible values ['string'|'array']
            * 
            * @category Function
            * @package  NGS_Maintenance_Page
            * @author   Nils Guder <nilsguder@neue-gute-software.de>
            * @license  GNU GENERAL PUBLIC LICENSE Version 2
            * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
            * @return   bool|string|array
            */    
        static function getPluginData($headers = null, $return_type = 'array')
        {
            if (is_null($headers)) {
                return false;
            } else {
                if (!is_array($headers)) {
                    $headers = [$headers => $headers];
                }
                $plugin_file = dirname(__DIR__) . '/index.php';
                $file_data = \get_file_data($plugin_file, $headers, 'plugin');
                switch($return_type)
                {
                case 'string': 
                    return (string) current($file_data);
                        break;
                case 'array':
                    return $file_data;
                        break;
                default:
                    return false;
                        break;
                }
            }
        }
        
        static function isColor( $value ) { 
     
            if ( preg_match( '/^#[A-Fa-f0-9]{6}$/i', $value ) ) {   
                return true;
            }

            return false;
        }
    }