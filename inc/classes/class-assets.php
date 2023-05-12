<?php
/**
 * Enqueue theme assets
 *
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Assets {

  use Singleton;

  protected function __construct() {
    // load class.
    $this->setup_hooks();
  }

  protected function setup_hooks() {
    /**
     * Actions.
     */
    add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ] );
    add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );
    add_action( 'enqueue_block_assets', [ $this, 'enqueue_editor_assets' ] );
  }

  public function register_styles() {
    // Register Styles.
    wp_register_style( 'bootstrap-css', AQUILA_DIR_URI . '/assets/src/library/css/bootstrap.min.css', [], false, 'all' );
    wp_register_style( 'slick-css', AQUILA_BUILD_LIB_URI . '/css/slick.css', [], false, 'all' );
		wp_register_style( 'slick-theme-css', AQUILA_BUILD_LIB_URI . '/css/slick-theme.css', ['slick-css'], false, 'all' );
    wp_register_style( 'main-css', AQUILA_BUILD_CSS_URI . '/main.css', ['bootstrap-css'], filemtime(AQUILA_BUILD_CSS_DIR_PATH . '/main.css'), 'all' );

    // Enqueue Styles
    wp_enqueue_style( 'bootstrap-css' );
    wp_enqueue_style( 'main-css' );
    wp_enqueue_style( 'slick-css' );
    wp_enqueue_style( 'slick-theme-css' );
  }
  public function register_scripts() {
    // Register Scripts.
    wp_register_script( 'slick-js', AQUILA_BUILD_LIB_URI . '/js/slick.min.js', ['jquery'], false, true );
    wp_register_script( 'main-js', AQUILA_BUILD_JS_URI . '/main.js', ['jquery', 'slick-js'], filemtime(AQUILA_BUILD_JS_DIR_PATH . '/main.js'), true);
    wp_register_script( 'bootstrap-popper-js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js', [], false, true );
    wp_register_script( 'bootstrap-js', AQUILA_DIR_URI . '/assets/src/library/js/bootstrap.min.js', ['bootstrap-popper-js'], false, true);

    // Enqueue Scripts.
    wp_enqueue_script( 'main-js' );
    wp_enqueue_script( 'slick-js' );
    wp_enqueue_script( 'bootstrap-popper-js' );
    wp_enqueue_script( 'bootstrap-js' );
  }
  public function enqueue_editor_assets() {
    $asset_config_file = sprintf( '%s/assets.php', AQUILA_BUILD_PATH );
    if ( !file_exists( $asset_config_file ) ) {
      return;
    }
    $asset_config = require_once $asset_config_file;

    if ( empty($asset_config['js/editor.js']) ) {
      return;
    }

    $editor_asset = $asset_config['js/editor.js'];
    $js_dependencies = ( ! empty( $editor_asset['dependencies'] ) ) ? $editor_asset['dependencies'] : [];
    $version = ( ! empty( $editor_asset['version'] ) ) ? $editor_asset['version'] : filemtime( $asset_config_file );

    // Theme Gutenberg block JS.
    if ( is_admin() ) {
      wp_enqueue_script(
        'aquila-block-js',
        AQUILA_BUILD_JS_URI . '/blocks.js',
        $js_dependencies,
        $version,
        true
      );
    }

    // Theme Gutenberg blocks CSS.
    $css_dependencies = [
      'wp-block-library-theme',
      'wp-block-library',
    ];

    wp_enqueue_style(
      'aquila-block-css',
      AQUILA_BUILD_CSS_URI . '/blocks.css',
      $css_dependencies,
      filemtime( AQUILA_BUILD_CSS_DIR_PATH .'/blocks.css' ),
      'all'
    );
  }
}