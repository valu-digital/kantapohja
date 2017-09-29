<?php
use Valu\Kantapohja\Assets;

$main_title = get_sub_field( 'main_title' );
?>
<?php if ( have_rows( 'icon_lift' ) ) : ?>
	<section class="icon-lift-wrapper icon-lifts main-lift">
		<div class="container-fluid icon-lift-container">
			<div class="row">
				<div class="col-xs-12 icon-lifts-flex">
					<?php while ( have_rows( 'icon_lift' ) ) :
						the_row(); ?>
						<div class="icon-lift-col">
							<article class="icon-lift-article">
								<?php
								$icon_lift_icon  = get_sub_field( 'icon_lift_icon' );
								$icon_lift_title = get_sub_field( 'icon_lift_title' );
								$icon_lift_url   = get_sub_field( 'icon_lift_url' );

								$site_link = parse_url( get_bloginfo( 'url' ), PHP_URL_HOST );
								$link_base = parse_url( $icon_lift_url, PHP_URL_HOST );
								?>
								<a href="<?php echo esc_url( $icon_lift_url ); ?>" <?php echo( strcmp( $site_link, $link_base ) !== 0 ? 'target="_blank"' : '' ); ?>>
									<?php if ( $icon_lift_icon ) : ?>
										<div class="image-wrap">
											<img class="svg-lift-icon svg-icon" src="<?php echo esc_attr( Assets\asset_path( 'images/icons/' . $icon_lift_icon . '.svg' ) ); ?>">
										</div>
									<?php endif; ?>
									<?php if ( $icon_lift_title ) : ?>
										<h4><?php echo esc_html( $icon_lift_title ); ?></h4>
									<?php endif; ?>
								</a>
							</article>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif;
