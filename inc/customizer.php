<?php
/**
 * flexstarter Theme Customizer
 *
 * @package flexstarter
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


 /* =============
 Sanitization Added
 ==============*/
 //checkbox sanitize
if ( ! function_exists( 'flexstarter_checkbox_sanitization' ) ) {
    function flexstarter_checkbox_sanitization( $checked ) {
        // Boolean check.
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }
}


//File sanitize
        if ( ! function_exists( 'flexstarter_file_sanitization' ) ) {
            function flexstarter_file_sanitization( $file, $setting ) {
              
                //allowed file types
                $mimes = array(
                    'jpg|jpeg|jpe' => 'image/jpeg',
                    'gif'          => 'image/gif',
                    'png'          => 'image/png'
                );
                  
                //check file type from file name
                $file_ext = wp_check_filetype( $file, $mimes );
                  
                //if file has a valid mime type return it, otherwise return default
                return ( $file_ext['ext'] ? $file : $setting->default );
            }
        }

//Select sanitize menu alignment
        if ( ! function_exists ( 'flexstarter_select_sanitization_align' ) ){
        function flexstarter_select_sanitization_align( $input ) {
            $align = array(
                'sina-menu-left' => 'Left',
                'sina-menu-center' => 'Center',
                'sina-menu-right' => 'Right',
                );
             if ( array_key_exists( $input, $align ) ) {
              return $input;
                } else {
              return '';
            }
        }
    }
//Select sanitize
        if ( ! function_exists ( 'flexstarter_select_sanitization' ) ){
            function flexstarter_select_sanitization( $input ) {
                $checkyn = array(
                    'yes' => 'Yes',
                    'no' => 'No',
                    );
             if ( array_key_exists( $input, $checkyn ) ) {
              return $input;
                } else {
              return '';
            }
        }
    }


/* END of Sanitizations */


