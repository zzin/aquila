<?php
/**
 * Cover Block Patterns Template
 *
 * @package Aquila
 */
?>

<!-- wp:cover {"url":"<?php echo esc_url( AQUILA_BUILD_IMG_URI . '/patterns/cover.jpg' ) ?>","id":16,"dimRatio":50,"align":"full","className":"aquila-cover"} -->
<div class="wp-block-cover alignfull aquila-cover"><span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span><img class="wp-block-cover__image-background wp-image-16" alt="" src="<?php echo esc_url( AQUILA_BUILD_IMG_URI . '/patterns/cover.jpg' ) ?>" data-object-fit="cover" />
  <div class="wp-block-cover__inner-container">
    <!-- wp:heading {"textAlign":"center","level":1} -->
    <h1 class="wp-block-heading has-text-align-center"><strong>Never let your memories be greater than your dreams</strong></h1>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","textColor":"cyan-bluish-gray"} -->
    <p class="has-text-align-center has-cyan-bluish-gray-color has-text-color"><strong>A mind that is strectched by a new experience can never go back to its old dimensions.</strong></p>
    <!-- /wp:paragraph -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-buttons">
      <!-- wp:button {"textColor":"cyan-bluish-gray","className":"is-style-outline"} -->
      <div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-cyan-bluish-gray-color has-text-color wp-element-button">Blogs</a></div>
      <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
  </div>
</div>
<!-- /wp:cover -->