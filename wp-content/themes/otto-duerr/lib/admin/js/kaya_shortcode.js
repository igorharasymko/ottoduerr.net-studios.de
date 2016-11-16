var kayashortcode = { 
    init: function () { 
        jQuery("#shortcode_sendto_editor").click(function () {
            kayashortcode.send_to_editor()
        });
        jQuery(".sc_shortcodetype select").val("");
        jQuery(".sc_shortcodetype select").change(function () {
            jQuery(".second_step").hide();
            if (this.value != "") {
                jQuery("#shortcode_" + this.value).show()
            }
        });
        jQuery(".shortcode_subtype select").val("");
        jQuery(".shortcode_subtype select").change(function () {
            jQuery(this).closest(".second_step").children(".sub_second_step").hide();
            if (this.value != "") {
                jQuery("#sub_sc_" + this.value).show()
            }
        });
        var a = jQuery('[name="sc_tabs_number"]').val();
        jQuery("#shortcode_tabs table tr").each(function (b) {
            if (b > (1 + a * 2)) {
                jQuery(this).hide()
            } else {
                jQuery(this).show()
            }
        });
        jQuery('[name="sc_tabs_number"]').change(function () {
            var b = jQuery(this).val();
            jQuery("#shortcode_tabs table tr").each(function (c) {
                if (c > (b * 2)) {
                    jQuery(this).hide()
                } else {
                    jQuery(this).show()
                }
            })
        });
        jQuery("#shortcode_accordion table tr").each(function (b) {
            if (b > (a * 2)) {
                jQuery(this).hide()
            } else {
                jQuery(this).show()
            }
        });
        jQuery('[name="sc_accordion_number"]').change(function () {
            var b = jQuery(this).val();
            jQuery("#shortcode_accordion table tr").each(function (c) {
                if (c > (b * 2)) {
                    jQuery(this).hide()
                } else {
                    jQuery(this).show()
                }
            })
        })
    },
    send_to_editor: function () {
        send_to_editor(kayashortcode.create_the_editor())
    },
    create_the_editor: function () {
        var value = jQuery(".sc_shortcodetype select").val();
        switch (value) {
   
        case "layouts":
			
			var option =jQuery('[name="kaya_sc_'+ value +'_selector"]').val(); 
            switch (option) { 
            case "fivecolumn_layout":
		    return "\n[column5]\n" + jQuery('[name="kaya_sc_'+ value +'_'+option+'_1"]').val() + "\n[/column5]\n\n[column5]\n" 
			+jQuery('[name="kaya_sc_'+ value +'_'+option+'_2"]').val() + "\n[/column5]\n\n[column5]\n" 
			+jQuery('[name="kaya_sc_'+ value +'_'+option+'_3"]').val() + "\n[/column5]\n\n[column5]\n" 
			+jQuery('[name="kaya_sc_'+ value +'_'+option+'_4"]').val() + "\n[/column5]\n\n[column5_last]\n" 
			+jQuery('[name="kaya_sc_'+ value +'_'+option+'_5"]').val() + "\n[/column5_last]\n";
			 break;
			 case "fourcolumn_layout":
		    return "\n[column4]\n" + jQuery('[name="kaya_sc_'+ value +'_'+option+'_1"]').val() + "\n[/column4]\n\n[column4]\n" 
			+jQuery('[name="kaya_sc_'+ value +'_'+option+'_2"]').val() + "\n[/column4]\n\n[column4]\n" 
			+jQuery('[name="kaya_sc_'+ value +'_'+option+'_3"]').val() + "\n[/column4]\n\n[column4_last]\n" 
			+jQuery('[name="kaya_sc_'+ value +'_'+option+'_4"]').val() + "\n[/column4_last]\n";
			 break;
  
            }
            break;
			// lauout switch end
            }
        return ""
    }
};
jQuery(document).ready(function (a) { 
    kayashortcode.init()
});