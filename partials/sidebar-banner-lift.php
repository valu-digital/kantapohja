<?php
$sidebar_banner_text      = get_sub_field( 'sidebar_banner_text' );
$sidebar_banner_url       = get_sub_field( 'sidebar_banner_url' );
$sidebar_banner_image     = get_sub_field( 'sidebar_banner_image' );
$sidebar_banner_image_src = wp_get_attachment_image_src( $sidebar_banner_image, 'sidebar-banner' );
?>
<div class="sidebar-banner-lift" style="background: url(<?php echo esc_url( ( $sidebar_banner_image ? $sidebar_banner_image_src[0] : '' ) ); ?>) center / cover;">
	<?php if ( $sidebar_banner_url ) : ?>
	<a href="<?php echo esc_url( $sidebar_banner_url ); ?>" target="_blank">
		<?php endif; ?>
		<div class="overlay">
			<div class="sidebar-banner-content vertical">
				<?php if ( $sidebar_banner_text ) : ?>
					<h2 class="banner-lift-title tk-droid-serif"><?php echo esc_html( $sidebar_banner_text ); ?></h2>
				<?php endif; ?>
			</div>
		</div>
		<?php if ( $sidebar_banner_url ) : ?>
	</a>
<?php endif; ?>
</div>
