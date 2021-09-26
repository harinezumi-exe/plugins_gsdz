<?php

/*
    Plugin Name: Link do strony z materiałami do pobrania
    Description: Dodaj link na stronie "Do pobrania" przekierowujący do osobnej podstrony z materiałami
    Version: 1.0
    Author: Anna Jaroszyńska
    Author URI: https://www.linkedin.com/in/anna-jaroszyńska-876475214/
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

require_once(plugin_dir_path( __FILE__ ) . "inc/generateDownloadLinkHTML.php");

class LinkDoPobrania
{
    function __construct() {
        add_action( 'init', array($this, 'adminAssets') );
    }

    function adminAssets() {
        wp_register_style( 'downloadLinkStyle', plugin_dir_url( __FILE__ ) . 'build/index.css' );
        wp_register_script( 'mdplBlockType', plugin_dir_url( __FILE__ ) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor') );
        register_block_type( 'mdplplugin/do-pobrania-link', array(
            'editor_script' => 'mdplBlockType',
            'editor_style' => 'downloadLinkStyle',
            'render_callback' => array($this, 'renderHTML')
        ) );
    }

    function renderHTML($attrs) {
        return generateDownloadLinkHTML($attrs['text'], $attrs['link']);
    }
}

$linkDoPobrania = new LinkDoPobrania();