<?php
/**
 * Artfolio Theme Customizer.
 *
 * @package Artfolio
 */


/*
* Add postMessage support for site title and description for the Theme Customizer.
* Add slider support for Index page only
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function artfolio_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    /*
    * Add Slider Section
    */
    $wp_customize->add_section(
        'artfolio_slider_section',
        array(
            'title'       => __( 'Slider', 'artfolio' ),
            'capability'  => 'edit_theme_options',
        )
    );


    /*
    * Show / hide slider
    */
    $wp_customize->add_setting(
        'show_slider'
    );

    $wp_customize->add_control(
        'show_slider',
        array(
            'type' => 'checkbox',
            'label' => __( 'Show slider', 'artfolio' ),
            'section' => 'artfolio_slider_section',
        )
    );

    for ($i = 1; $i <= 3; ++$i) {

        $artfolio_slideTitleId = 'artfolio_slide' . $i . '_title';
        $artfolio_slideContentId = 'artfolio_slide' . $i . '_content';
        $artfolio_slideReadmoreLinkId = 'artfolio_slide' . $i . '_readmorelink';
        $artfolio_slideImageId = 'artfolio_slide' . $i .'_image';
        $artfolio_defaultSliderImagePath = get_template_directory_uri() . '/images/slider/' . $i . '.jpg';


        /*
        * Add Slide title
        */
        $wp_customize->add_setting(
            $artfolio_slideTitleId,
            array(
                'default' => __( 'Some title', 'artfolio' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );


        /*
        * Add Slide Content
        */
        $wp_customize->add_setting(
            $artfolio_slideContentId,
            array(
                'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'artfolio' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        /*
        * Add Slide Read more link
        */
        $wp_customize->add_setting(
            $artfolio_slideReadmoreLinkId,
            array(
                'default' => __( '#', 'artfolio' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );


        /*
            Add Slide Background Image
        */
        $wp_customize->add_setting( $artfolio_slideImageId,
                                   array(
                                       'default' => $artfolio_defaultSliderImagePath,
                                       'sanitize_callback' => 'esc_url_raw'
                                   )
                                  );


        /*
            Slider's title
        */
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $artfolio_slideTitleId,
                                                             array(
                                                                 'label' => sprintf( __( 'Slide #%s title', 'artfolio' ), $i ),
                                                                 'section' => 'artfolio_slider_section',
                                                                 'settings' => $artfolio_slideTitleId,
                                                                 'type' => 'text',
                                                             )
                                                            )
                                  );


        /*
            Slider's content
        */
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $artfolio_slideContentId,
                                                             array(
                                                                 'label' => sprintf( __( 'Slide #%s Content', 'artfolio' ), $i ),
                                                                 'section' => 'artfolio_slider_section',
                                                                 'settings' => $artfolio_slideContentId,
                                                                 'type' => 'textarea',
                                                             )
                                                            )
                                  );


        /*
            Slider's read more link
        */
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $artfolio_slideReadmoreLinkId,
                                                             array(
                                                                 'label' => sprintf( __( 'Slide #%s read more link', 'artfolio' ), $i ),
                                                                 'section' => 'artfolio_slider_section',
                                                                 'settings' => $artfolio_slideReadmoreLinkId,
                                                                 'type' => 'text',
                                                             )
                                                            )
                                  );


        /*
            Background Image
        */
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $artfolio_slideImageId,
                                                                   array(
                                                                       'label'   	 => sprintf( __( 'Slide #%s Image', 'artfolio' ), $i ),
                                                                       'section' 	 => 'artfolio_slider_section',
                                                                       'settings'   => $artfolio_slideImageId,
                                                                   )
                                                                  )
                                  );
    }

    /*
    * Add Footer Section
    */
    $wp_customize->add_section(
        'artfolio_footer_section',
        array(
            'title'       => __( 'Footer', 'artfolio' ),
            'description'       => __( 'Settings for the footer of the website', 'artfolio' ),
            'capability'  => 'edit_theme_options',
        )
    );


    /*
    * Copyright text
    */
    $wp_customize->add_setting(
        'copyright_textbox',
        array(
            'default' => __( 'All rights reserved by Artem Solovev', 'artfolio' ),
        )
    );

    $wp_customize->add_control(
        'copyright_textbox',
        array(
            'label' => __( 'Copyright text', 'artfolio' ),
            'section' => 'artfolio_footer_section',
            'type' => 'text',
        )
    );


    /*
    * Show / hide copyright text
    */
    $wp_customize->add_setting(
        'hide_copyright'
    );

    $wp_customize->add_control(
        'hide_copyright',
        array(
            'type' => 'checkbox',
            'label' => __( 'Hide copyright text', 'artfolio' ),
            'section' => 'artfolio_footer_section',
        )
    );


    /*
    * Show / hide social menu
    */
    $wp_customize->add_setting(
        'hide_socialmenu'
    );

    $wp_customize->add_control(
        'hide_socialmenu',
        array(
            'type' => 'checkbox',
            'label' => __( 'Hide social menu', 'artfolio' ),
            'section' => 'artfolio_footer_section',
        )
    );


    /*
    * Show / hide social menu
    */
    $wp_customize->add_setting(
        'hide_developer_link'
    );

    $wp_customize->add_control(
        'hide_developer_link',
        array(
            'type' => 'checkbox',
            'label' => __( 'Hide developer link', 'artfolio' ),
            'section' => 'artfolio_footer_section',
        )
    );


    /*
    * Show / hide WordPress link
    */
    $wp_customize->add_setting(
        'hide_wordpress_link'
    );

    $wp_customize->add_control(
        'hide_wordpress_link',
        array(
            'type' => 'checkbox',
            'label' => __( 'Hide WordPress link', 'artfolio' ),
            'section' => 'artfolio_footer_section',
        )
    );


    /*
    * Show / hide heart animation
    */
    $wp_customize->add_setting(
        'hide_heart_animation'
    );

    $wp_customize->add_control(
        'hide_heart_animation',
        array(
            'type' => 'checkbox',
            'label' => __( 'Hide heart animation', 'artfolio' ),
            'section' => 'artfolio_footer_section',
        )
    );
}
add_action( 'customize_register', 'artfolio_customize_register' );


/*
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously
 */
function artfolio_customize_preview_js() {
    wp_enqueue_script( 'artfolio_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'artfolio_customize_preview_js' );
