<?php
/**
 * Munk Block Editor Settings
 *
 * @package munk
 *
 * @since 1.2.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add CSS to the admin side of the block editor.
 *
 * @since 1.2.0
 */
if ( ! function_exists( 'munk_enqueue_block_editor_assets' ) ) :
function munk_enqueue_block_editor_assets() {
    
	wp_enqueue_script( 'munk-block-editor', get_template_directory_uri() . '/assets/js/editor.js', array( 'jquery' ), MUNK_THEME_VERSION, true );               
    
    $munk_layout_container_default_ed = get_theme_mod('munk_layout_container_default_ed', 'default');

    // Localize the script with new data
    $translation_array = array(
        'munk_container_ed' => esc_attr($munk_layout_container_default_ed),     
    );
    
    wp_localize_script( 'munk-block-editor', 'Munk_Editor_Arr', $translation_array );    

}
add_action( 'enqueue_block_editor_assets', 'munk_enqueue_block_editor_assets' );
endif;

/**
 * Gutenberg layout check
 * 
 * @return string
 */
if ( ! function_exists( 'munk_block_editor_type_check' ) ) :
function munk_block_editor_type_check() {

    $munk_layout_ed = '';                
    
    $screen = get_current_screen();
    
	if( $screen->is_block_editor() ) {		
    
        $post_type_ed = $screen->post_type;

        $munk_layout_ed = '';                

        if ($post_type_ed == 'page') {    
            $munk_layout_ed = get_theme_mod('munk_layout_single_page_ed', 'right-sidebar');
        }
        elseif ($post_type_ed == 'post') {
            $munk_layout_ed = get_theme_mod('munk_layout_single_post_ed', 'right-sidebar');
        }                         

        return esc_attr($munk_layout_ed);
        
    }
    
    return esc_attr($munk_layout_ed);
    
}
endif;
/**
 * Gutenberg layout class 
 *
 * @param string $classes
 * @return string
 */
if ( ! function_exists( 'munk_block_editor_body_class' ) ) :
function munk_block_editor_body_class( $classes ) {    
    
	$screen = get_current_screen();
	if( ! $screen->is_block_editor() )
		return $classes;
	
	$post_id = isset( $_GET['post'] ) ? intval( $_GET['post'] ) : false;
    
	if( $post_id ) {
        
        //check sidebar    
        $sidebar_ed = get_post_meta( $post_id, 'munk_settings_main_sidebar', true );     
        if ($sidebar_ed && $sidebar_ed != 'default') {
            $classes .= ' munk-sidebar-type-'. esc_attr($sidebar_ed). ' ';	
        }
        else {
            $classes .= ' munk-sidebar-type-'.  munk_block_editor_type_check() . ' ';            
        }                
        
        //check container
        $container_ed = get_post_meta( $post_id, 'munk_settings_page_container', true );     
        if ($container_ed && $container_ed != 'default') {
            $classes .= ' munk-container-type-'. esc_attr($container_ed). ' ';	
        }
        else {
            $classes .= ' munk-container-type-'. esc_attr(get_theme_mod('munk_layout_container_default_ed', 'default')). ' ';	          
        }  
        
        //check padding
        $padding_ed = get_post_meta( $post_id, 'munk_settings_disable_content_padding', true );     
        if ($padding_ed) {
            $classes .= ' munk-disable-padding ';	
        }  
        
    }
    
    else {
        $munk_layout_single_page_ed = munk_block_editor_type_check();            
        $munk_layout_container_default_ed = get_theme_mod('munk_layout_container_default_ed', 'default');           
        $classes .= ' munk-sidebar-type-' . esc_attr($munk_layout_single_page_ed) . ' ';
        $classes .= ' munk-container-type-' . esc_attr($munk_layout_container_default_ed) . ' ';
    }
    
	return $classes;
}
add_filter( 'admin_body_class', 'munk_block_editor_body_class' );
endif;

/**
 * Gutenberg layout inline styles 
 * 
 * @return css
 */
