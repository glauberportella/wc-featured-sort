<?php

class Helper {
    public function productThumbUrl($product) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), 'single-post-thumbnail' );
        if (!count($image)) {
            return '';
        }
        return $image[0];
    }

    public function productCategoryNames($product) {
        $cats = get_terms($product->ID, 'product_cat');
        if (!$cats || is_wp_error($cats)) {
            return '';
        }

        $names = array();
        foreach ($cats as $cat) {
            $names[] = $cat->name;
        }
        
        if (!count($names)) {
            return '';
        }

        return implode(' > ', $names);
    }

    public function productPrice($product) {
        $p = wc_get_product($product->ID);
        if (!$p) {
            return 0.00;
        }
        return $p->get_price();
    }
}