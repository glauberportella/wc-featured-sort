<?php
/**
 * The plugin template engine
 *
 * @package Wc_Featured_Sort
 */
 
/**
 * Singleton for the plugin template engine
 * 
 * @package Wc_Featured_Sort
 */
class TemplateEngine {
    private static $instance;

    public function instance() {
        if (!$this->instance) {
            $loader = new Twig_Loader_Filesystem(dirname(__FILE__).'/../view/templates');
            $this->instance = new Twig_Environment($loader, array(
                //'cache' => dirname(__FILE__).'/../cache'
            ));
        }
        return $this->instance;
    }
}