if ( ! function_exists( 'munk_block_editor_inline_style' ) ) :
function munk_block_editor_inline_style() {
    
    $screen = get_current_screen();
	if( $screen->is_block_editor() ) {		
        
        //padding check
        $munk_page_padding = get_theme_mod('munk_layout_single_page_entry_padding', array('padding_top'=> '45px','padding_right'=> '45px','padding_bottom'=> '45px','padding_left'=> '45px'));

        //container check
        $munk_layout_single_page_ed = munk_block_editor_type_check();            
        $munk_layout_container_default_ed = get_theme_mod('munk_layout_container_default_ed', 'default');   

        // get customizer container widths            
        $munk_layout_default_container_width        = get_theme_mod('munk_layout_default_container_width', '1140'); //default  
        $munk_layout_boxed_container_inner_width    = get_theme_mod('munk_layout_boxed_container_inner_width', '1140'); // boxed
        $munk_layout_contained_container_width      = get_theme_mod('munk_layout_contained_container_width', '1140'); // fullwidth-container  

        //body background color
        $body_background_color = get_theme_mod('background_color', 'f5f6f7');                
        $body_background_color_fullwidth_contained = get_theme_mod('munk_color_general_bgcolor', '#ffffff');                
        ?>

                    <style type='text/css' media='all' id="munk_editor_inline_styles">                                                   
                            
                            .block-editor-writing-flow  {
                                padding-top: <?php echo esc_attr($munk_page_padding['padding_top']); ?>;
                                padding-right: <?php echo esc_attr( $munk_page_padding['padding_right']); ?>;
                                padding-bottom: <?php echo esc_attr( $munk_page_padding['padding_bottom']); ?>;
                                padding-left: <?php echo esc_attr( $munk_page_padding['padding_left']); ?>;
                            }          

                            body.munk-disable-padding .block-editor-writing-flow {
                                padding: 0px;                                
                            }   
                    
                            body .edit-post-visual-editor>.block-editor__typewriter {
                                background-color: #<?php echo esc_attr( $body_background_color ); ?>;                                
                            }
                        
                            body.munk-container-type-fullwidth-contained .edit-post-visual-editor>.block-editor__typewriter {
                                background-color: <?php echo esc_attr( $body_background_color_fullwidth_contained ); ?>;                                
                            }                        
                    
                            body .block-editor-writing-flow {    
                                margin: 0 auto;                                
                            }
                            
                            /* Default Container */
                            .munk-sidebar-type-left-sidebar.munk-container-type-default .block-editor-writing-flow,
                            .munk-sidebar-type-right-sidebar.munk-container-type-default .block-editor-writing-flow,
                            .munk-sidebar-type-left-sidebar.munk-container-type-default .wp-block,
                            .munk-sidebar-type-right-sidebar.munk-container-type-default .wp-block {                                   
                                max-width: calc(<?php echo esc_attr( $munk_layout_default_container_width ); ?>px - 410px);
                            }                                                                                          
                            .munk-sidebar-type-no-sidebar.munk-container-type-default .block-editor-writing-flow {      
                                max-width: <?php echo esc_attr( $munk_layout_default_container_width ); ?>px;
                            }                       
                            .munk-sidebar-type-no-sidebar.munk-container-type-default .wp-block {
                                    max-width: <?php echo esc_attr( $munk_layout_default_container_width ); ?>px;
                            }
                    
                            /* Boxed Container */                        
                            .munk-sidebar-type-left-sidebar.munk-container-type-boxed .block-editor-writing-flow,
                            .munk-sidebar-type-right-sidebar.munk-container-type-boxed .block-editor-writing-flow,
                            .munk-sidebar-type-left-sidebar.munk-container-type-boxed .wp-block,
                            .munk-sidebar-type-right-sidebar.munk-container-type-boxed .wp-block {    
                                max-width: calc(<?php echo esc_attr( $munk_layout_boxed_container_inner_width ); ?>px - 410px);
                            }                                                                                          
                            .munk-sidebar-type-no-sidebar.munk-container-type-boxed .block-editor-writing-flow,
                            .munk-sidebar-type-no-sidebar.munk-container-type-boxed .wp-block {   
                                max-width: <?php echo esc_attr( $munk_layout_boxed_container_inner_width ); ?>px;
                            }                                          
                    
                            /* Full Width Contained Container */                        
                            .munk-sidebar-type-left-sidebar.munk-container-type-fullwidth-contained .block-editor-writing-flow,
                            .munk-sidebar-type-right-sidebar.munk-container-type-fullwidth-contained .block-editor-writing-flow,
                            .munk-sidebar-type-left-sidebar.munk-container-type-fullwidth-contained .wp-block,
                            .munk-sidebar-type-right-sidebar.munk-container-type-fullwidth-contained .wp-block {  
                                 max-width: calc(<?php echo esc_attr( $munk_layout_contained_container_width ); ?>px - 410px);
                            }                                                                                          
                            .munk-sidebar-type-no-sidebar.munk-container-type-fullwidth-contained .block-editor-writing-flow {
                                max-width: none;
                            }
                            .munk-sidebar-type-no-sidebar.munk-container-type-fullwidth-contained .wp-block {   
                                 max-width: <?php echo esc_attr( $munk_layout_contained_container_width ); ?>px;
                            }                              
                            .munk-sidebar-type-no-sidebar.munk-container-type-fullwidth-contained .wp-block[data-align="wide"] {   
                                 max-width: calc(<?php echo esc_attr( $munk_layout_contained_container_width ); ?>px + 20%);
                            } 
                            .munk-sidebar-type-no-sidebar.munk-container-type-fullwidth-contained .wp-block[data-align="full"] {                                   
                                 max-width: 100vw;                                
                            }                         
                    
                            /* Fluid Container */                        
                            .munk-sidebar-type-left-sidebar.munk-container-type-fluid .block-editor-writing-flow,
                            .munk-sidebar-type-right-sidebar.munk-container-type-fluid .block-editor-writing-flow,
                            .munk-sidebar-type-left-sidebar.munk-container-type-fluid .wp-block,
                            .munk-sidebar-type-right-sidebar.munk-container-type-fluid .wp-block {  
                                max-width: calc(100% - 410px);
                            }                                                                                          
                            .munk-sidebar-type-no-sidebar.munk-container-type-fluid .block-editor-writing-flow {
                            max-width: none;    
                            }
                            .munk-sidebar-type-no-sidebar.munk-container-type-fluid .wp-block {   
                                max-width: 100%;
                            }   
                            body.munk-editor-disable-title .edit-post-visual-editor__post-title-wrapper {
                                opacity: 0.2;
                            }
                        

                    </style>

        <?php
        
    }
}
add_action('admin_head', 'munk_block_editor_inline_style');
endif;