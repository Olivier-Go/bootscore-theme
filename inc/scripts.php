<?php
/**
 * Enqueue scripts
 *
 * @package Bootscore
 */

function bootscore_scripts() {

    // Get modification time. Enqueue files with modification date to prevent browser from loading cached scripts and styles when file content changes.
    $modificated_themeCss = date( 'YmdHi', filemtime( get_template_directory() . '/css/theme/theme.css' ) );
    $modificated_styleCss = date( 'YmdHi', filemtime( get_template_directory() . '/css/style.css' ) );
    $modificated_bootstrapCss = date( 'YmdHi', filemtime( get_template_directory() . '/css/lib/bootstrap.min.css' ) );
    $modificated_fontawesomeCss = date( 'YmdHi', filemtime( get_template_directory() . '/css/lib/fontawesome.min.css' ) );
    $modificated_bootstrapJs = date( 'YmdHi', filemtime( get_template_directory() . '/js/lib/bootstrap.bundle.min.js' ) );
    $modificated_themeJs = date( 'YmdHi', filemtime( get_template_directory() . '/js/theme/theme.js' ) );
    $modificated_appJs = date( 'YmdHi', filemtime( get_template_directory() . '/js/app.js' ) );
    
	// Style CSS
	wp_enqueue_style( 'bootscore-style', get_template_directory_uri() . '/css/theme/theme.css', array(), $modificated_themeCss );

    // App CSS
    wp_enqueue_style( 'app-style', get_template_directory_uri() . '/css/style.css', array(), $modificated_styleCss );

	// Bootstrap	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/lib/bootstrap.min.css', array(), $modificated_bootstrapCss );
    
    // Fontawesome
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/lib/fontawesome.min.css', array(), $modificated_fontawesomeCss );

	// Bootstrap JS
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/lib/bootstrap.bundle.min.js', array(), $modificated_bootstrapJs, true );

    wp_enqueue_script( 'jquery' );
    
    // Theme JS
	wp_enqueue_script( 'bootscore-script', get_template_directory_uri() . '/js/theme/theme.js', array(), $modificated_themeJs, true );

    // App JS
	wp_enqueue_script( 'app-script', get_template_directory_uri() . '/js/app.js', array(), $modificated_appJs, true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bootscore_scripts' );