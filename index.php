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
    $script_js     = 'src/show-post.js';
    // Register
    wp_register_script('webcomponent',plugins_url( $script_js, __FILE__ ),'1.0');
    // Enqueue - available here in PHP and in index.js
 		wp_enqueue_script('webcomponent',	plugins_url( $script_js, __FILE__ ), array(), '1.0', true);
  }

  function theHTML($attributes) {
    ob_start(); ?>
    <h3>Today the sky is <?php echo esc_html($attributes['skyColor']) ?> and the grass is <?php echo esc_html($attributes['grassColor']) ?>!</h3>
    <h2 class="text-2xl text-red-500">The Web Component</h2>
    <!-- Web Component -->
    <show-post postid="<?php echo esc_html($attributes['postId']);?>"></show-post>
    <?php return ob_get_clean();
  }
}

$areYouPayingAttention = new AreYouPayingAttention();