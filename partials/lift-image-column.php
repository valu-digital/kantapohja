<?php
$imagecolumnlift_title         = get_sub_field( 'imagecolumnlift_title' );
$imagecolumnlift_content       = get_sub_field( 'imagecolumnlift_content' );
$trimmed_text                  = wp_trim_words( $imagecolumnlift_content, $num_words = 50, '...' );
$imagecolumnlift_imagelocation = get_sub_field( 'imagecolumnlift_imagelocation' );
$imagecolumnlift_image         = get_sub_field( 'imagecolumnlift_image' );
$imagecolumnlift_image_src     = wp_get_attachment_image_src( $imagecolumnlift_image, 'imagelift' );
$button_text                   = get_sub_field( 'button_text' );
$button_url                    = get_sub_field( 'button_url' );
$imagecolumnlift_date          = get_sub_field( 'imagecolumnlift_date' );
$overlaytext                   = get_sub_field( 'overlaytext' );
?>

<section class="image-lift lift <?php echo esc_html( $imagecolumnlift_imagelocation ); ?>">
	<div class="container-fluid image-lift-content clearfix">
		<div class="row image-row">
			<div class="col-xs-12 col-md-6 image-text-col <?php echo esc_attr( ( 'left' === $imagecolumnlift_imagelocation ? 'col-md-push-6 ' . $imagecolumnlift_imagelocation : $imagecolumnlift_imagelocation ) ); ?>">
				<div class="text">
					<?php if ( $imagecolumnlift_date ) : ?>
						<span class="date"><?php echo esc_html( $imagecolumnlift_date ); ?></span>
					<?php endif; ?>
					<?php if ( $imagecolumnlift_title ) : ?>
						<?php if ( $button_url ) : ?>
							<a href="<?php echo esc_url( $button_url ); ?>">
						<?php endif; ?>
						<h2 class="lift"><?php echo esc_html( $imagecolumnlift_title ); ?></h2>
						<?php if ( $button_url ) : ?>
							</a>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ( $trimmed_text ) : ?>
						<div class="content-text">
							<?php if ( $button_url ) : ?>
							<a href="<?php echo esc_url( $button_url ); ?>">
								<?php endif; ?>
								<p><?php echo wp_kses_post( $trimmed_text ); ?></p>
								<?php if ( $button_url ) : ?>
							</a>
						<?php endif; ?>
						</div>
						<?php if ( $button_url ) : ?>
							<a class="btn btn-lift btn-brand" href="<?php echo esc_url( $button_url ); ?>">
								<?php echo esc_html( $button_text ); ?>
							</a>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 image <?php echo esc_attr( ( 'left' === $imagecolumnlift_imagelocation ? 'col-md-pull-6 ' . $imagecolumnlift_imagelocation : $imagecolumnlift_imagelocation ) ); ?>" style="background: url(<?php echo esc_url( ( $imagecolumnlift_image ? $imagecolumnlift_image_src[0] : '' ) ); ?>) center / cover;">
				&nbsp;<?php if ( $overlaytext ) : ?>
					<div class="overlay-text tk-droid-serif <?php echo esc_attr( ( 'left' === $imagecolumnlift_imagelocation ? 'pull-left ' : 'pull-right' ) ); ?>">
						<?php echo esc_html( $overlaytext ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
