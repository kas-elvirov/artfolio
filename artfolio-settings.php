<?php

/*
* Artfolio Global Settings
*/
function artfolio_settings_page() { ?>
<div class="wrap">
    <h1>Artfolio Settings</h1>
    <form method="post" action="options.php">
        <?php
    settings_fields('section');
    do_settings_sections('theme-options');
    submit_button();
        ?>
    </form>
</div>
<?php }

function artfolio_settings_add_menu() {
    add_menu_page( 'Artfolio Settings', 'Artfolio Settings', 'manage_options', 'custom-settings', 'artfolio_settings_page', null, 99);
}

add_action( 'admin_menu', 'artfolio_settings_add_menu' );

// Copyright setting
function artfolio_copyright() { ?>
<input type="text" name="copyright" id="copyright" value="<?php echo get_option( 'copyright' ); ?>" />
<?php }

function artfolio_settings_page_setup() {
    add_settings_section( 'section', 'All Settings', null, 'theme-options' );
    add_settings_field( 'copyright', 'Copyright text', 'artfolio_copyright', 'theme-options', 'section' );
    register_setting( 'section', 'copyright' );
}

add_action( 'admin_init', 'artfolio_settings_page_setup' );

?>