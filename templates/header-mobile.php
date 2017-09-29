<?php
use Valu\Kantapohja\Assets; ?>
<header class="banner non-sticky visible" role="banner">
	<div class="container-fluid header-container-mobile">
		<div class="header-right clearfix">
			<div class="header-top clearfix">
				<div class="sitename-wrap pull-left">
					<a class="sitename" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img class="logo" src="<?php echo esc_url( Assets\asset_path( 'images/kantapohjalogo_orange.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/>
						<h1 class="logo-text">Kantapohja</h1>
					</a>
				</div>
				<div class="header-top-wrap clearfix">
					<div class="mobile-nav-wrapper pull-right clearfix">
						<?php
						if ( has_nav_menu( 'primary_navigation' ) ) :
							wp_nav_menu( [
								'theme_location'  => 'primary_navigation',
								'container'       => 'div',
								'container_class' => 'collapse navbar-collapse navbar-wrapper',
								'container_id'    => 'main-navigation',
								'menu_class'      => 'nav navbar-nav',
								'fallback_cb'     => 'WP_Bootstrap_Nav_Walker::fallback',
								'walker'          => new WP_Bootstrap_Nav_Walker(),
							] );
						endif;
						if ( has_nav_menu( 'top_navigation' ) ) :
							wp_nav_menu( [
								'theme_location' => 'top_navigation',
								'menu_class'     => 'nav navbar-nav mobile-top-nav',
							] );
						endif;
						?>
					</div>
					<div class="search-wrapper pull-right search">
						<span class="glyphicon glyphicon-search" aria-hidden="true" data-toggle="collapse" data-target=".search-form-collapse" type="button"></span>
						<div class="search-form-collapse collapse">
							<div class="search-form-in">
								<?php get_search_form(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php get_template_part( 'partials/crisis-bulletin' ); ?>
</header>
