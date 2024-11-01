<?php
/*
 * Plugin Name: Widget Search Filter
 * Description: Quickly filter your widgets by search.
 * Plugin URI: https://wordpress.org/plugins/widget-search-filter
 * Author: Mickey Kay
 * Author URI: http://mickeykaycreative.com
 * Version: 1.1.1
 * License: GPL2
 * Text Domain: widget-search-filter
 * Domain Path: /lang
 */

add_action( 'admin_enqueue_scripts', 'wsf_scripts' );
/**
 * Enqueue scripts.
 *
 * @param string      $handle    Script name.
 * @param string      $src       Script url.
 * @param array       $deps      (optional) Array of script names on which this script depends.
 * @param string|bool $ver       (optional) Script version (used for cache busting), set to null to disable.
 * @param bool        $in_footer (optional) Whether to enqueue the script before </head> or before </body>.
 */
function wsf_scripts() {

	// Get minification prefix
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Admin helper CSS
	wp_enqueue_style( 'widget-search-filter', plugins_url( '/css/widget-search-filter.css', __FILE__ ) );

	// Widget Search Filter JS
	wp_enqueue_script( 'widget-search-filter', plugins_url( "/js/widget-search-filter$suffix.js", __FILE__ ), array( 'jquery' ), false, true );

	// liveFilter Plugin
	wp_enqueue_script( 'jquery-liveFilter', plugins_url( "/js/jquery.liveFilter$suffix.js", __FILE__ ), array( 'jquery' ), false, true );
}

add_action( 'widgets_admin_page', 'wsf_add_search_input' );
/**
 * Output widget search filter input.
 *
 * @since  1.0.0
 */
function wsf_add_search_input() { ?>
<div id="available-widgets-filter">
	<label class="screen-reader-text" for="widgets-search"><?php _e( 'Search Widgets', 'widget-search-filter' ); ?></label>
	<input type="search" id="widgets-search" placeholder="<?php esc_attr_e( 'Search widgets&hellip;', 'widget-search-filter' ) ?>" />
</div>
<?php }

