<?php
/**
 * iamtapps theme specific functions
 *
 * @package iamtapps
 */

function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More&nbsp;&raquo;', 'iamtapps') . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

/**
 * function for conditional tag: is_tree()
 */


function is_tree($pid) {      // $pid = The ID of the page we're looking for pages underneath
	global $post;         // load details about this page
	$anc = get_post_ancestors( $post->ID );
	foreach($anc as $ancestor) {
		if(is_page() && $ancestor == $pid) {
			return true;
		}
	}
	if(is_page()&&(is_page($pid))) 
               return true;   // we're at the page or at a sub page
	else 
               return false;  // we're elsewhere
};


/**
 * custom post types
 **/

require_once 'CPT_Core.php';

//register portfolio CPT
class Portfolio_CPT extends CPT_Core {

	/**
	 * Register Custom Post Types. See documentation in CPT_Core, and in wp-includes/post.php
	 */
	public function __construct() {

		// Register this cpt
		// First parameter should be an array with Singular, Plural, and Registered name
		parent::__construct(
			array( __( 'Example', 'iamtapps' ), __( 'Examples', 'iamtapps' ), 'portfolio' ),
			array( 'supports' => array( 'title', 'editor', 'thumbnail' ), 'menu_icon' => 'dashicons-portfolio', 'taxonomies' => array('category',), )
		);

	}

	/**
	 * Registers admin columns to display. Hooked in via CPT_Core.
	 * @since  0.1.0
	 * @param  array  $columns Array of registered column names/labels
	 * @return array           Modified array
	 */
	public function columns( $columns ) {
		$new_column = array(
			'thumbnail' => sprintf( __( '%s thumbnail', 'iamtapps' ), $this->post_type( 'singular' ) ),
		);
		return array_merge( $new_column, $columns );
	}

	/**
	 * Handles admin column display. Hooked in via CPT_Core.
	 * @since  0.1.0
	 * @param  array  $column Array of registered column names
	 */
	public function columns_display( $column ) {
		switch ( $column ) {
			case 'thumbnail':
				the_post_thumbnail( array( 200, 100 ) );
				break;
		}
	}

}
new Portfolio_CPT();

/**
 * custom taxonomy boxes - category
 */

