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
    settings_fields( 'footer' );
    do_settings_sections( 'theme-options' );
    submit_button();
        ?>
    </form>
</div>
<?php }

function artfolio_settings_add_menu() {
    add_menu_page( 'Artfolio Settings', 'Artfolio Settings', 'manage_options', 'custom-settings', 'artfolio_settings_page', null, 99);
}
add_action( 'admin_menu', 'artfolio_settings_add_menu' );


/*
    Copyright setting
*/
function artfolio_copyright() { ?>
<input type="text" name="copyright" id="copyright" value="<?php echo get_option( 'copyright' ); ?>" />
<?php }


/*
    Show / hide social menu in footer
*/
function artfolio_footer_social_menu() { ?>
<input type="checkbox" name="socialMenu" id="socialMenu" value="1" <?php checked( 1, get_option( 'socialMenu' ) ) ?> />
<?php
}


/*
    Show / hide developer link in footer
*/
function artfolio_developer_link() { ?>
<input type="checkbox" name="developerLink" id="developerLink" value="1" <?php checked( 1, get_option( 'developerLink' ) ) ?> />
<?php
}

/*
    Show / hide wordpress link in footer
*/
function artfolio_wordpress_link() { ?>
<input type="checkbox" name="wordpressLink" id="wordpressLink" value="1" <?php checked( 1, get_option( 'wordpressLink' ) ) ?> />
<?php
}

function artfolio_settings_page_setup() {
    add_settings_section( 'footer', 'Footer settings', null, 'theme-options' );

    add_settings_field( 'copyright', 'Copyright text', 'artfolio_copyright', 'theme-options', 'footer' );
    add_settings_field( 'socialMenu', 'Show social-menu ?', 'artfolio_footer_social_menu', 'theme-options', 'footer' );
    add_settings_field( 'developerLink', 'Show developer link ?', 'artfolio_developer_link', 'theme-options', 'footer' );
    add_settings_field( 'wordpressLink', 'Show wordpress link ?', 'artfolio_wordpress_link', 'theme-options', 'footer' );

    register_setting( 'footer', 'copyright' );
    register_setting( 'footer', 'socialMenu' );
    register_setting( 'footer', 'developerLink' );
    register_setting( 'footer', 'wordpressLink' );
}
add_action( 'admin_init', 'artfolio_settings_page_setup' );


?>