<?php
/**
 * Artfolio functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Artfolio
 */


/*
* Custom widget for recent posts
*/
require get_template_directory() . '/widgets/artfolio-recent-posts.php';


/**
 * Displays the slider
 */
function artfolio_display_slider() { ?>

<div class="camera_wrap camera_grey_skin" id="camera_wrap">
    <?php
    // display slides
    for ( $i = 1; $i <= 3; ++$i ) {

        $defaultSlideTitle = __( 'Some title', 'artfolio' );
        $defaultSlideContent = __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'artfolio' );
        $defaultSlideReadMoreLink = __( '#', 'artfolio' );
        $defaultSlideImage = get_template_directory_uri().'/images/slider/' . $i .'.jpg';

        $slideTitle = get_theme_mod( 'artfolio_slide' . $i . '_title', html_entity_decode( $defaultSlideTitle ) );
        $slideContent = get_theme_mod( 'artfolio_slide' . $i . '_content', html_entity_decode( $defaultSlideContent ) );
        $slideReadMoreLink = get_theme_mod( 'artfolio_slide' . $i . '_readmorelink', html_entity_decode( $defaultSlideReadMoreLink ) );
        $slideImage = get_theme_mod( 'artfolio_slide' . $i . '_image', $defaultSlideImage );

    ?>

    <div data-thumb="<?php echo esc_attr( $slideImage ); ?>" data-src="<?php echo esc_attr( $slideImage ); ?>">
        <div class="camera_caption fadeFromBottom">
            <h2>
                <?php echo esc_attr( $slideTitle ); ?>
            </h2>
            <p>
                <?php echo esc_attr( $slideContent ); ?>
            </p>
            <a href="<?php echo esc_attr( $slideReadMoreLink ); ?>" target="_blank"><?php echo __( 'Read more', 'artfolio' ); ?></a>

        </div>
    </div>
    <?php		} ?>
</div><!-- #camera_wrap -->
<?php
}


if ( ! function_exists( 'artfolio_setup' ) ) :

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function artfolio_setup() {

    /*
    * This theme styles the visual editor to resemble the theme style.
    */
    $font_url = get_template_directory_uri() . 'inc/editor-font.css';
    add_editor_style( array( 'inc/editor-style.css', str_replace( ',', '%2C', $font_url ) ) );


    /*
    * Make theme available for translation.
    * Translations can be filed in the /languages/ directory.
    * If you're building a theme based on Artfolio, use a find and replace
    * to change 'artfolio' to the name of your theme in all the template files.
    */
    load_theme_textdomain( 'artfolio', get_template_directory() . '/languages' );


    /*
    * Add default posts and comments RSS feed links to head.
    */
    add_theme_support( 'automatic-feed-links' );


    /*
    * Let WordPress manage the document title.
    * By adding theme support, we declare that this theme does not use a
    * hard-coded <title> tag in the document head, and expect WordPress to
    * provide it for us.
    */
    add_theme_support( 'title-tag' );


    /*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
    */
    add_theme_support( 'post-thumbnails' );

    add_image_size( 'artfolio-recent-thumbnails', 220, 220, true ); // Sets Recent Posts Thumbnails
    add_image_size( 'large-thumbnails', 1280, 220, true ); // Sets Large post thumbnails for header in single post section
    add_image_size( 'small-thumbnails', 780, 300, true ); // Sets Small post thumbnails for posts in index post section


    /*
    * This theme uses wp_nav_menu() in one location.
    */
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'artfolio' ),
        'social' => __( 'Social Menu', 'artfolio'),
        'landing' => __( 'Landing Menu', 'artfolio' ),
    ) );


    /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );


    add_theme_support( 'custom-background', array(
        'default-color'          => '',
        'default-image'          => '',
        'wp-head-callback'       => '_custom_background_cb',
        'admin-head-callback'    => '',
        'admin-preview-callback' => ''
    ) );


    /*
    * Enable support for Post Formats.
    * See https://developer.wordpress.org/themes/functionality/post-formats/
    */
    add_theme_support( 'post-formats', array( 'aside' ) );


    /*
    * Enable support for Custom logo.
    * See http://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Logo
    */
    add_theme_support( 'custom-logo', array(
        'height'      => 130,
        'width'       => 130,
        'flex-width' => false,
    ) );
}
endif;

add_action( 'after_setup_theme', 'artfolio_setup' );


/*
* Set the content width in pixels, based on the theme's design and stylesheet.
*
* Priority 0 to make it available to lower priority callbacks.
*
* @global int $content_width
*/
function artfolio_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'artfolio_content_width', 700 );
}
add_action( 'after_setup_theme', 'artfolio_content_width', 0 );


/*
* Register widget area.
*
* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*/
function artfolio_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'artfolio' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'artfolio' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Widgets', 'artfolio' ),
        'description'   => __( 'Footer widgets area appears in the footer of the site.', 'artfolio' ),
        'id'            => 'sidebar-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Index page Widgets', 'artfolio' ),
        'description'   => __( 'Index page widgets area appears in the index page of the site. Only for Artfolio Recent Posts widget.', 'artfolio' ),
        'id'            => 'sidebar-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );
}
add_action( 'widgets_init', 'artfolio_widgets_init' );


/**
* Enqueue scripts and styles.
*/
function artfolio_scripts() {
    wp_enqueue_style( 'artfolio-style', get_stylesheet_uri() );

    if ( is_page_template( 'template-pages/page-nosidebar.php' ) ) {
        wp_enqueue_style( 'artfolio-layout-style' , get_template_directory_uri() . '/layouts/nosidebar.css' );
    } else {
        wp_enqueue_style( 'artfolio-layout-style' , get_template_directory_uri() . '/layouts/content-sidebar.css' );
    }

    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Merriweather:400,300,400italic,700,900,900italic|Open+Sans:400,400italic,700,700italic' );

    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.css' );

    wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '20160503', true );

    wp_enqueue_script( 'superfish-configuration', get_template_directory_uri() . '/js/superfish-configuration.js', array( 'superfish' ), '20160601', true );

    wp_enqueue_script( 'hide-search-panel', get_template_directory_uri() . '/js/hide-search-panel.js', array( 'jquery' ), '20160601', true );

    wp_enqueue_script( 'artfolio-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

    wp_enqueue_script( 'artfolio-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    wp_enqueue_script( 'masonry', get_template_directory_uri() . '/js/masonry-configuration.js', array( 'masonry' ), '20160601', true );

    /* Slider scripts */
    wp_enqueue_script( 'camera', get_template_directory_uri() . '/js/camera.js' );

    wp_enqueue_script( 'camera-configuration', get_template_directory_uri() . '/js/camera-configuration.js' );

    wp_enqueue_script( 'jquery-mobile-customized', get_template_directory_uri() . '/js/jquery.mobile.customized.js', array( 'jquery' ) );

    wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ) );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'artfolio_scripts' );




/*
* Implement the Custom Header feature.
*/
require get_template_directory() . '/inc/custom-header.php';


/*
* Custom template tags for this theme.
*/
require get_template_directory() . '/inc/template-tags.php';


/*
* Custom functions that act independently of the theme templates.
*/
require get_template_directory() . '/inc/extras.php';


/*
* Customizer additions.
*/
require get_template_directory() . '/inc/customizer.php';


/**
* Load Jetpack compatibility file.
*/
require get_template_directory() . '/inc/jetpack.php';
