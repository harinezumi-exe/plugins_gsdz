<?php

/*
    Plugin Name: Podstrona z materiałami do pobrania
    Description: Generator zawartości podstrony prezentującej materiały do pobrania.
    Version: 1.0
    Author: Anna Jaroszyńska
    Author URI: https://www.linkedin.com/in/anna-jaroszyńska-876475214/
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

require_once(plugin_dir_path( __FILE__ ) . "inc/generatePageHTML.php");

class MaterialyDoPobraniaStrona
{
    function __construct() {
        add_action( 'init', array($this, 'adminAssets') );
    }

    function adminAssets() {
        wp_register_style( 'downloadPageStyle', plugin_dir_url( __FILE__ ) . 'build/index.css' );
        wp_register_script( 'mdppBlockType', plugin_dir_url( __FILE__ ) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor') );
        register_block_type( 'mdppplugin/materialy-do-pobrania-podstrona', array(
            'editor_script' => 'mdppBlockType',
            'editor_style' => 'downloadPageStyle',
            'render_callback' => array($this, 'renderHTML')
        ) );
    }

    function renderHTML($attrs) {
        return generatePageHTML($attrs);
    }
}

$materialyDoPobraniaStrona = new MaterialyDoPobraniaStrona();