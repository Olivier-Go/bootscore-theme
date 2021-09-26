<?php
/**
 * Bootscore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bootscore
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


// Bootscore includes directory.
$bootscore_inc_dir = 'inc';

// Array of files to include.
$bootscore_includes = array(
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
    '/shortcodes.php',                      // Register shortcodes area.
	'/scripts.php',                         // Enqueue scripts and styles.
    '/theme-settings.php',                  // Theme's default settings.
);

// Include files.
foreach ( $bootscore_includes as $file ) {
	require_once get_theme_file_path( $bootscore_inc_dir . $file );
}

