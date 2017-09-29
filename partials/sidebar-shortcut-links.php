<?php if ( have_rows( 'sidebar_shortcut_links_repeater' ) ) : ?>
	<?php while ( have_rows( 'sidebar_shortcut_links_repeater' ) ) : the_row(); ?>
		<?php
		$internal_or_external = get_sub_field( 'internal_or_external' );
		if ( 'internal' === $internal_or_external ) :
			?>
			<?php
			$sidebar_shortcut_links_page = get_sub_field( 'sidebar_shortcut_links_page' ); ?>
			<?php if ( $sidebar_shortcut_links_page ) : ?>
			<?php foreach ( $sidebar_shortcut_links_page as $post ) : ?>
				<?php setup_postdata( $post ); ?>
				<div class="shortcut-link link-container">
					<i class="fa fa-angle-right" aria-hidden="true"></i>
					<a class="btn-arrow" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
			<?php endforeach; ?>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
		<?php elseif ( 'external' === $internal_or_external ) : ?>
			<?php
			$sidebar_shortcut_links_url  = get_sub_field( 'sidebar_shortcut_links_url' );
			$sidebar_shortcut_links_link = get_sub_field( 'sidebar_shortcut_links_link' );
			?>
			<div class="shortcut-link link-container">
				<i class="fa fa-angle-right" aria-hidden="true"></i>
				<a class="btn-arrow" href="<?php echo esc_url( $sidebar_shortcut_links_url ); ?>" target="_blank">
					<?php echo esc_html( $sidebar_shortcut_links_link ); ?>
				</a>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
<?php endif;
