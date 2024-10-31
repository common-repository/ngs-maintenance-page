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
<!DOCTYPE html>
<html>
<head>
<title><?php echo bloginfo('name'); ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel='stylesheet' id='NGSMaintenancePage_Frontend_Styles-css'  href='<?php echo plugin_dir_url(dirname(dirname(__DIR__)) . '/index.php'); ?>styles/frontend.css?ver=<?php echo Helper::getPluginData('Version', 'string'); ?>' type='text/css' media='all' />
<style>
    <?php
        if (Helper::isColor(get_option('NGSMaintenancePage_headline_color'))){
            $ngsMaintenanceColors['headline'] = get_option('NGSMaintenancePage_headline_color');
        } else {
            $ngsMaintenanceColors['headline'] = '#edae02';
        }
        if (Helper::isColor(get_option('NGSMaintenancePage_text_color'))){
            $ngsMaintenanceColors['text'] = get_option('NGSMaintenancePage_text_color');
        } else {
            $ngsMaintenanceColors['text'] = '#edae02';
        }
        if (Helper::isColor(get_option('NGSMaintenancePage_layer_color'))){
            $ngsMaintenanceColors['layer'] = get_option('NGSMaintenancePage_layer_color');
        } else {
            $ngsMaintenanceColors['layer'] = '#edae02';
        }
    ?>
    .info{background-color: <?php echo $ngsMaintenanceColors['layer']; ?>;}
    .info h1{color: <?php echo $ngsMaintenanceColors['text']; ?>;}
    .info p{color: <?php echo $ngsMaintenanceColors['headline']; ?>;}
</style>
</head>
<body
<?php 
if (get_option('NGSMaintenancePage_backgroundImage')) { 
    echo ' style="background-image: url( \'' . get_option('NGSMaintenancePage_backgroundImage') . '\'); z-index: -9999; background-repeat: no-repeat; background-attachment: fixed; background-position: center; ';
}
if (get_option('NGSMaintenancePage_stretchBackgroundImage') == 'Ja') { 
    echo ' background-size: 100% 100%;';
}
echo '"';
?>
>
<?php if (get_option('NGSMaintenancePage_backgroundVideo')) {?>
<div id="videoHolder" style="position: fixed; z-index: -9999; width: 100%; height: 100%"></div>
<?php } ?>
<div class="infoHolder">
    <div class="info">
    <?php if ($headline = get_option('NGSMaintenancePage_headline')) { ?>
        <h1><?php echo $headline; ?></h1>
    <?php } ?>
    <?php if ($text = get_option('NGSMaintenancePage_text')) { ?>
        <p>
        <?php echo $text; ?>
        </p>
    <?php } ?>
    </div>
</div>
<script async src="https://www.youtube.com/iframe_api"></script>
<script>
 function onYouTubeIframeAPIReady() {
    if (window.matchMedia("(max-width: 35em)").matches) {
        return;
    }

    var player;
    player = new YT.Player('videoHolder', {
    videoId: '<?php echo get_option('NGSMaintenancePage_backgroundVideo'); ?>', // YouTube Video ID
    width: 560,               // Player width (in px)
    height: 316,              // Player height (in px)
    playerVars: {
        autoplay: 1,        // Auto-play the video on load
        controls: 0,        // Show pause/play buttons in player
        showinfo: 0,        // Hide the video title
        loop: 1,            // Run the video in a loop
        autohide: 1         // Hide video controls when playing
    },
    events: {
        onReady: function(e) {
            console.log(e);
            e.target.mute();
        },
        onStateChange: function(e){
            if (e.data === YT.PlayerState.ENDED) {
                player.playVideo(); 
            }
        }
    }
    });
 }
</script>
</body></html>