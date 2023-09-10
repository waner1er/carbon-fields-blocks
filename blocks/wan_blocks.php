<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;


function wan_blocks()
{
    Block::make(__('example-block'))
        ->set_icon('carrot')
        ->set_description(__('A simple example block'))
        ->set_category('wan-category', __('Wan Category'), 'smiley')
        ->set_keywords([__('block'), __('example'), __('content')])
        ->set_mode('preview')
        ->add_fields([
            Field::make('text', 'example_text', __('example text')),
        ])
        ->set_render_callback(function ($block) {
            $text = $block['example_text'];
            echo '<h1>' . ucfirst($text) . '</h1>';
        });

}

add_action('carbon_fields_register_fields', 'wan_blocks');
