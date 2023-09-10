<?php
/**
 * Register Custom Taxonomies

 *

 * Taxonomy Key: example tax

 * For url rewriting taxonomy must be registered before CPT

 */
add_action('init', 'create_theme_tax', 0);

function create_theme_tax()
{
    $args = array(
        'labels' => wan_labels_tax('taxonomie exemple', 'taxonomies exemples', 'f'),
        'hierarchical' => true,
        'public' => true,
        'rewrite' => array('slug' => 'example_tax'),
        'show_in_rest' => true,// Important ! pour avoir la taxonomie dans le nouvel éditeur.
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => false,
    );
    register_taxonomy('example_tax', array('page', 'example'), $args);

}


/**

 * Register Custom Post Type example

 */
add_action('init', 'create_example_cpt', 0);
function create_example_cpt()
{
	$args = array(

		'label' => __('example', 'R1-starterchild'),
		'description' => 'example description',
		'R1-starterchild'
		,
		'labels' => wan_labels_cpt('example', 'examples', 'm'),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-filter',
		'rewrite' => array('slug' => 'example'),
		'capability_type' => 'page',
		'has_archive' => true,
		'hierarchical' => false,
		'show_in_rest' => true,
		// Important ! pour avoir avoir Gutenberg sur les cpt.
		'rest_base' => 'example',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', 'excerpt'),
	);

	register_post_type('example', $args);
}

/**

 * Générer les labels tax et cpt automatiquement

 * @param $singular

 * @param $plural

 * @param $genre

 * @return array

 */

function wan_labels_cpt($singular, $plural, $genre)
{

	return array(

		'name' => ucfirst($plural),

		'singular_name' => ucfirst($singular),

		'menu_name' => ucfirst($plural),

		'all_items' => wan_label_genre($singular, $genre, 'Tous', 'Toutes') . ' les ' . $plural,

		'add_new' => 'Ajouter ' . wan_label_genre($singular, $genre, 'un', 'une') . ' ' . $singular,

		'add_new_item' => 'Ajouter ' . wan_label_genre($singular, $genre, 'un', 'une') . ' ' . wan_label_genre($singular, $genre, 'nouveau', 'nouvelle', 'nouvel') . ' ' . $singular,

		'edit_item' => 'Éditer ' . wan_label_genre($singular, $genre, 'le ', 'la ', 'l\'') . $singular,

		'new_item' => wan_label_genre($singular, $genre, 'Nouveau', 'Nouvelle', 'Nouvel') . ' ' . $singular,

		'view_item' => 'Voir ' . wan_label_genre($singular, $genre, 'le ', 'la ', 'l\'') . $singular,

		'search_items' => 'Rechercher les ' . $plural,

		'not_found' => 'Pas ' . wan_label_genre($singular, $genre, 'de ', 'de ', 'd\'') . $singular,

		'not_found_in_trash' => 'Pas ' . wan_label_genre($singular, $genre, 'de ', 'de ', 'd\'') . $singular . ' dans la corbeille',

	);

}

function wan_labels_tax($singular, $plural, $genre)
{

	return array(

		'name' => ucfirst($plural),

		'singular_name' => ucfirst($singular),

		'menu_name' => ucfirst($plural),

		'all_items' => wan_label_genre($singular, $genre, 'Tous', 'Toutes') . ' les ' . $plural,

		'add_new' => 'Ajouter ' . wan_label_genre($singular, $genre, 'un', 'une') . ' ' . $singular,

		'new_item_name' => 'Nouveau nom de ' . $singular,

		'update_item' => 'Mettre à jour ' . wan_label_genre($singular, $genre, 'le ', 'la ', 'l\'') . $singular,

		'add_new_item' => 'Ajouter ' . wan_label_genre($singular, $genre, 'un', 'une') . ' ' . wan_label_genre($singular, $genre, 'nouveau', 'nouvelle', 'nouvel') . ' ' . $singular,

		'edit_item' => 'Éditer ' . wan_label_genre($singular, $genre, 'le ', 'la ', 'l\'') . $singular,

		'new_item' => wan_label_genre($singular, $genre, 'Nouveau', 'Nouvelle', 'Nouvel') . ' ' . $singular,

		'view_item' => 'Voir ' . wan_label_genre($singular, $genre, 'le ', 'la ', 'l\'') . $singular,

		'search_items' => 'Rechercher les ' . $plural,

		'choose_from_most_used' => 'Choisir parmi les ' . $plural . ' les plus ' . wan_label_genre($singular, $genre, 'utilisés', 'utilisées'),

		'add_or_remove_items' => 'Ajouter ou supprimer ' . wan_label_genre($singular, $genre, 'un', 'une') . ' ' . $singular,

		'separate_items_with_commas' => 'Séparer les ' . $plural . ' par des virgules',

		'popular_items' => $plural . ' populaires',

		'not_found' => 'Pas ' . wan_label_genre($singular, $genre, 'de ', 'de ', 'd\'') . $singular,

		'not_found_in_trash' => 'Pas ' . wan_label_genre($singular, $genre, 'de ', 'de ', 'd\'') . $singular . ' dans la corbeille',

	);

}

function wan_label_genre($mot, $genre, $m, $f, $i = '')
{

	$voyelles = array('a', 'e', 'i', 'o', 'u', 'y', 'h', 'à', 'â', 'é', 'è', 'ê', 'î', 'ï', 'ù', 'û', 'ô');

	if ('' != $i && in_array($mot[0], $voyelles))

		return $i;
	else

		return ('m' == $genre) ? $m : $f;

}