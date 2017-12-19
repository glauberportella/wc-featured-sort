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

add_action( 'wp_enqueue_scripts', 'wc_featured_sort_enqueue_scripts' );
/**
 * Plugin assets
 */
function wc_featured_sort_enqueue_scripts() {
    wp_enqueue_style( 'wc-featured-sort-style', plugin_dir_url(__FILE__) . 'view/css/wc-featured-sort.css' );
    wp_enqueue_script('wc-featured-sort-javascript', plugin_dir_url(__FILE__) . 'view/js/wc-featured-sort.js', array('jquery'));
}

/**
 * Plugin POST actions
 */
add_action( 'admin_action_wc-featured-sort-save', 'wc_featured_sort_save' );

function wc_featured_sort_save() {
    if (isset($_POST['product_order'])) {
        $orders = $_POST['product_order'];
        if (count($orders)) {
            // 1 - criar mapa com dados ordenados do vetor com as ordens 
            //     associadas ao id dos produtos
            asort($orders);
            // 2 - para cada par no mapa
            //         alterar menu_order do produto
            //     fim para
            foreach ($orders as $post_id => $order) {
                $post = array(
                    'ID' => $post_id,
                    'menu_order' => (int)$order
                );
                wp_update_post($post);
            }
        }
    }

    wp_redirect($_SERVER['HTTP_REFERER']);
    exit();
}