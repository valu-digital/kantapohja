<?php if ( have_rows( 'person_lifts_content' ) ) : ?>
	<?php while ( have_rows( 'person_lifts_content' ) ) : the_row(); ?>
		<?php if ( get_row_layout() === 'contact_lift' ) : ?>
			<?php
			$contacts = get_sub_field( 'select_contacts' );
			if ( $contacts ) : ?>
				<?php foreach ( $contacts as $post ) : ?>
					<?php setup_postdata( $post ); ?>
					<?php get_template_part( 'partials/person-card-single' ); ?>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endwhile; ?>
<?php endif;
