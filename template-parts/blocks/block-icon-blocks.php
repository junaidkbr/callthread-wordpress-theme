<?php
$section_class = [
  'icon-blocks',
  'layout-' . get_query_var( 'layout_index' ),
  get_sub_field( 'section_classes' ),
  get_sub_field( 'pull_section' ) ? 'pull-up' : '',
];
?>
<section <?php ca_section_id(); ?> class="<?php echo trim( implode( ' ', $section_class ) ); ?>">
  <div class="card-wrapper container">
    <?php while ( have_rows( 'icons' ) ) : the_row(); ?>
      <div class="card-wrapper__card">
        <?php
          if ( $icon_id = get_sub_field( 'icon' ) ) :
            $icon_src = wp_get_attachment_image_url( $icon_id, 'full' );
            $icon_alt = get_post_meta( $icon_id, '_wp_attachment_image_alt', TRUE ) ?? get_sub_field( 'heading' );
        ?>
          <div class="card-wrapper__img center">
            <img src="<?php echo $icon_src; ?>" alt="<?php echo $icon_alt; ?>">
          </div>
        <?php endif; ?>

        <div class="card-wrapper__content">
          <?php
            ca_the_field( 'heading', '<h3>', '</h3>', true );
            ca_the_field( 'description', '<p>', '</p>', true );
          ?>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</section>
