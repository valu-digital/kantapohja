<?php if ( have_rows( 'editor_content' ) ) : ?>

	<?php while ( have_rows( 'editor_content' ) ) : the_row(); ?>

		<?php
		switch ( get_row_layout() ) {
			case 'icon_lifts':
				get_template_part( 'partials/lift-icons' );
				break;
			case 'some_lift':
				get_template_part( 'partials/lift-some-feed' );
				break;
			case 'newslift':
				get_template_part( 'partials/lift-news' );
				break;
			case 'imagecolumnlift':
				get_template_part( 'partials/lift-image-column' );
				break;
			case 'threecolumn_lift':
				get_template_part( 'partials/lift-three-column' );
				break;
			case 'events_lift':
				get_template_part( 'partials/lift-events' );
				break;
			case 'imagelifts':
				get_template_part( 'partials/lift-images' );
				break;
			default:
				break;
		}
		?>

	<?php endwhile; ?>

<?php endif;
