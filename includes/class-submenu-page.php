<?php
/**
 * Creates the submenu page for the plugin.
 *
 * @package Wc_Featured_Sort
 */
 
/**
 * Creates the submenu page for the plugin.
 *
 * Provides the functionality necessary for rendering the page corresponding
 * to the submenu with which this page is associated.
 *
 * @package Wc_Featured_Sort
 */
class Submenu_Page {
 
    /**
     * This function renders the contents of the page associated with the Submenu
     * that invokes the render method. In the context of this plugin, this is the
     * Submenu class.
     */
    public function render() {
        $helper = new Helper();
        $featured = new Featured();
        $products = $featured->get();
        $action_url = admin_url('admin.php');
        echo TemplateEngine::instance()->render('submenu-page.html.twig', array(
            // template variables
            'helper' => $helper,
            'products' => $products,
            'form_action' => $action_url,
        ));
    }
}