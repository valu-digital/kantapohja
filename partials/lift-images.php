<section class="image-lifts main-lift">
	<div class="lifts-container container-fluid">
		<?php if ( have_rows( 'imagelift_repeater' ) ) : ?>
			<div class="row image-lifts-row">
				<?php while ( have_rows( 'imagelift_repeater' ) ) : the_row(); ?>
					<?php
					$lift_title       = get_sub_field( 'lift_title' );
					$lift_url         = get_sub_field( 'lift_url' );
					$lift_button_name = get_sub_field( 'lift_button_name' );
					$lift_image       = get_sub_field( 'lift_image' );
					$lift_image_src   = wp_get_attachment_image_src( $lift_image, 'frontpage-imagelift' );
					?>
					<a href="<?php echo esc_url( $lift_url ); ?>" target="_blank">
						<div class="image-lifts-article col-xs-12 col-sm-6 col-md-4">
							<div class="image-lifts-image" style="background: url(<?php echo esc_url( ( $lift_image ? $lift_image_src[0] : '' ) ); ?>) center / cover;">
								<div class="overlay">
									<div class="lift-text">
										<h2 class="lift-title white-text"><?php echo esc_html( $lift_title ); ?></h2>
										<?php if ( $lift_button_name ) : ?>
											<p class="btn btn-lift btn-red"><?php echo esc_html( $lift_button_name ); ?></p>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</a>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
