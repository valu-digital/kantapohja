<?php

use Valu\Kantapohja\Assets;

$footer_background_image     = get_field( 'footer_background_image', 'option' );
$footer_background_image_src = wp_get_attachment_image_src( $footer_background_image, 'slide-landing' );

// Yoast SEO Social media settings
$wpseo_social = get_option( 'wpseo_social' );
?>
<footer class="content-info clearfix" role="contentinfo">
	<div class="footer-background-color">
		<div class="footer-container container-fluid">
			<div class="first-row">
				<div class="logo-container">
					<a class="sitename" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img class="logo" src="<?php echo esc_url( Assets\asset_path( 'images/kantapohjalogo_white.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/>
						<h1 class="logo-text">Kantapohja</h1>
					</a>
				</div>
			</div>
			<div class="row first-row">
				<div class="widget col-xs-12 col-sm-6 col-md-3 clearfix">
					<?php dynamic_sidebar( 'sidebar-footer' ); ?>
				</div>
				<div class="widget col-xs-12 col-sm-6 col-md-3 clearfix">
					<?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
				</div>
				<div class="widget col-xs-12 col-sm-6 col-md-3 clearfix">
					<?php // Most popular pages  ?>
					<h3><?php esc_html_e( 'Most popular pages', 'kantapohja' ); ?></h3>
					<?php get_template_part( 'partials/popular-pages-list' ); ?>
				</div>
				<div class="widget col-xs-12 col-sm-6 col-md-3 clearfix">
					<?php
					// Target groups
					if ( has_nav_menu( 'target_groups_navigation' ) ) :
						wp_nav_menu( [
							'theme_location' => 'target_groups_navigation',
							'menu_class'     => 'footer-nav target-groups-nav',
							'depth'          => 1,
						] );
					endif;
					?>
				</div>
			</div>
			<div class="row last-row">
				<div class="col-xs-16 clearfix copyright">
					<p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Valu Digital Oy</p>
				</div>
			</div>
		</div>
	</div>
	<div class="visible-lg"></div>
	<div class="visible-md"></div>
	<div class="visible-sm"></div>
	<div class="visible-xs"></div>
</footer>
