<?php

/**
 * Represents featured products.
 *
 * @package Wc_Featured_Sort
 */
class Featured {
    /**
     * Return all the featured product
     * 
     * @return array
     */
    public function get($posts_per_page = -1) {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $posts_per_page,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'tax_query' => array(
                    array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                    ),
                ),
            );

        return get_posts($args);
    }
}