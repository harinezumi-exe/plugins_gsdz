<?php

/*
    Plugin Name: Element Listy Relacje
    Description: Dodaj element do listy na stronie "Relacje"
    Version: 1.0
    Author: Anna Jaroszyńska
    Author URI: https://www.linkedin.com/in/anna-jaroszyńska-876475214/
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

require_once(plugin_dir_path( __FILE__ ) . "inc/generateListElementHTML.php");

class ElementListyRealcje
{
    function __construct() {
        add_action( 'init', array($this, 'adminAssets') );
    }

    function adminAssets() {
        wp_register_style( 'accountListElementStyle', plugin_dir_url( __FILE__ ) . 'build/index.css' );
        wp_register_script( 'elrBlockType', plugin_dir_url( __FILE__ ) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor') );
        register_block_type( 'elrplugin/element-listy-relacje', array(
            'editor_script' => 'elrBlockType',
            'editor_style' => 'accountListElementStyle',
            'render_callback' => array($this, 'theHTML')
        ) );
    }

    function theHTML($attrs) {
        return generateListElementHTML($attrs['text'], $attrs['link']);
    }
}

$elementListyRelacje = new ElementListyRealcje();