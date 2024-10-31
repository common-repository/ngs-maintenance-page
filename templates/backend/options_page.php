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
    if (!defined( 'ABSPATH' )) {
        exit;
    }
?>
<h2><?php echo Backend::$plugin_data['Name']; ?></h2>
<div class="NGSMaintenancePage_options_page">
    <form method="post">
        <table class="form-table">
            <tr>
                <th>
                    <label for="NGSMaintenancePage_maintenanceMode"><?php echo __('Wartungsmodus', 'ngs-maintenance-page'); ?></label>
                </th>
                <td>
                    <p><?php echo __('Soll der Wartungsmodus aktiviert werden?', 'ngs-maintenance-page'); ?></p>
                    <p><input type="radio" id="NGSMaintenancePage_maintenanceMode" name="NGSMaintenancePage_maintenanceMode" value="aktiv" <?php echo get_option('NGSMaintenancePage_maintenanceMode') == 'aktiv' ? 'checked="checked"' : ''; ?>><?php echo __('Ja, bitte aktiviere den Wartungsmodus.', 'ngs-maintenance-page'); ?></p>
                    <p><input type="radio" id="NGSMaintenancePage_maintenanceMode" name="NGSMaintenancePage_maintenanceMode" value="inaktiv" <?php echo get_option('NGSMaintenancePage_maintenanceMode') != 'aktiv' ? 'checked="checked"' : ''; ?>><?php echo __('Nein, bitte aktiviere den Wartungsmodus nicht.', 'ngs-maintenance-page'); ?></p>
                    </td>
            </tr>
            <tr>
                <th>
                    <label for="NGSMaintenancePage_headline"><?php echo __('Headline', 'ngs-maintenance-page') ?></label>
                </th>
                <td>
                    <input type="text" id="NGSMaintenancePage_headline" name="NGSMaintenancePage_headline" value="<?php echo get_option('NGSMaintenancePage_headline') ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="NGSMaintenancePage_headline_color"><?php echo __('Headline Color', 'ngs-maintenance-page') ?></label>
                </th>
                <td>
                    <input type="text" id="NGSMaintenancePage_headline_color" class="color-field" name="NGSMaintenancePage_headline_color" value="<?php echo get_option('NGSMaintenancePage_headline_color') ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="NGSMaintenancePage_text"><?php echo __('Text', 'ngs-maintenance-page') ?></label>
                </th>
                <td>
                    <?php wp_editor(esc_attr(get_option('NGSMaintenancePage_text')), 'NGSMaintenancePage_text', $settings = ['textarea_name' => 'NGSMaintenancePage_text']); ?>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="NGSMaintenancePage_text_color"><?php echo __('Text Color', 'ngs-maintenance-page') ?></label>
                </th>
                <td>
                    <input type="text" id="NGSMaintenancePage_text_color" class="color-field" name="NGSMaintenancePage_text_color" value="<?php echo get_option('NGSMaintenancePage_text_color') ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="NGSMaintenancePage_layer_color"><?php echo __('Layer Color', 'ngs-maintenance-page') ?></label>
                </th>
                <td>
                    <input type="text" id="NGSMaintenancePage_layer_color" class="color-field" name="NGSMaintenancePage_layer_color" value="<?php echo get_option('NGSMaintenancePage_layer_color') ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <h3><?php echo __('Hintergrund', 'ngs-maintenance-page') ?></h3>
                </th>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <th>
                    <label for="insert-media-button"><?php echo __('Hintergrundbild', 'ngs-maintenance-page') ?></label>
                </th>
                <td>
                    <p><?php echo __('In den Mobilen Ansichten kann kein Hintergrund Video angezeigt werden. Hier wäre es gut, ein Hintergrundbild anzuzeigen.'); ?></p>
                    <button data-editor="NGSMaintenancePage_backgroundImage" class="button insert-media add_media" id="insert-media-button" type="button">
                        <span class="wp-media-buttons-icon"></span> <?php echo __('Hintergrundbild hinzufügen', 'ngs-maintenance-page'); ?>
                    </button>
                    <input type="text" id="NGSMaintenancePage_backgroundImage" size="40" name="NGSMaintenancePage_backgroundImage" value="<?php echo esc_attr(get_option('NGSMaintenancePage_backgroundImage')); ?>" readonly="readonly">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="NGSMaintenancePage_stretchBackgroundImage"><?php echo __('Hintergrundbild Größe anpassen', 'ngs-maintenance-page'); ?></label>
                </th>
                <td>
                    <p><?php echo __('Die Größe des Hintergrundbildes kann so angepasst werden, dass sich das Bild über die gesamte Bildschirmgröße erstreckt. Soll die Größe des Hintergrundbildes angepasst werden?', 'ngs-maintenance-page'); ?></p>
                    <p> <input type="radio" id="NGSMaintenancePage_stretchBackgroundImage" name="NGSMaintenancePage_stretchBackgroundImage" value="Ja" <?php echo get_option('NGSMaintenancePage_stretchBackgroundImage') == 'Ja' ? 'checked="checked"' : ''; ?>><?php echo __('Ja, bitte passe die Größe an.', 'ngs-maintenance-page'); ?> </p>
                    <p> <input type="radio" id="NGSMaintenancePage_stretchBackgroundImage" name="NGSMaintenancePage_stretchBackgroundImage" value="Nein" <?php echo get_option('NGSMaintenancePage_stretchBackgroundImage') == 'Nein' ? 'checked="checked"' : ''; ?>><?php echo __('Nein, bitte passe die nicht Größe an.', 'ngs-maintenance-page'); ?> </p>
                    </td>
            </tr>
            <tr>
                <th>
                    <label for="NGSMaintenancePage_backgroundVideo"><?php echo __('Background Video', 'ngs-maintenance-page') ?></label>
                </th>
                <td>
                    <p><?php echo __('Gib hier  den 11 Zeichenlangen Youtube Indikator an, um ein Youtube Video einzubinden', 'ngs-maintenance-page'); ?></p>
                    <input type="text" id="NGSMaintenancePage_backgroundVideo" size="11" name="NGSMaintenancePage_backgroundVideo" value="<?php echo esc_attr(get_option('NGSMaintenancePage_backgroundVideo')); ?>">
                </td>
            </tr>
        </table>
        <button type="submit"><?php echo __('Save', 'ngs-maintenance-page'); ?></button>
        <input type="hidden" name="NGSMaintenancePage_nonce" value="<?php echo wp_create_nonce('NGSMaintenancePage_save'); ?>">
        <input type="hidden" name="NGSMaintenancePage_action" value="NGSMaintenancePage_save">
    </form>
</div>