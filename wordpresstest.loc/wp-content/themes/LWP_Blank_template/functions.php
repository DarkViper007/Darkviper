<?php
/*
 *  Author: Lenlay
 */

define('THEME_OPT', 'lwp', true);

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail

    // Localisation Support
    // load_theme_textdomain(THEME_OPT, get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/


// Load scripts
function lwp_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('themescripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0.0', true); // Custom scripts
        wp_enqueue_script('themescripts');
    }
}

// Load styles
function lwp_styles() {

    wp_register_style('themestyle', get_template_directory_uri() . '/assets/css/style.min.css', array(), filemtime(get_template_directory() . '/assets/css/style.min.css'), 'all');
    wp_enqueue_style('themestyle');
}

// HTML5 Blank navigation
function lwp_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => 'Main',
		'container'       => 'div',
		'container_class' => 'menu',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Register Navigation
function register_lwp_menu()
{
    register_nav_menus(array(
        'header-menu' => __('Header Menu', THEME_OPT),
        'footer-menu' => __('Footer Menu', THEME_OPT),
    ));
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'teatrhotel'),
        'description' => __('Description for this widget-area...', THEME_OPT),
        'id' => 'widget-area-1',
        'before_widget' => '<ul class="off-canvas-list">',
        'after_widget' => '</ul>',
        'before_title' => '<li><label><h3>',
        'after_title' => '</h3></label></li>'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function lwp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function lwp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function lwp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function lwp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function lwpcomments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    $add_below = 'comment';
?>
    <li <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php  comment_ID() ?>">
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
        <div class="comment-author vcard">
            <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['180']); ?>
            <?php printf(__('<cite class="fn">%s</cite>') , get_comment_author_link()) ?>
        </div>
        <?php if ($comment->comment_approved == '0'): ?>
            <em class="comment-awaiting-moderation"><?php
                _e('Your comment is awaiting moderation.') ?></em>
        <?php endif; ?>

        <div class="comment-meta commentmetadata"><a href="<?php
            echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>">
            <?php printf(__('%1$s at %2$s') , get_comment_date() , get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)') , '  ', ''); ?>
        </div>
        <div class="comment-text">
        <?php comment_text() ?>
        </div>
        <div class="reply">
            <?php comment_reply_link(array_merge($args, array(
                'add_below' => $add_below,
                'depth' => $depth,
                'max_depth' => $args['max_depth']
            ))); ?>
        </div>
    </div>
    </li>
<?php
}

/*------------------------------------*\
	Actions + Filters
\*------------------------------------*/

// Add Actions
add_action('wp_enqueue_scripts', 'lwp_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'lwp_styles'); // Add Theme Stylesheet
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('init', 'register_lwp_menu'); // Add HTML5 Blank Menu
add_action('init', 'lwp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

include_once 'inc/loader.php';

?>
