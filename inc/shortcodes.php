<?php
/**
 * Register shortcode area.
 *
 * 
 * @package Bootscore
 */

// Shortcode in HTML-Widget
add_filter( 'widget_text', 'do_shortcode' );
