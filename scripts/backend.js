var NGSMaintenancePageInterval = false;
var NGSMaintenancePageText = '';
jQuery('Document').ready(function($){
    NGSMaintenancePageInterval = setInterval(function(){
        if (jQuery('#NGSMaintenancePage_backgroundImage').val() == NGSMaintenancePageText){
            return;
        }
        NGSMaintenancePageText = jQuery('#NGSMaintenancePage_backgroundImage').val();
        start = NGSMaintenancePageText.indexOf('src="')+5;
        end = NGSMaintenancePageText.indexOf('"', start);
        if (start == -1 || end == -1){
            return;
        }
        NGSMaintenancePageText = NGSMaintenancePageText.substr(start, (end - start))
        jQuery('#NGSMaintenancePage_backgroundImage').val(NGSMaintenancePageText);
    }, 1000);
    
    // turn inputs with class colorpicker into color picker crontrol
    $('.color-field').wpColorPicker();
});