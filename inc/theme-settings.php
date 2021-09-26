<?php
/**
 * Theme's default settings
 *
 * @package Bootscore
 */

 
 // Add <link rel=preload> to Fontawesome
add_filter('style_loader_tag', 'wpse_231597_style_loader_tag');

function wpse_231597_style_loader_tag($tag){

    $tag = preg_replace("/id='font-awesome-css'/", "id='font-awesome-css' online=\"if(media!='all')media='all'\"", $tag);

    return $tag;
}
// Add <link rel=preload> to Fontawesome END


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


// Amount of posts/products in category
if ( ! function_exists( 'wpsites_query' ) ) :

    function wpsites_query( $query ) {
    if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
            $query->set( 'posts_per_page', 24 );
        }
    }
    add_action( 'pre_get_posts', 'wpsites_query' );

endif;
// Amount of posts/products in category END


// Pagination Categories
if ( ! function_exists( 'bootscore_pagination' ) ) :

    function bootscore_pagination($pages = '', $range = 2) 
    {  
        $showitems = ($range * 2) + 1;  
        global $paged;
        if($pages == '')
        {
            global $wp_query; 
            $pages = $wp_query->max_num_pages;

            if(!$pages)
                $pages = 1;		 
        }   

        if(1 != $pages)
        {
            echo '<nav aria-label="Page navigation" role="navigation">';
            echo '<span class="sr-only">Page navigation</span>';
            echo '<ul class="pagination justify-content-center ft-wpbs mb-4">';


            if($paged > 2 && $paged > $range+1 && $showitems < $pages) 
                echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link(1).'" aria-label="First Page">&laquo;</a></li>';

            if($paged > 1 && $showitems < $pages) 
                echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($paged - 1).'" aria-label="Previous Page">&lsaquo;</a></li>';

            for ($i=1; $i <= $pages; $i++)
            {
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                    echo ($paged == $i)? '<li class="page-item active"><span class="page-link"><span class="sr-only">Current Page </span>'.$i.'</span></li>' : '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($i).'"><span class="sr-only">Page </span>'.$i.'</a></li>';
            }

            if ($paged < $pages && $showitems < $pages) 
                echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link(($paged === 0 ? 1 : $paged) + 1).'" aria-label="Next Page">&rsaquo;</a></li>';  

            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
                echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($pages).'" aria-label="Last Page">&raquo;</a></li>';

            echo '</ul>';
            echo '</nav>';
            // Uncomment this if you want to show [Page 2 of 30]
            // echo '<div class="pagination-info mb-5 text-center">[ <span class="text-muted">Page</span> '.$paged.' <span class="text-muted">of</span> '.$pages.' ]</div>';	 	
        }
    }

endif;
//Pagination Categories END


// Pagination Buttons Single Posts
add_filter('next_post_link', 'post_link_attributes');
add_filter('previous_post_link', 'post_link_attributes');

function post_link_attributes($output) {
    $code = 'class="page-link"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}
// Pagination Buttons Single Posts END


// Excerpt to pages
add_post_type_support( 'page', 'excerpt' );
// Excerpt to pages END


// Breadcrumb
if ( ! function_exists( 'the_breadcrumb' ) ) :
    function the_breadcrumb() {
        if(!is_home()) {
            echo '<nav class="breadcrumb mb-4 mt-2 bg-light py-2 px-3 small rounded">';
            echo '<a href="'.home_url('/').'">'.('<i class="fas fa-home"></i>').'</a><span class="divider">&nbsp;/&nbsp;</span>';
            if (is_category() || is_single()) {
                the_category(' <span class="divider">&nbsp;/&nbsp;</span> ');
                if (is_single()) {
                    echo ' <span class="divider">&nbsp;/&nbsp;</span> ';
                    the_title();
                }
            } elseif (is_page()) {
                echo the_title();
            }
            echo '</nav>';
        }
    }
    add_filter( 'breadcrumbs', 'breadcrumbs' );
endif;
// Breadcrumb END


// Comment Button
function bootscore_comment_form( $args ) {
    $args['class_submit'] = 'btn btn-outline-primary'; // since WP 4.1    
    return $args;    
}
add_filter( 'comment_form_defaults', 'bootscore_comment_form' );
// Comment Button END


// Password protected form
function bootscore_pw_form () {
	$output = '
		  <form action="'.get_option('siteurl').'/wp-login.php?action=postpass" method="post" class="form-inline">'."\n"
		.'<input name="post_password" type="password" size="" class="form-control me-2 my-1" placeholder="' . __('Password', 'bootscore') . '"/>'."\n"
		.'<input type="submit" class="btn btn-outline-primary my-1" name="Submit" value="' . __('Submit', 'bootscore') . '" />'."\n"
		.'</p>'."\n"
		.'</form>'."\n";
	return $output;
}
add_filter("the_password_form","bootscore_pw_form");
// Password protected form END


// Allow HTML in term (category, tag) descriptions
foreach ( array( 'pre_term_description' ) as $filter ) {
	remove_filter( $filter, 'wp_filter_kses' );
	if ( ! current_user_can( 'unfiltered_html' ) ) {
		add_filter( $filter, 'wp_filter_post_kses' );
	}
}
 
foreach ( array( 'term_description' ) as $filter ) {
	remove_filter( $filter, 'wp_kses_data' );
}
// Allow HTML in term (category, tag) descriptions END


// Allow HTML in author bio
remove_filter('pre_user_description', 'wp_filter_kses');
add_filter( 'pre_user_description', 'wp_filter_post_kses');
// Allow HTML in author bio END


// Hook after #primary
function bs_after_primary() {
    do_action('bs_after_primary');
} 
// Hook after #primary END


// Open links in comments in new tab
if ( ! function_exists( 'bs_comment_links_in_new_tab' ) ) :
    function bs_comment_links_in_new_tab($text) 
    {
        return str_replace('<a', '<a target="_blank" rel=”nofollow”', $text);
    }
    add_filter('comment_text', 'bs_comment_links_in_new_tab');
endif;
// Open links in comments in new tab END


// Disable Gutenberg blocks in widgets (WordPress 5.8)
// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );
// Disable Gutenberg blocks in widgets (WordPress 5.8) END