<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package create-ape-theme
 */

if ( ! function_exists( 'create_ape_theme_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function create_ape_theme_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'create-ape-theme' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'create_ape_theme_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function create_ape_theme_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'create-ape-theme' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'create_ape_theme_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function create_ape_theme_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'create-ape-theme' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'create-ape-theme' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'create-ape-theme' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'create-ape-theme' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'create-ape-theme' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'create-ape-theme' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'create_ape_theme_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function create_ape_theme_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

/**
 * Renders ACF Flexible Content a.k.a Blocks
 *
 * @param String $template The flexible layout field-group name
 */
function ca_render_acf_blocks( $template = 'blocks', $post_id = null ) {
  if ( ! $post_id ) {
    $post_id = get_the_ID();
  }

  if ( get_post_status($post_id) !== 'publish' ) {
  	return;
  }

  if ( have_rows( $template, $post_id ) ) {
    $layout_index = 1;

    while ( have_rows( $template, $post_id ) ) {
      the_row();

      set_query_var( 'layout_index', $post_id . '--' . $layout_index );
      $layout = str_replace( '_', '-', get_row_layout() );
      get_template_part( 'template-parts/blocks/block', $layout );

      $layout_index++;
    }
  }
}

/**
 *  Print HTML section ID from Composer field
 */
function ca_section_id() {
  $section_id = '';

  if ( $section_id = get_sub_field( 'section_id' ) ) {
    $section_id = 'id="' . $section_id . '"';
  }

  echo $section_id;
}

/**
 * Custom ACF Field Wrapper
 *
 * @param String $name         Name of the ACF field
 * @param String $before       HTML Markup before the field
 * @param String $after        HTML Markup after the field
 * @param Boolean $sub_field   If the field is subfield
 * @param Boolean $option      If the field is an option
 */
function ca_the_field( $name = false, $before = '', $after = '', $sub_field = false, $option = false ) {
  if ( ! $name ) {
    return;
  }

  $output = '';

  if ( ! $option ) {
    if ( ! $sub_field && get_field( $name ) ) {
      $output = get_field( $name, false, false );
    } else if ( $sub_field && get_sub_field( $name ) ) {
      $output = get_sub_field( $name );
    }
  } else {
    if ( ! $sub_field && get_field( $name, 'option' ) ) {
      $output = get_field( $name, 'option' );
    } else if ( $sub_field && get_sub_field( $name ) ) {
      $output = get_sub_field( $name, 'option' );
    }
  }

  if ( ! empty( $output ) ) {
    echo $before . do_shortcode( $output ) . $after;
  }
}

/**
 * Prints an anchor tag from provided input
 *
 * @param Array   $link         Link array
 * @param String  $css_class    CSS classes
 * @param String  $target       Target attribute
 * @param String  $before       HTML Markup before
 * @param String  $after        HTML Markup after
 * @param String  $attributes   Custom HTML Attributes
 */
function ca_the_link( $link = array(),  $css_classes = '', $target = '', $before = '', $after = '', $attributes = '' ) {
  if ( ! is_array( $link ) || ! count( $link ) ) {
    return;
  }

  $output = '';

  if ( ! empty( $target ) ) {
    $link['target'] = $target;
  }

  if ( ! strpos( $attributes, 'aria-label' ) ) {
    $attributes .= ' aria-label="' . wp_sprintf( __( 'Open for %s', 'fga' ), strip_tags( $link['url'] ) ) . '"';
  }

  $output .= "<a href=\"{$link['url']}\" class=\"{$css_classes}\" target=\"{$link['target']}\" {$attributes}>{$link['title']}</a>";

  if ( ! empty( $output ) ) {
    echo $before . $output . $after;
  }
}
