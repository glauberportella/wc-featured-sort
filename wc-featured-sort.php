<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the
 * plugin admin area. This file also defines a function that starts the plugin.
 *
 * @link              https://medium.com/@glauberportella
 * @since             1.0.0
 * @package           Wc_Featured_Sort
 *
 * @wordpress-plugin
 * Plugin Name:       Woocommerce Featured Sort
 * Plugin URI:        https://medium.com/@glauberportella
 * Description:       Allow ordering featured Products as you wish.
 * Version:           1.0.0
 * Author:            Glauber Portella
 * Author URI:        https://medium.com/@glauberportella
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

require_once dirname(__FILE__).'/vendor/autoload.php';

// Include the dependencies needed to instantiate the plugin.
foreach ( glob( plugin_dir_path( __FILE__ ) . 'includes/*.php' ) as $file ) {
    include_once $file;
}
 
add_action( 'plugins_loaded', 'wc_featured_sort' );
/**
 * Starts the plugin.
 *
 * @since 1.0.0
 */
function wc_featured_sort() {
    $plugin = new Submenu( new Submenu_Page() );
    $plugin->init();
}