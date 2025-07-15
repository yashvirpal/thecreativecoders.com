<?php
/*
Plugin Name: HTML Sitemap Generator
Plugin URI: https://codenskills.com
Description: Display an HTML sitemap including pages, posts, authors, and custom post types.
Version: 1.2
Author: Yashvir Pal
Author URI: https://yashvirpal.com
License: GPL2
Text Domain: html-sitemap-generator
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class HTML_Sitemap_Generator {

    public function __construct() {
        add_shortcode('html_sitemap', [$this, 'generate_html_sitemap']); // ✅ Register Shortcode
        add_filter('plugin_row_meta', [$this, 'add_plugin_details_link'], 10, 2); // ✅ Show View Details when active
        add_filter('plugin_action_links_' . plugin_basename(__FILE__), [$this, 'add_plugin_action_links']); // ✅ Show View Details when inactive
        add_action('admin_enqueue_scripts', [$this, 'load_thickbox']); // ✅ Load Thickbox for modal
        add_action('admin_footer', [$this, 'plugin_details_popup']); // ✅ Add Popup Content
        add_action('admin_footer', [$this, 'add_thickbox_script']); // ✅ Ensure Thickbox Works
        add_action('wp_head', [$this, 'add_sitemap_styles']); // ✅ Add CSS Styles
    }

    // ✅ Load Thickbox script and styles for WordPress Admin
    public function load_thickbox($hook) {
        if ($hook === 'plugins.php') {
            wp_enqueue_script('jquery');
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');
        }
    }

    // ✅ Show "View Details" in the Plugin List with a Unique ID
    public function add_plugin_details_link($links, $file) {
        if ($file === plugin_basename(__FILE__)) {
            $unique_id = esc_attr(str_replace(['/', '.php'], '-', plugin_basename(__FILE__)));
            $links[] = '<a href="#TB_inline?width=600&height=500&inlineId=' . $unique_id . '-popup" class="thickbox view-details-link" data-popup="' . $unique_id . '-popup">View Details</a>';
        }
        return $links;
    }

    // ✅ Show "View Details" even when the plugin is inactive
    public function add_plugin_action_links($links) {
        $unique_id = esc_attr(str_replace(['/', '.php'], '-', plugin_basename(__FILE__)));
        $links[] = '<a href="#TB_inline?width=600&height=500&inlineId=' . $unique_id . '-popup" class="thickbox view-details-link" data-popup="' . $unique_id . '-popup">View Details</a>';
        return $links;
    }

    // ✅ Add content to the popup modal in the WordPress Plugins page
    public function plugin_details_popup() {
        $unique_id = esc_attr(str_replace(['/', '.php'], '-', plugin_basename(__FILE__)));
        ?>
        <div id="<?php echo $unique_id; ?>-popup" style="display:none;">
            <h2>HTML Sitemap Generator</h2>
            
            <!-- Image for the Plugin -->
            <img src="https://via.placeholder.com/600x300.png?text=HTML+Sitemap+Generator" alt="HTML Sitemap Generator" style="width:100%; height:auto; border:1px solid #ccc; padding:10px;">

            <p><strong>Version:</strong> 1.2</p>
            <p><strong>Author:</strong> <a href="https://yashvirpal.com" target="_blank">Yashvir Pal</a></p>
            <p><strong>Description:</strong> Display an HTML sitemap including pages, posts, authors, and custom post types.</p>

            <h3>📌 How to Use:</h3>
            <ol>
                <li>Go to <strong>Pages → Add New</strong>.</li>
                <li>Enter a title, e.g., **Sitemap**.</li>
                <li>Paste this shortcode in the content area: <code>[html_sitemap]</code></li>
                <li>Publish the page and view the sitemap.</li>
            </ol>

            <p>For full documentation, visit: <a href="https://codenskills.com/html-sitemap-docs" target="_blank">Documentation</a></p>
        </div>
        <?php
    }

    // ✅ Ensure Only One Popup Opens at a Time
    public function add_thickbox_script() {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(".view-details-link").on("click", function() {
                    tb_remove(); // ✅ Close any open popup before opening a new one
                    var popupId = $(this).data("popup");
                    tb_show("HTML Sitemap Generator", "#TB_inline?width=600&height=500&inlineId=" + popupId);
                });
            });
        </script>
        <?php
    }

    // ✅ Generate HTML Sitemap for Pages, Posts, Custom Posts, and Taxonomies
   public function generate_html_sitemap() {
    ob_start();

    echo '<div class="html-sitemap">';
    
    // ✅ List Pages
    echo '<h2>📄 Pages</h2><ul>';
    $pages = get_pages();
    foreach ($pages as $page) {
        echo '<li><a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a></li>';
    }
    echo '</ul>';

    // ✅ List Posts
    echo '<h2>📝 Blog Posts</h2><ul>';
    $posts = get_posts(['post_type' => 'post', 'numberposts' => -1]);
    foreach ($posts as $post) {
        echo '<li><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></li>';
    }
    echo '</ul>';

    // ✅ List Custom Post Types
    $custom_post_types = get_post_types(['public' => true, '_builtin' => false], 'objects');
    foreach ($custom_post_types as $post_type) {
        echo '<h2>📦 ' . $post_type->label . '</h2><ul>';
        $custom_posts = get_posts(['post_type' => $post_type->name, 'numberposts' => -1]);
        foreach ($custom_posts as $custom_post) {
            echo '<li><a href="' . get_permalink($custom_post->ID) . '">' . $custom_post->post_title . '</a></li>';
        }
        echo '</ul>';
    }

    // ✅ List Taxonomies (Categories, Tags, and Custom Taxonomies)
    $taxonomies = get_taxonomies(['public' => true], 'objects');
    foreach ($taxonomies as $taxonomy) {
        echo '<h2>📂 ' . $taxonomy->label . '</h2><ul>';
        $terms = get_terms(['taxonomy' => $taxonomy->name, 'hide_empty' => true]);
        foreach ($terms as $term) {
            echo '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
        }
        echo '</ul>';
    }

    // ✅ List Authors and Their Posts
    echo '<h2>👤 Author Archives</h2><ul>';
    $authors = get_users(['who' => 'authors']);
    foreach ($authors as $author) {
        echo '<li><a href="' . get_author_posts_url($author->ID) . '">' . esc_html($author->display_name) . '</a></li>';
    }
    echo '</ul>';

    // ✅ List Monthly Archives
    echo '<h2>📅 Archives by Month</h2><ul>';
    global $wpdb;
    $archives = $wpdb->get_results("SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");
    foreach ($archives as $archive) {
        $archive_link = get_month_link($archive->year, $archive->month);
        $month_name = date("F", mktime(0, 0, 0, $archive->month, 1));
        echo '<li><a href="' . esc_url($archive_link) . '">' . esc_html($month_name . ' ' . $archive->year) . '</a></li>';
    }
    echo '</ul>';

    echo '</div>';

    return ob_get_clean();
}


    // ✅ Add CSS for Sitemap
    public function add_sitemap_styles() {
//         echo '<style>
//             .html-sitemap { font-family: Arial, sans-serif; max-width: 800px; margin: auto; }
//             .html-sitemap h2 { color: #0073aa; margin-top: 20px; }
//             .html-sitemap ul { list-style-type: none; padding: 0; }
//             .html-sitemap li { margin-bottom: 5px; }
//             .html-sitemap a { text-decoration: none; color: #333; }
//             .html-sitemap a:hover { text-decoration: underline; }
//         </style>';
    }

}

// ✅ Initialize the plugin
new HTML_Sitemap_Generator();
?>