require_once("Tax-meta-class/Tax-meta-class.php");
if ( is_admin() ){
	$prefix = 'tm_';
	$svglocation = get_template_directory_uri() . '/images/iconic/svg/smart/';
	$config = array(
		'id' 		=> 'category_meta_box',	// metabox id
		'title' 	=> 'Category Settings',	// metabox title
		'pages' 	=> array('category'),	// taxonomy name, accept categories, post_tag and custom taxonomies
		'context' 	=> 'normal',			// where the meta box appear: normal (default), advanced, side; optional
		'fields' 	=> array(),				// list of meta fields (can be added by field arrays)
		'local_images' => false,			// Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => true			//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);
	$cat_meta =  new Tax_Meta_Class($config);

	$cat_meta	->	addRadio(
		$prefix . 'category-icon',
		array(
			'noicon'		=>	' ',
			'aperture'		=>	'<img src="' . $svglocation . 'aperture.svg" />',
			'beaker'		=>	'<img src="' . $svglocation . 'beaker.svg" />',
			'book'			=>	'<img src="' . $svglocation . 'book.svg" />',
			'brush'			=>	'<img src="' . $svglocation . 'brush.svg" />',
			'camera-slr'	=>	'<img src="' . $svglocation . 'camera-slr.svg" />',
			'chat'			=>	'<img src="' . $svglocation . 'chat.svg" />',
			'code'			=>	'<img src="' . $svglocation . 'code.svg" />',
			'compass'		=>	'<img src="' . $svglocation . 'compass.svg" />',
			'electric'		=>	'<img src="' . $svglocation . 'electric.svg" />',
			'fire'			=>	'<img src="' . $svglocation . 'fire.svg" />',
			'flag'			=>	'<img src="' . $svglocation . 'flag.svg" />',
			'fork'			=>	'<img src="' . $svglocation . 'fork.svg" />',
			'globe'			=>	'<img src="' . $svglocation . 'globe.svg" />',
			'image'			=>	'<img src="' . $svglocation . 'image.svg" />',
			'laptop'		=>	'<img src="' . $svglocation . 'laptop.svg" />',
			'lightbulb'		=>	'<img src="' . $svglocation . 'lightbulb.svg" />',
			'pencil'		=>	'<img src="' . $svglocation . 'pencil.svg" />',
			'puzzle-piece'	=>	'<img src="' . $svglocation . 'puzzle-piece.svg" />',
			'project'		=>	'<img src="' . $svglocation . 'project.svg" />',
			'video'			=>	'<img src="' . $svglocation . 'video.svg" />',
			'pin'			=>	'<img src="' . $svglocation . 'pin.svg" />',
		),
		array(
			'name'	=> __( 'Category icon', 'iamtapps' ),
			'std'=> array('noicon')
		)
	);
	$cat_meta->Finish();
}

/**
 * just tweaking some styles in the admin area for those category icons above
 */

add_action('admin_head', 'additional_admin_styles');

function additional_admin_styles() {
	echo '<style>
		.taxonomy-category .form-field input.at-radio {width: 16px; display: block; float: left; margin: 35px 150px 68px 5px;}
		.taxonomy-category .form-field span.at-radio-label {width: 100px; display: block; float: left; margin-left: -140px;}
		.taxonomy-category .form-field span.at-radio-label img {width: 94%;}
	</style>';
}

/**
 * custom excerpt length. usage example: echo excerpt(25);
 **/
 
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'... ';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'... ';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/[.+]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

function hybridexcerpt($limit) {
  $hybridexcerpt = explode(' ', get_the_content(), $limit);
  if (count($hybridexcerpt)>=$limit) {
    array_pop($hybridexcerpt);
    $hybridexcerpt = implode(" ",$hybridexcerpt).' <a class="readmore" href="<?php echo get_permalink(); ?>">Continue reading&nbsp;&raquo;</a>';
  } else {
    $hybridexcerpt = implode(" ",$hybridexcerpt);
  }
  $hybridexcerpt = preg_replace('/[.+]/','', $hybridexcerpt);
  $hybridexcerpt = apply_filters('the_content', $hybridexcerpt);
  $hybridexcerpt = strip_tags($hybridexcerpt, '<p><a><b><br /><li><ol><ul>');
  return $hybridexcerpt;
}
 
 /**
 * Register widgetized area, multiple sidebars & default widgets
 */

function iamtapps_widgets_init() {
    register_sidebar(array('name' => 'Homepage', 'before_widget' => '<aside id="%1$s" class="widgetBox %2$s">', 'after_widget' => '</aside>', 'before_title' => '<h3 class="widgetTitle">', 'after_title' => '</h3>'));
    register_sidebar(array('name' => 'Sidebar: default (all pages)', 'before_widget' => '<aside id="%1$s" class="widgetBox %2$s">', 'after_widget' => '</aside>', 'before_title' => '<h3 class="widgetTitle">', 'after_title' => '</h3>'));
    register_sidebar(array('name' => 'Footer: left', 'before_widget' => '<aside id="%1$s" class="widgetBox %2$s">', 'after_widget' => '</aside>', 'before_title' => '<h6 class="widgetTitle">', 'after_title' => '</h6>'));
    register_sidebar(array('name' => 'Footer: right', 'before_widget' => '<aside id="%1$s" class="widgetBox %2$s">', 'after_widget' => '</aside>', 'before_title' => '<h6 class="widgetTitle">', 'after_title' => '</h6>'));
}
add_action( 'widgets_init', 'iamtapps_widgets_init' );

/**
 * adding more image sizes (slideshow, headers, thumbnails, etc)
 */

if ( function_exists( 'add_image_size' ) ) { 
    add_image_size( 'section-bg-image', 1600, 950, true ); //(cropped)
    add_image_size( 'portfolio-thumbnail', 550, 550, true ); //(cropped)
    add_image_size( 'page-header', 2000, 190, true ); //(cropped)

}

/**
 * gallery inline code fix
 */

//remove inline style for gallery shortcode
add_filter( 'the_content', 'remove_br_gallery', 11, 2);
function remove_br_gallery($output) {
    return preg_replace('/<br style=(.*)>/mi','',$output);
}


/**
 * adding custom post types to category and tag query
 *
 * @param $query
 * @return mixed
 */
function add_custom_types_to_tax( $query ) {
	if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {

// Get all your post types
		$post_types = get_post_types();

		$query->set( 'post_type', $post_types );
		return $query;
	}
}
add_filter( 'pre_get_posts', 'add_custom_types_to_tax' );

/**
 * Finds the display length of the article title
 *
 * @param string $title
 * @return int
 */
function iamtapps_get_title_length( $title ) {
	$title = preg_replace( '/&(\#[1-9][0-9]{1,3}|[A-Za-z][0-9A-Za-z]+);/', ' ', $title );
	return strlen( $title );
}