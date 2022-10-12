<?php
$section_class = [
  'cta',
  'layout-' . get_query_var( 'layout_index' ),
  get_sub_field( 'section_classes' ),
];
?>
<section <?php ca_section_id(); ?> class="<?php echo trim( implode( ' ', $section_class ) ); ?>">
  <div class="cta__container">
    <?php
      ca_the_field( 'heading', '<h2 class="section-title">', '</h2>', true );
      ca_the_field( 'description', '<p class="section-desc">', '</p>', true );
      ca_the_link( get_sub_field( 'button' ), 'btn btn--blue' );
    ?>
  </div>

  <?php
    if ( $image_id = get_sub_field( 'image' ) ) :
      $image_src = wp_get_attachment_image_url( $image_id, 'full' );
      $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', TRUE ) ?? get_sub_field( 'heading' );
  ?>
    <div class="cta__main-img">
      <img src="<?php echo $image_src; ?>" alt="<?php echo $image_alt; ?>" class="w-full">
    </div>
  <?php endif; ?>
</section>
