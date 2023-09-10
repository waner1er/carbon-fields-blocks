<?php
/*
 * Plugin Name:wan custom post types and custom gutenberg block
 * Description: starter plugin pour des custom Post Types et Block gutenberg
 * Author: Erwan RIVET
 */

/**
 * Security
 */
defined('ABSPATH') or die('Cheatin&#8217; uh?');


/**
 * Carbon fields init.
 */
add_action('after_setup_theme', 'wan_carbon_load');
function wan_carbon_load()
{
    require_once('vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}

/**
 * Style and scripts
 * */

 function wan_block_and_cpt_styles() {
    // Remplacez 'chemin-vers-votre-css.css' par le chemin vers votre fichier CSS.
    wp_enqueue_style('wan-example-block', plugins_url('assets/example-block.css', __FILE__));
}

add_action('enqueue_block_editor_assets', 'wan_block_and_cpt_styles');

/*
 * BLOCKS
 */

/* Block Exemple */

require_once('blocks/wan_blocks.php');

/**
 * CPTS
 */

require_once('cpt/wan_cpts.php');


// custom category first of the blocks categories
function add_wan_custom_block_catgegory($wan_categories, $post) {
    $wan_category = array(
        'slug'  => 'wan-category', @
        'title' => 'Wan Category',
    );

    // Ajoutez votre catégorie personnalisée en haut de la liste des catégories
    array_unshift($wan_categories, $wan_category);

    return $wan_categories;
}

add_filter('block_categories', 'add_wan_custom_block_catgegory', 10, 2);
