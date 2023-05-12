<?php
/**
 * Bootstraps the Theme.
 *
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class AQUILA_THEME {
  use Singleton;

  protected function __construct() {
    // load class.
    Assets::get_instance();
    Menus::get_instance();
    Meta_Boxes::get_instance();
    Sidebars::get_instance();
    Blocks::get_instance();
    Block_Patterns::get_instance();

    $this->setup_hooks();
  }

  protected function setup_hooks() {
    /**
     * Actions.
     */
    add_action( 'after_setup_theme', [$this, 'setup_theme'] );
  }

  public function setup_theme() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo', [
      'height'        => 100,
      'width'         => 400,
      'flex-height'   => true,
      'flex-width'    => true,
    ] );
    add_theme_support( 'custom-background', [
      'default-color'   => '#fff',
      'default-image'   => '',
      'default-repeat'  => 'no-repeat',
    ] );

    add_theme_support( 'post-thumbnails' );

    add_image_size( 'featured-thumbnail', 350, 233, true );

    add_theme_support( 'customize-selective-refresh-widgets' );

    add_theme_support( 'automatic-feed-links' );

    add_theme_support( 'html5',
      [
        'comment-list',
        'comment-form',
        'search-form',
        'gallery',
        'caption',
        'style',
        'script'
      ]
    );


    add_theme_support( 'wp-block-styles' );

    add_theme_support( 'align-wide' );

    add_theme_support( 'editor-styles' );

    // Remove the core block patterns
    remove_theme_support( 'core-block-patterns' );

    add_editor_style( 'assets/build/css/editor.css' );

    global $content_width;
    if (! isset( $content_width ) ) {
      $content_width = 1240;
    }
  }
}