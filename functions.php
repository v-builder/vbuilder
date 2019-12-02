<?php




/* Disable WordPress Admin Bar for all users but admins */
show_admin_bar(false);

// Supports
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery', 'chat', 'status'));
}

/* Theme Locations */
//register_nav_menus(array(
//    'main_menu' => 'Main Menu'
//));
function register_my_menus() {
    register_nav_menus(
        array(
            'main-menu' => __( 'Header Menu' ),
            'main-menu-inner' => __( 'Inner Header Menu' ),
            'extra-menu' => __( 'Extra Menu' ),
            'footer-menu' => __( 'Footer Menu' )
        )
    );
}
add_action( 'init', 'register_my_menus' );
//Add template category check
add_filter('single_template', 'check_for_category_single_template');
function check_for_category_single_template($t) {
    foreach ((array) get_the_category() as $cat) {
        if (file_exists(TEMPLATEPATH . "/single-category-{$cat->slug}.php")) {
            return TEMPLATEPATH . "/single-category-{$cat->slug}.php";
        }

        if ($cat->parent) {
            $cat = get_the_category_by_ID($cat->parent);
            if (file_exists(TEMPLATEPATH . "/single-category-{$cat->slug}.php")) {
                return TEMPLATEPATH . "/single-category-{$cat->slug}.php";
            }

        }
    }
    return $t;
}

//allow option pages
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
        'menu_title'	=> 'FT Data',
        'menu_slug' 	=> 'ft-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Header Details',
        'menu_title'	=> 'Header',
        'parent_slug'	=> 'ft-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Navbar Details',
        'menu_title'	=> 'Navbar',
        'parent_slug'	=> 'ft-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'About FT',
        'menu_title'	=> 'About',
        'parent_slug'	=> 'ft-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Services',
        'menu_title'	=> 'Services',
        'parent_slug'	=> 'ft-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Presentation',
        'menu_title'	=> 'Presentation',
        'parent_slug'	=> 'ft-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Contact',
        'menu_title'	=> 'Contact',
        'parent_slug'	=> 'ft-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Newsletter',
        'menu_title'	=> 'Newsletter',
        'parent_slug'	=> 'ft-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Footer',
        'menu_title'	=> 'Footer',
        'parent_slug'	=> 'ft-general-settings',
    ));

}





function light_force_color() {
    return '<span class="light">';
}
add_shortcode( 'light', 'light_force_color' );

function light_force_color_close() {
    return '</span>';
}
add_shortcode( 'lightc', 'light_force_color_close' );

function dark_force_color() {
    return '<span class="dark-c">';
}
add_shortcode( 'dark', 'dark_force_color' );

function dark_force_color_close() {
    return '</span>';
}
add_shortcode( 'darkc', 'dark_force_color_close' );

