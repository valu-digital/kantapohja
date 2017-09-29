<section class="lift-three-column main-lift">
	<div class="container-fluid">
		<div class="row">
			<?php if ( have_rows( 'column_lift' ) ) : ?>
				<?php while ( have_rows( 'column_lift' ) ) : the_row(); ?>
					<?php
					$columnlift_title   = get_sub_field( 'columnlift_title' );
					$columnlift_content = get_sub_field( 'columnlift_content' );
					$columnlift_image   = get_sub_field( 'columnlift_image' );
					$columnlift_url     = get_sub_field( 'columnlift_url' );
					?>
					<div class="col-xs-12 col-sm-4 three-column-lift">
						<article class="column-lift">
							<?php if ( $columnlift_image ) : ?>
								<div class="entry-image clearfix">
									<a href="<?php echo esc_url( $columnlift_url ); ?>">
										<div class="overlay">
											<span class="overlay_text tk-droid-serif"><?php esc_html_e( 'Read more', 'kantapohja' ); ?></span>
										</div>
										<?php echo wp_get_attachment_image( $columnlift_image, 'columnlift' ); ?>
									</a>
								</div>
							<?php endif; ?>
							<div class="entry-content">
								<a href="<?php echo esc_url( $columnlift_url ); ?>">
									<div class="text-content">
										<h3 class="lift"><?php echo esc_html( $columnlift_title ); ?></h3>
										<?php echo wp_kses_post( $columnlift_content ); ?>
									</div>
								</a>
							</div>
						</article>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
