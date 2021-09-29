<?php

/*
  Plugin Name: Are You Paying Attention Quiz
  Description: Give your readers a multiple choice question.
  Version: 1.0
  Author: Brad
  Author URI: https://www.udemy.com/user/bradschiff/
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AreYouPayingAttention {
  function __construct() {
    add_action('init', array($this, 'adminAssets'));
  }

  function adminAssets() {
    wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element'));
    register_block_type('ourplugin/are-you-paying-attention', array(
      'editor_script' => 'ournewblocktype',
      'render_callback' => array($this, 'theHTML')
    ));
    // Path to Web Component
    $script_js     = 'src/show-post-block.js';
    // Register
    wp_register_script('webcomponent',plugins_url( $script_js, __FILE__ ),'1.0');
    // Enqueue - available here in PHP and in index.js
 		wp_enqueue_script('webcomponent',	plugins_url( $script_js, __FILE__ ), array(), '1.0', true);
  }

  function theHTML($attributes) {
    ob_start(); ?>
    <p class="text-2xl mt-2"><?php echo esc_html($attributes['skyColor']) ?> - <?php echo esc_html($attributes['grassColor']) ?> - ID: <?php echo esc_html($attributes['postId']) ?></p>
    <h2 class="text-2xl text-red-500">The Web Component</h2>
    <!-- Web Component -->
    <show-post-block postid="<?php echo esc_html($attributes['postId']);?>"></show-post-block>
    <?php return ob_get_clean();
  }
}

$areYouPayingAttention = new AreYouPayingAttention();