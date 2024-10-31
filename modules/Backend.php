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
    * PHP-Version: 7
    */

    namespace NGSMaintenancePage;

    // Exit if accessed directly
    if (!defined( 'ABSPATH' )) {
        exit;
    }
        
    /**
    * Backend Class Doc Comment
    *
    * @category Class
    * @package  NGS_Maintenance_Page
    * @author   Nils Guder <nilsguder@neue-gute-software.de>
    * @license  GNU GENERAL PUBLIC LICENSE Version 2
    * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
    */
    class Backend
    {
        static $plugin_data;
                
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
            if (Helper::isOptionsPage()){
                if (Helper::isSave()) {
                    $this->save();
                }
            }
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
        private function _init()
        {
            if (Helper::isOptionsPage()){
                if (function_exists('get_plugin_data')) {
                    $plugins_dir = dirname(dirname(__FILE__)) . '/index.php';
                    self::$plugin_data = get_plugin_data($plugins_dir, true, true);
                } else {
                    self::$plugin_data =    [   'Name'        =>'NGS Maintenance Page',
                                                'text-domain' =>'ngs-maintenance-page'];
                }
            
                add_action('admin_enqueue_scripts', [$this, 'enqueueStyles']);
            }
            add_action(
                'admin_menu', function () {
                    add_options_page(   
                        'NGS Maintenance Page',
                        'NGS Maintenance Page',
                        'administrator',
                        'NGSMaintenancePage_page',
                        [$this, 'optionsPage']
                    );
                }
            );
        }

        /**
            * Function Doc Comment for enqueueStyles()
            * 
            * @category Function
            * @package  NGS_Maintenance_Page
            * @author   Nils Guder <nilsguder@neue-gute-software.de>
            * @license  GNU GENERAL PUBLIC LICENSE Version 2
            * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
            * @return   null
            */
        function enqueueStyles()
        {
            $plugin_url = dirname(plugin_dir_url(__FILE__));
            wp_enqueue_style(
                'NGSMaintenancePage_Backend_Styles',
                $plugin_url . '/styles/backend.css'
            );
            
            // Add the color picker css file       
            wp_enqueue_style( 'wp-color-picker' ); 
        
            wp_enqueue_script(
                'NGSMaintenancePage_Backend_Script',
                $plugin_url . '/scripts/backend.js',
                ['jquery', 'wp-color-picker'],
                '1',
                true
            );
        }

        /**
            * Function Doc Comment for optionsPage()
            * 
            * @category Function
            * @package  NGS_Maintenance_Page
            * @author   Nils Guder <nilsguder@neue-gute-software.de>
            * @license  GNU GENERAL PUBLIC LICENSE Version 2
            * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
            * @return   null
            */
        function optionsPage()
        {
            Helper::render('templates/backend/options_page');
        }
                
        /**
            * Function Doc Comment for save()
            * 
            * @category Function
            * @package  NGS_Maintenance_Page
            * @author   Nils Guder <nilsguder@neue-gute-software.de>
            * @license  GNU GENERAL PUBLIC LICENSE Version 2
            * @link     http://neue-gute-software.de/plugins/ngs-maintenance-page/
            * @return   null
            */
        function save()
        {
            if ($_POST['NGSMaintenancePage_action'] != 'NGSMaintenancePage_save' 
                || !wp_verify_nonce($_POST['NGSMaintenancePage_nonce'], 'NGSMaintenancePage_save')
                || !current_user_can('edit_plugins')
            ) {
                return false;
            }
            
            $fields =   [
                            'NGSMaintenancePage_headline',
                            'NGSMaintenancePage_text',
                            'NGSMaintenancePage_backgroundImage',
                            'NGSMaintenancePage_stretchBackgroundImage',
                            'NGSMaintenancePage_backgroundVideo',
                            'NGSMaintenancePage_maintenanceMode',
                            'NGSMaintenancePage_headline_color',
                            'NGSMaintenancePage_text_color',
                            'NGSMaintenancePage_layer_color'
                        ];
            
            foreach ($fields as $field) {
                $fieldOk = false;
                if (isset($_POST[$field])) {
                    switch ($field) {
                        case 'NGSMaintenancePage_headline_color':
                        case 'NGSMaintenancePage_text_color':
                        case 'NGSMaintenancePage_layer_color':
                            $fieldOk = Helper::isColor($_POST[$field]);
                            break;
                        default:
                            esc_sql($_POST[$field]);
                            $fieldOk = true;
                            break;
                    }
                }
                if ($fieldOk) {
                    update_option($field, $_POST[$field]);
                }
            }
        }
    }