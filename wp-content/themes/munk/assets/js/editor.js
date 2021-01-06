// Editor Layout Sidebar
jQuery(document).ready(function($) {
  var munk_settings_main_sidebar = $('#munk_settings_main_sidebar');
  
  $(munk_settings_main_sidebar).on('change', function(){  
    var new_val = $(this).val();        
    $("body").removeClass (function (index, css) {
        return (css.match (/\munk-sidebar-type-\S+/g) || []).join(' ');
    });    
    
    $("body").addClass('munk-sidebar-type-' + new_val);  

  });
  
});

// Editor Layout Container
jQuery(document).ready(function($) {
  var munk_settings_page_container = $('#munk_settings_page_container');
  
  $(munk_settings_page_container).on('change', function(){  
    var new_val = $(this).val();        
    $("body").removeClass (function (index, css) {
        return (css.match (/\munk-container-type-\S+/g) || []).join(' ');
    });    
    
    if (new_val == 'default') {
        var container = Munk_Editor_Arr.munk_container_ed;
    }  
    else {
        var container = new_val;
    }
    $("body").addClass('munk-container-type-' + container);  

  });
  
});

// Editor Layout Padding
jQuery(document).ready(function($) {
  var munk_settings_disable_content_padding = $('#munk_settings_disable_content_padding');
  
    $(munk_settings_disable_content_padding).change(function() {
        if(this.checked) {
            $("body").addClass('munk-disable-padding');              
        }
        else {
            $("body").removeClass('munk-disable-padding');      
        }
    });
  
});

// Editor Hide Title Block
jQuery(document).ready(function($) {
  var munk_settings_disable_title = $('#munk_settings_disable_title');
  
    $(munk_settings_disable_title).change(function() {
        if(this.checked) {
            $("body").addClass('munk-editor-disable-title');
        }
        else {
            $("body").removeClass('munk-editor-disable-title');      
        }
    });
  
});