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

function pulse_register_sidebars(){
    register_sidebar(array(
        'name' => __('Home Page Newsletter Widget', 'pulse'),
        'id' => 'home_page_newsletter_widget',
        'description'   => __('Add widgets for the newsletter section on homepage', 'pulse'),
        'before_widget' => '<div class="newsletter-widget">',
        'after_widget'  => '</div>',
    ));
}

add_action("wp_enqueue_scripts", "pulse_enqueue_scripts");
add_action("after_setup_theme", "pulse_setup_theme");

add_action('widgets_init', 'pulse_register_sidebars');



function pulse_customize_register($wp_customize) {
    
    // Newsletter Section
    $wp_customize->add_section('pulse_newsletter_section', array(
        'title'    => __('Newsletter Section', 'pulse'),
        'priority' => 20,
    ));
    
    // Enable/Disable Newsletter Section
    $wp_customize->add_setting('pulse_newsletter_enable', array(
        'default'           => true,
        'sanitize_callback' => 'pulse_sanitize_checkbox',
    ));
    
    $wp_customize->add_control('pulse_newsletter_enable', array(
        'label'   => __('Enable Newsletter Section', 'pulse'),
        'section' => 'pulse_newsletter_section',
        'type'    => 'checkbox',
    ));
    
    // Newsletter Title
    $wp_customize->add_setting('pulse_newsletter_title', array(
        'default'           => __('Subscribe to our Newsletter', 'pulse'),
        'sanitize_callback' => 'sanitize_text_field',
        'active_callback' => 'pulse_is_newsletter_enabled',
    ));
    
    $wp_customize->add_control('pulse_newsletter_title', array(
        'label'           => __('Newsletter Title', 'pulse'),
        'section'         => 'pulse_newsletter_section',
        'type'            => 'text',
        'active_callback' => 'pulse_is_newsletter_enabled',
    ));
    
    // Newsletter Description
    $wp_customize->add_setting('pulse_newsletter_description', array(
        'default'           => __('Stay updated with our latest posts and news.', 'pulse'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('pulse_newsletter_description', array(
        'label'           => __('Newsletter Description', 'pulse'),
        'section'         => 'pulse_newsletter_section',
        'type'            => 'textarea',
        'active_callback' => 'pulse_is_newsletter_enabled',
    ));
    
    // Newsletter Form Shortcode
    $wp_customize->add_setting('pulse_newsletter_form_shortcode', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('pulse_newsletter_form_shortcode', array(
        'label'           => __('Newsletter Form Shortcode', 'pulse'),
        'section'         => 'pulse_newsletter_section',
        'type'            => 'text',
        'description'     => __('Enter your newsletter form shortcode (e.g., [contact-form-7 id="123"])', 'pulse'),
        'active_callback' => 'pulse_is_newsletter_enabled',
    ));
    
    // Background Color
    $wp_customize->add_setting('pulse_newsletter_bg_color', array(
        'default'           => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pulse_newsletter_bg_color', array(
        'label'           => __('Background Color', 'pulse'),
        'section'         => 'pulse_newsletter_section',
        'active_callback' => 'pulse_is_newsletter_enabled',
    )));
    
    // Text Color
    $wp_customize->add_setting('pulse_newsletter_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pulse_newsletter_text_color', array(
        'label'           => __('Text Color', 'pulse'),
        'section'         => 'pulse_newsletter_section',
        'active_callback' => 'pulse_is_newsletter_enabled',
    )));
}
add_action('customize_register', 'pulse_customize_register');

// Sanitization functions
function pulse_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

// Active callback
function pulse_is_newsletter_enabled() {
    return get_theme_mod('pulse_newsletter_enable', true);
}

// Add custom CSS for newsletter colors
function pulse_newsletter_custom_css() {
    if (!get_theme_mod('pulse_newsletter_enable', true)) {
        return;
    }
    
    $bg_color = get_theme_mod('pulse_newsletter_bg_color', '#000000');
    $text_color = get_theme_mod('pulse_newsletter_text_color', '#ffffff');
    
    ?>
    <style type="text/css">
        .pulse-newsletter-section {
            background-color: <?php echo esc_attr($bg_color); ?> !important;
            color: <?php echo esc_attr($text_color); ?> !important;
        }
        .pulse-newsletter-section h2,
        .pulse-newsletter-section p {
            color: <?php echo esc_attr($text_color); ?> !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'pulse_newsletter_custom_css');


function pulse_header_customize($wp_header_customize) {
    // add a section for the customization
    $wp_header_customize->add_section('pulse_header_section', array (
        'title' => __('Header Customization', 'pulse'),
        'id' => 'pulse_header_section',
        'priority' => 30,

    ));

    $wp_header_customize->add_setting('pulse_header_title', array (
        'default' => __('Discover, Connect, Share', 'pulse'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_header_customize->add_control('pulse_header_title', array (
        'type' => 'text',
        'section' => 'pulse_header_section',
        'label' => __('Header Title', 'pulse'),
        
    ));

}


add_action("customize_register", "pulse_header_customize");


?>