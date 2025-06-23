<?php 

load_theme_textdomain('pulse', get_template_directory() . '/languages');
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('custom-logo', array(
    'height'      => 100,
    'width'       => 100,
    'flex-height' => true,
    'flex-width'  => true,
));


function pulse_setup_theme () {
    // register navigation menus
    register_nav_menu(
        'primary',
        __('Primary Menu', 'pulse')
    );
    register_nav_menu(
        'footer',
        __('Footer Menu', 'pulse')
    );
    // add support for HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}

function pulse_enqueue_scripts() {
    // enqueue styles
    wp_enqueue_style('pulse-style', get_stylesheet_uri(),"",null,"all");
    // enqueue scripts
    wp_enqueue_script("tailwind", "//cdn.tailwindcss.com", array(), null, false);

}   


add_action("wp_enqueue_scripts", "pulse_enqueue_scripts");
add_action("after_setup_theme", "pulse_setup_theme");

?>