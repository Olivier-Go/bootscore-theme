<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * 
 * @package Bootscore
 */

if ( ! function_exists( 'bootscore_widgets_init' ) ) :

    function bootscore_widgets_init() {
        
        // Top Nav
        register_sidebar(array(
            'name' => esc_html__('Top Nav', 'bootscore' ),
            'id' => 'top-nav',
            'description' => esc_html__('Add widgets here.', 'bootscore' ),
            'before_widget' => '<div class="ms-3">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title d-none">',
            'after_title' => '</div>'
        ));
        // Top Nav End

        // Top Nav Search
        register_sidebar(array(
            'name' => esc_html__('Top Nav Search', 'bootscore' ),
            'id' => 'top-nav-search',
            'description' => esc_html__('Add widgets here.', 'bootscore' ),
            'before_widget' => '<div class="top-nav-search">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title d-none">',
            'after_title' => '</div>'
        ));
        // Top Nav Search End

        // Sidebar
        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar', 'bootscore' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'bootscore' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s card card-body mb-4 bg-light border-0">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title card-title border-bottom py-2">',
            'after_title'   => '</h2>',
        ) );
        // Sidebar End

        // Top Footer
        register_sidebar(array(
            'name' => esc_html__('Top Footer', 'bootscore' ),
            'id' => 'top-footer',
            'description' => esc_html__('Add widgets here.', 'bootscore' ),
            'before_widget' => '<div class="footer_widget mb-5">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>'
        ));
        // Top Footer End

        // Footer 1
        register_sidebar(array(
            'name' => esc_html__('Footer 1', 'bootscore' ),
            'id' => 'footer-1',
            'description' => esc_html__('Add widgets here.', 'bootscore' ),
            'before_widget' => '<div class="footer_widget mb-4">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title h4">',
            'after_title' => '</h2>'
        ));
        // Footer 1 End

        // Footer 2
        register_sidebar(array(
            'name' => esc_html__('Footer 2', 'bootscore' ),
            'id' => 'footer-2',
            'description' => esc_html__('Add widgets here.', 'bootscore'),
            'before_widget' => '<div class="footer_widget mb-4">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title h4">',
            'after_title' => '</h2>'
        ));
        // Footer 2 End

        // Footer 3
        register_sidebar(array(
            'name' => esc_html__('Footer 3', 'bootscore' ),
            'id' => 'footer-3',
            'description' => esc_html__('Add widgets here.', 'bootscore'),
            'before_widget' => '<div class="footer_widget mb-4">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title h4">',
            'after_title' => '</h2>'
        ));
        // Footer 3 End

        // Footer 4
        register_sidebar(array(
            'name' => esc_html__('Footer 4', 'bootscore' ),
            'id' => 'footer-4',
            'description' => esc_html__('Add widgets here.', 'bootscore'),
            'before_widget' => '<div class="footer_widget mb-4">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title h4">',
            'after_title' => '</h2>'
        ));
        // Footer 4 End

        // 404 Page
        register_sidebar(array(
            'name' => esc_html__('404 Page', 'bootscore' ),
            'id' => '404-page',
            'description' => esc_html__('Add widgets here.', 'bootscore'),
            'before_widget' => '<div class="mb-4">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>'
        ));
        // 404 Page End

    }
    add_action( 'widgets_init', 'bootscore_widgets_init' );


endif;