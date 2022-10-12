<?php
$section_class = [
  'hero',
  'layout-' . get_query_var( 'layout_index' ),
  get_sub_field( 'section_classes' ),
];
?>
<section <?php ca_section_id(); ?> class="<?php echo trim( implode( ' ', $section_class ) ); ?>">
  <div class="col col-1">
    <div class="hero__content">
      <?php
        ca_the_field( 'heading', '<h1 class="hero__heading">', '</h1>', true );
        ca_the_field( 'description', '<p class="hero__desc">', '</p>', true );

        if ( have_rows( 'buttons' ) ) {
          echo '<div class="hero__button-group">';

          while ( have_rows( 'buttons' ) ) {
            the_row();
            ca_the_link( get_sub_field( 'button' ), 'btn btn--' . get_sub_field( 'type' ) );
          }

          echo '</div>';
        }
      ?>
    </div>
  </div>

  <div class="col col-2">
    <?php
      if ( $image_id = get_sub_field( 'image' ) ) :
        $image_src = wp_get_attachment_image_url( $image_id, 'full' );
        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', TRUE ) ?? get_sub_field( 'heading' );
    ?>
      <div class="hero__image">
        <img src="<?php echo $image_src; ?>" alt="<?php echo $image_alt; ?>" class="w-full">
      </div>
    <?php endif; ?>
  </div>
</section>
