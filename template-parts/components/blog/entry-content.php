<?php
/**
 * Template for entry content
 *
 * To be used inside Wordpress The Loop.
 *
 * @package aquila
 */
?>

<div class="entry-content">
  <?php
  if ( is_single() ) {
    the_content(
      sprintf(
        wp_kses(
          __( 'Continue reading %s <span class="meat-nav">&rarr;</span>', 'aquila' ),
          [
            'span' => [
              'class' => []
            ]
          ]
        ),
        the_title( '<span class="screen-reader-text">"', '"</span>', false )
      )
    );

    wp_link_pages(
      [
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aquila' ),
        'after' => '</div>',
      ]
    );
  } else {
    aquila_the_excerpt(200);
    echo aquila_excerpt_more();
  }
  ?>
</div>