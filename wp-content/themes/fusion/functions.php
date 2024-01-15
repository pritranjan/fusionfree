<?php

/**
 * climavent functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package climavent
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.1');
}

define('DISALLOW_FILE_EDIT', 1);

if (!defined('MK_ASSETS_DIR_URL')) {
	// Theme Assets
	define("MK_ASSETS_DIR_URL", get_template_directory_uri() . '/assets/');
}


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function climavent_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on climavent, use a find and replace
		* to change 'climavent' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('climavent', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'climavent'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'climavent_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'climavent_setup');

if (!function_exists('mk_get_theme_logo_url')) {
	/**
	 * mk_get_theme_logo_url
	 * Return theme logo url 
	 */
	function mk_get_theme_logo_url()
	{
		$custom_logo_id = get_theme_mod('custom_logo');
		$image = wp_get_attachment_image_src($custom_logo_id, 'full');
		return @$image[0];
	}
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function climavent_content_width()
{
	$GLOBALS['content_width'] = apply_filters('climavent_content_width', 640);
}
add_action('after_setup_theme', 'climavent_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function climavent_widgets_init()
{
	register_sidebar(array(
		'name'          => 'Footer Column 1',
		'id'            => 'footer_column_1',
		'before_widget' => '<div class="footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	));

	register_sidebar(array(
		'name'          => 'Footer Column 2',
		'id'            => 'footer_column_2',
		'before_widget' => '<div class="footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	));

	register_sidebar(array(
		'name'          => 'Footer Column 3',
		'id'            => 'footer_column_3',
		'before_widget' => '<div class="footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	));
}
add_action('widgets_init', 'climavent_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function climavent_scripts()
{
	// Load swiper slider
	wp_enqueue_style('climavent-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), _S_VERSION);
	wp_enqueue_script('climavent-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), _S_VERSION, true);


	// Add support for default style css
	wp_enqueue_style('climavent-theme-style', MK_ASSETS_DIR_URL . 'css/style.css', array(), _S_VERSION);
	wp_enqueue_style('climavent-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_style('climavent-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), _S_VERSION);
	wp_style_add_data('climavent-style', 'rtl', 'replace');

	// Load theme scripts
	wp_enqueue_script('climavent-popper.min', MK_ASSETS_DIR_URL . 'js/popper.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('climavent-jquery.min', MK_ASSETS_DIR_URL . 'js/jquery.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('climavent-bootstrap.min', MK_ASSETS_DIR_URL . 'js/bootstrap.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('climavent-theme-script', MK_ASSETS_DIR_URL . 'js/script.js', array(), _S_VERSION, true);



	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'climavent_scripts');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
// require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/supports/acf.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	// require get_template_directory() . '/inc/jetpack.php';
}

if (!function_exists('mk_get_posts')) {
	/**
	 * mk_get_posts
	 * Get posts from system 
	 */
	function mk_get_posts($formData = array())
	{
		$args = array();
		$args['post_type'] = 'post'; // default post type 
		$args['post_status'] = 'publish'; // default post status
		$args['posts_per_page'] = 9; // posts per page

		// post_type
		if (isset($formData['post_type']) && $formData['post_type'] != "") {
			$args['post_type']  = $formData['post_type'];
		}

		// posts_per_page
		if (isset($formData['posts_per_page']) && $formData['posts_per_page'] != "") {
			$args['posts_per_page']  = $formData['posts_per_page'];
		}
		// tax_query
		if (isset($formData['tax_query']) && !empty($formData['tax_query'])) {
			$args['tax_query']  = $formData['tax_query'];
		}

		// orderby
		if (isset($formData['orderby']) && $formData['orderby'] != "") {
			$args['orderby']  = $formData['orderby'];
		}
		// meta_type
		if (isset($formData['meta_type']) && $formData['meta_type'] != "") {
			$args['meta_type']  = $formData['meta_type'];
		}
		// order
		if (isset($formData['order']) && $formData['order'] != "") {
			$args['order']  = $formData['order'];
		}
		if (isset($formData['orderby']) && $formData['orderby'] != "") {
			$args['orderby']  = $formData['orderby'];
		}
		// meta_key
		if (isset($formData['meta_key']) && $formData['meta_key'] != "") {
			$args['meta_key']  = $formData['meta_key'];
		}

		// TODO: add pagination here also 

		$posts = new WP_Query($args);
		if ($posts->have_posts()) {
			return $posts;
		} else {
			return array();
		}
	}
}

function mk_developer_site_url()
{
	return "https://webwila.com/";
}


if (!function_exists('mk_get_social_media_links_html')) {
	/**
	 * mk_get_social_media_links_html
	 * Return social media links html 
	 */
	function mk_get_social_media_links_html($formData = [])
	{
		$links = array();
		$links['post_type'] = 'social_media';
		$links['posts_per_page'] = 12;
		$links['meta_key'] = 'sorting';
		$links['meta_type'] = 'NUMERIC';
		$links['orderby'] = 'meta_value_num';
		$links['order'] = 'ASC';
		$links = mk_get_posts($links);
		if (empty($links)) {
			return;
		}
		ob_start();
?>
		<div class="social-link">
			<?php
			if (isset($formData['with_heading']) && $formData['with_heading']) {
				echo "<h6>" . __('Follow Us:') . "</h6>";
			}
			?>
			<ul class="social-profile list-style style1">
				<?php
				while ($links->have_posts()) {
					$links->the_post();
				?>
					<li>
						<a target="_blank" href="<?php echo get_field('redirect', get_the_ID()); ?>">
							<i class="<?php echo get_field('icon_class', get_the_ID()); ?>"></i>
						</a>
					</li>
				<?php
				}
				wp_reset_postdata();
				?>

			</ul>
		</div>
<?php
		return ob_get_clean();
	}
}


if (!function_exists('climavent_template_redirect')) {
	/**
	 * climavent_template_redirect
	 * Restrict pages on redirect 
	 */
	function climavent_template_redirect()
	{
		if (is_404()) {
			wp_redirect(home_url());
			exit;
		}
	}
}
add_action('template_redirect', 'climavent_template_redirect');


if (!function_exists('climavent_disable_plugin_updates')) {
	/**
	 * climavent_disable_plugin_updates
	 * Disable plugin updates
	 */
	function climavent_disable_plugin_updates($value)
	{
		if (isset($value->response['advanced-custom-fields-pro/acf.php'])) {
			unset($value->response['advanced-custom-fields-pro/acf.php']);
		}
		return $value;
	}
}

add_filter('site_transient_update_plugins', 'climavent_disable_plugin_updates');
