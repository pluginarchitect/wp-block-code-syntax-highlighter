<?php

/**
* Plugin Name: Code Syntax Highlighter
* Description: A WordPress block for code syntax highlighting.
* Version: 0.0.1
* Author: Kyle B. Johnson
* Author URI: https://pluginarchitect.com
* Text Domain: kbj-code-block
*
* Copyright 2018 Kyle B. Johnson.
*/

defined( 'ABSPATH' ) || exit;

// Scripts and Styles are enqueued on init (as opposed to the regular enqueue hook)
// so that they can be registered early enough for the new editor.
add_action( 'init', 'kbj_code_block_register_plugin_scripts_styles' );
function kbj_code_block_register_plugin_scripts_styles() {
    wp_register_style(
      'kbj-code-block-highlight-js-dark',
      'https://highlightjs.org/static/demo/styles/atom-one-dark.css'
    );
    wp_register_script(
      'kbj-code-block-highlight-js',
      '//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js'
    );
    wp_register_script(
        'kbj-code-block',
        plugins_url( 'code-block.js', __FILE__ ),
        array( 'wp-blocks', 'wp-i18n', 'wp-element', 'underscore', 'kbj-code-block-highlight-js' ),
        filemtime( plugin_dir_path( __FILE__ ) . 'code-block.js' )
    );
}

add_action( 'enqueue_block_editor_assets', 'kbj_code_block_enqueue_block_editor_assets' );
function kbj_code_block_enqueue_block_editor_assets() {
    wp_enqueue_script( 'kbj-code-block' );
    wp_enqueue_style( 'kbj-code-block-highlight-js-dark' );
}

add_action( 'enqueue_block_assets', 'kbj_code_block_enqueue_block_assets' );
function kbj_code_block_enqueue_block_assets() {
    wp_enqueue_style( 'kbj-code-block-highlight-js-dark' );
}
