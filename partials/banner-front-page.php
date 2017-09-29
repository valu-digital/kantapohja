<?php
$mainlift_title       = get_field( 'mainlift_title' );
$mainlift_ingress     = get_field( 'mainlift_ingress' );
$mainlift_url         = get_field( 'mainlift_url' );
$mainlift_button_text = get_field( 'mainlift_button_text' );
$mainlift_image       = get_field( 'mainlift_image' );
$bgimage              = wp_get_attachment_image_src( $mainlift_image, 'banner' );
?>
<section class="front-page-banner" style="background-image: url(<?php echo esc_attr( ( $mainlift_image ? $bgimage[0] : '' ) ); ?>);">
	<div class="bgcolor">
		<div class="container-fluid banner-container">
			<div class="vertical banner-content row">
				<div class="col-xs-12 col-lg-6 banner-col">
					<?php if ( $mainlift_title ) : ?>
						<h1 class="banner"><?php echo esc_html( $mainlift_title ); ?></h1>
					<?php endif; ?>
					<?php if ( $mainlift_ingress ) : ?>
						<p><?php echo wp_kses_post( $mainlift_ingress ); ?> </p>
					<?php endif; ?>
					<?php if ( $mainlift_button_text ) : ?>
						<a class="btn btn-lift btn-main btn-main-lift" href="<?php echo esc_attr( $mainlift_url ); ?>">
							<?php echo esc_html( $mainlift_button_text ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="container-fluid popular-pages-lift-container clearfix">
	<div class="popular-pages-lift clearfix" tabindex="0">
		<div class="popular-pages-content">
			<?php get_template_part( 'partials/popular-pages-list' ); ?>
		</div>
		<h3 class="popular-pages-header"><?php esc_html_e( 'Most popular pages', 'kantapohja' ); ?> </h3>
		<span class="pp-closed pp-open-close active plus">+</span>
		<span class="pp-opened pp-open-close minus">-</span>
	</div>
</div>
