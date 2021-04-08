<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Search
 *
 * @author Hardy
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchProduct
{

    function __construct()
    {
        $this->ci = &get_instance();

        $this->ci->load->model("product_model");
        $this->ci->load->model("tag_model");

        $this->ci->load->library(array('session'));
        $this->ci->load->helper("mabuya");
    }

    function search($search, $category_id, $shop_id)
    {

        $must_search = TRUE;
        if (strlen(trim($search)) == 0) {
            $must_search = FALSE;
        }

        $products = $this->ci->product_model->get_object_to_search($category_id, $shop_id);
        $products_weight = [];

        foreach ($products as $product) {
            $weight = 1;
            if ($must_search) {
                $items = [];
                $items = array_merge([], explode(" ", $product->product_name));
                $items = array_merge($items, explode(" ", $product->category_name));

                $tags = $this->ci->tag_model->get_tag_by_product($product->product_id);
                foreach ($tags as $tag) {
                    $items[] = $tag->tag_name;
                }
                $weight = $this->search_coincidences($search, $items);
            }

            if ($weight > 0.0) {
                $products_weight[] = [$product, $weight];
            }
        }

        if ($must_search) {
            usort($products_weight, 'comparer');
        }

        $result = [];
        foreach ($products_weight as $product) {
            $result[] = $this->ci->product_model->get_by_id($product[0]->product_id);
        }

        return $result;
    }

    function search_coincidences($hash, $where)
    {
        $needles = array_unique(explode(" ", $hash));
        $haystack = $where;

        $total = count($needles);
        $count = 0.0;

        foreach ($needles as $needle) {
            foreach ($haystack as $item) {
                if (strcasecmp($needle, $item) == 0) {
                    $count = $count + 1;
                    break;
                }
            }
        }
        return $count / $total;
    }
}

if (!function_exists("comparer")) {
    function comparer($left, $right)
    {
        if ($left[1] === $right[1]) {
            return 0;
        } elseif ($left[1] > $right[1]) {
            return -1;
        } else {
            return +1;
        }
    }
}