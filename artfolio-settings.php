<?php

/*
* Artfolio Global Settings
*/
function artfolio_settings_page() { ?>
<div class="wrap">
    <h1>Artfolio Settings</h1>
    <hr />
    <form method="post" action="options.php">
        <?php
    settings_fields( 'main' );

    do_settings_sections( 'theme-options' );
    submit_button();
        ?>
    </form>
</div>
<?php }

function artfolio_settings_add_menu() {
    add_theme_page( 'Artfolio Settings', 'Artfolio Settings', 'manage_options', 'custom-settings', 'artfolio_settings_page', null, 99);
}
add_action( 'admin_menu', 'artfolio_settings_add_menu' );


/*
    Show / hide heart in footer
*/
function artfolio_heart() { ?>
<input type="checkbox" name="heartAnimation" id="heartAnimation" value="1" <?php checked( 1, get_option( 'heartAnimation' ) ) ?> />
<?php
                          }


/*
    Show/hide slider/background-image in main section ( slider by default )
*/
function artfolio_slider() { ?>
<input type="checkbox" name="mainSlider" id="mainSlider" value="1" <?php checked( 1, get_option( 'mainSlider' ) ) ?> />
<?php
                           }


function artfolio_settings_page_setup() {
    add_settings_section( 'main', '** Main settings **', null, 'theme-options' );

    /* Header settings */
    add_settings_field( 'mainSlider', 'Show slider ( image with logo by default ) ?', 'artfolio_slider', 'theme-options', 'main' );

    /* Footer settings */
    add_settings_field( 'heartAnimation', 'Show heart animation ?', 'artfolio_heart', 'theme-options', 'main' );

    register_setting( 'main', 'mainSlider' );
    register_setting( 'main', 'heartAnimation' );
}
add_action( 'admin_init', 'artfolio_settings_page_setup' );


?>