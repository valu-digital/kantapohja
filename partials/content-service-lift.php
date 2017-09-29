<?php
$lift            = get_template_param( 'lift' );
$thumb_url_array = wp_get_attachment_image_src( $lift['thumb_id'], 'landing' );
$thumb_url       = $thumb_url_array[0];

?>
<div class="child-page col-xs-12 col-sm-6 col-md-4">
	<?php if ( $thumb_url ) : ?>
		<div class="entry-image clearfix">
			<a href="<?php echo esc_url( $lift['child_page_link'] ); ?>" target="<?php echo( $lift['external_link'] ? '_blank' : '_self' ); ?>">
				<div class="background" style="background: url(<?php echo esc_url( ( $thumb_url ? $thumb_url : '' ) ); ?>) center / cover;">
					<div class="overlay">
						<span class="overlay_text tk-droid-serif"><?php esc_html_e( 'Read more', 'kantapohja' ); ?></span>
					</div>
				</div>
			</a>
		</div>
	<?php endif; ?>
	<div class="entry-content">
		<h3>
			<a href="<?php echo esc_url( $lift['child_page_link'] ); ?>" target="<?php echo( $lift['external_link'] ? '_blank' : '_self' ); ?>">
				<?php echo esc_html( $lift['child_page_title'] ); ?>
			</a>
		</h3>
	</div>
</div>
