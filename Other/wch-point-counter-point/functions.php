<?php
/**
* Add custom functions here, or override the functions included
* in parent theme fox/functions.php. This child theme inherits
* all functions and styles from /wp-content/themes/fox
*/

//Enqueue parent styles
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}


/* Guest Authors */
add_filter( 'get_the_author_user_url', 'guest_author_url' ); 
add_filter( 'the_author', 'guest_author_link' ); 
add_filter( 'get_the_author_display_name', 'guest_author_name' );

function guest_author_url($url) {
  global $post;
 $guest_url_suffix = get_post_meta( $post->ID, 'author', true );
  $guest_url = $guest_url_suffix ? site_url() . '/a/?author=' .  $guest_url_suffix : null;
  if ( filter_var($guest_url, FILTER_VALIDATE_URL) ) {
    return $guest_url;
  }
  return $url;
}

function guest_author_link($name) {
  global $post;
  $guest_name = get_post_meta( $post->ID, 'author', true );
  $guest_url = $guest_name ? site_url() . '/a/?author=' . $guest_name : null;
  if ( $guest_name ) {
    return '<a href="' . esc_attr( $guest_url ) . '" title="' . esc_attr( sprintf(__("Visit %s&#8217;s website"), $guest_name) ) . '" rel="author external">' . $guest_name . '</a>';
  }
  return $name;
}

function guest_author_name( $name ) {
  global $post;
  $guest_name = get_post_meta( $post->ID, 'author', true );
  if ( $guest_name ) return $guest_name;
  return $name;
}

/* Author Pages */
add_action('pre_get_posts', 'author_archive');

//allow URL to set author for dynamic author pages
function author_archive( $query )
{
	// validate
	if( is_admin() )
	{
		return $query;
	}
    // allow the url to alter the query
    // eg: http://www.website.com/a-e/?author=will
    // eg: http://www.website.com/a-e/?author=matt
    if( $query->is_main_query() && isset($_GET['author']) )
    {
    	$query->set('meta_key', 'author');
    	$query->set('meta_value', $_GET['author']);
		$query->set( 'posts_per_page', '3' );
    }   

	// always return
	return $query;

}

/* Open Graph Tags */
function add_facebook_open_graph_tags() {
    if (is_single()) { 
    global $post;
    ?>  
    <meta name="author" content="<?php echo get_post_meta(get_the_ID(), "author", TRUE); ?>" />
    <?php }
}
add_action('wp_head', 'add_facebook_open_graph_tags',99); 


//allow custom album reviews tempate
function get_custom_cat_template($single_template) {
     global $post;
 
       if ( in_category( 'album-reviews' )) {
          $single_template = dirname( __FILE__ ) . '/single-album-reviews.php';
     }
     return $single_template;
}
 
add_filter( "single_template", "get_custom_cat_template" ) ;

//require get_template_directory() . '/author-page.php';



?>