function flexstarter_customize_register( $wp_customize ) {
    /*=========================
    Theme Options Added
    =========================*/
    // Creating Panel
    $wp_customize->add_panel(
        'flexstarter_theme_options', 
        array (
            'title' => esc_html__('Theme Options', 'flexstarter'),
            'priority' => 160,
        ));

    // Adding Section in panel
    $wp_customize->add_section(
        'menu_option',
        array(
            'title' => esc_html__( 'Navigation Menu Options', 'flexstarter' ),
            'panel' => 'flexstarter_theme_options',
            'priority' => 30,
        )
    );
    // Nav alignment configure
    $wp_customize->add_setting( 
        'main_menu_setting', 
        array(
        'default'   => 'sina-menu-left',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexstarter_select_sanitization_align',
    ) );

    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'menu_alignment_setting', array(
        'label' => esc_html__( 'Menu Alignment', 'flexstarter' ),
        'section'    => 'menu_option',
        'settings'   => 'main_menu_setting',
        'type'    => 'select',
        'choices' => array(
            'sina-menu-left' => esc_html__('Left', 'flexstarter'),
            'sina-menu-center' => esc_html__('Center', 'flexstarter'),
            'sina-menu-right' => esc_html__('Right', 'flexstarter'),
        )
    ) ) );

    // Nav Fixed to Top Configure
    $wp_customize->add_setting( 
        'fixed_nav_setting', 
        array(
        'default'   => 'no',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexstarter_select_sanitization',
    ) );

    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'fixed_nav_setting', array(
        'label' => esc_html__( 'Enable Fixed Menu', 'flexstarter' ),
        'section'    => 'menu_option',
        'settings'   => 'fixed_nav_setting',
        'type'    => 'select',
        'choices' => array(
            'yes' => esc_html__( 'Yes', 'flexstarter' ),
            'no' => esc_html__( 'No', 'flexstarter' ),
        )
    ) ) );

    // Right Search Configure
    $wp_customize->add_setting( 
        'right_search_setting', 
        array(
        'default'   => 'no',
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'flexstarter_select_sanitization',
    ) );

    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'right_search_setting', array(
        'label' => esc_html__( 'Show Right Side Search Option', 'flexstarter' ),
        'section'    => 'menu_option',
        'settings'   => 'right_search_setting',
        'type'    => 'select',
        'choices' => array(
            'yes' => esc_html__( 'Yes', 'flexstarter' ),
            'no' => esc_html__( 'No', 'flexstarter' ),
        )
    ) ) );



    /*=============
    Header background section for different pages
    =============*/
    $wp_customize->add_section(
        'title_bg_section',
        array(
            'title' => esc_html__( 'Page Title Customization', 'flexstarter' ),
            'panel'  => 'flexstarter_theme_options',
            'priority' => 30,
        )
    );


    //color selection BLOG page
    $wp_customize->add_setting(
        'blog_title_bg_color',
        array(
            'default'     => '#333',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'blog_title_bg_color',
            array(
                'label'      => esc_html__( 'Blog page title background color', 'flexstarter' ),
                'section'    => 'title_bg_section',
                'settings'   => 'blog_title_bg_color',
            ) )
    );


    //image selection BLOG page
        $wp_customize->add_setting( 
            'blog_title_bg_image', 
            array(
                'sanitize_callback' => 'flexstarter_file_sanitization'
            )
        );
          
          
        $wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 
                'blog_title_bg_image', 
                array(
                    'label'      => esc_html__( 'Blog page title background image', 'flexstarter' ),
                    'section'    => 'title_bg_section'                   
                )
            ) 
        );  
    

    //color selection ARCHIVE/CATEGORY/TAG page
    $wp_customize->add_setting(
        'archive_title_bg_color',
        array(
            'default'     => '#333',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'archive_title_bg_color',
            array(
                'label'      => esc_html__( 'Archive page title background color', 'flexstarter' ),
                'section'    => 'title_bg_section',
                'settings'   => 'archive_title_bg_color',
            ) )
    );


    //image selection ARCHIVE/CATEGORY/TAG page
        $wp_customize->add_setting( 
            'archive_title_bg_image', 
            array(
                'sanitize_callback' => 'flexstarter_file_sanitization'
            )
        );
          
          
        $wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 
                'archive_title_bg_image', 
                array(
                    'label'      => esc_html__( 'Archive page title background image', 'flexstarter' ),
                    'section'    => 'title_bg_section'                   
                )
            ) 
        );  
    

    //color selection SEARCH page
    $wp_customize->add_setting(
        'search_title_bg_color',
        array(
            'default'     => '#333',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'search_title_bg_color',
            array(
                'label'      => esc_html__( 'Search page title background color', 'flexstarter' ),
                'section'    => 'title_bg_section',
                'settings'   => 'search_title_bg_color',
            ) )
    );


    //image selection SEARCH page
        $wp_customize->add_setting( 
            'search_title_bg_image', 
            array(
                'sanitize_callback' => 'flexstarter_file_sanitization'
            )
        );
          
          
        $wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 
                'search_title_bg_image', 
                array(
                    'label'      => esc_html__( 'Search page title background image', 'flexstarter' ),
                    'section'    => 'title_bg_section'                   
                )
            ) 
        );  
    

    //color selection 404 page
    $wp_customize->add_setting(
        'nfound_title_bg_color',
        array(
            'default'     => '#333',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'nfound_title_bg_color',
            array(
                'label'      => esc_html__( '404 page title background color', 'flexstarter' ),
                'section'    => 'title_bg_section',
                'settings'   => 'nfound_title_bg_color',
            ) )
    );


    //image selection 404 page
        $wp_customize->add_setting( 
            'nfound_title_bg_image', 
            array(
                'sanitize_callback' => 'flexstarter_file_sanitization'
            )
        );
          
          
        $wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 
                'nfound_title_bg_image', 
                array(
                    'label'      => esc_html__( '404 page title background image', 'flexstarter' ),
                    'section'    => 'title_bg_section'                   
                )
            ) 
        );  

    /*============ 
    Adding Section in panel for Other Customization
    ============*/
    $wp_customize->add_section(
        'other_customize',
        array(
            'title' => esc_html__( 'Other Customization', 'flexstarter' ),
            //'description' => esc_html__( 'This is a section for the nav', 'flexstarter' ),
            'panel' => 'flexstarter_theme_options',
            'priority' => 30,
        )
    ); // Custom theme option ends


	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'flexstarter_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'flexstarter_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'flexstarter_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function flexstarter_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function flexstarter_customize_partial_blogdescription() {
	bloginfo( 'description' );
}



// flexstarter generate CSS added
add_action( 'wp_head', 'flexstarter_gen_customizer_css');
function flexstarter_gen_customizer_css()
{
    ?>
    <style type="text/css">
        .blog-title { background-color: <?php echo esc_attr(get_theme_mod('blog_title_bg_color', '#333')); ?>; 
        <?php if(!empty(get_theme_mod('blog_title_bg_image'))) :  ?>
            background-image: url(
        <?php echo esc_url(get_theme_mod('blog_title_bg_image')); ?>); <?php endif;  ?> }

        .archive-title { background-color: <?php echo esc_attr(get_theme_mod('archive_title_bg_color', '#333')); ?>; 
        <?php if(!empty(get_theme_mod('archive_title_bg_image'))) :  ?>
            background-image: url(
        <?php echo esc_url(get_theme_mod('archive_title_bg_image')); ?>); <?php endif;  ?> }

        .search-title { background-color: <?php echo esc_attr(get_theme_mod('search_title_bg_color', '#333')); ?>; 
        <?php if(!empty(get_theme_mod('search_title_bg_image'))) : ?>
            background-image: url(
        <?php echo esc_url(get_theme_mod('search_title_bg_image')); ?>); <?php endif;  ?> }

        .nfound-title { background-color: <?php echo esc_attr(get_theme_mod('nfound_title_bg_color', '#333')); ?>; 
        <?php if(!empty(get_theme_mod('nfound_title_bg_image'))) : ?>
            background-image: url(
        <?php echo esc_url(get_theme_mod('nfound_title_bg_image')); ?>); <?php endif;  ?> }
    </style>
    <?php
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function flexstarter_customize_preview_js() {
	wp_enqueue_script( 'flexstarter-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'flexstarter_customize_preview_js' );
