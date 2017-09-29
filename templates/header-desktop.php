<?php

use Valu\Kantapohja\Assets;

?>
<header class="banner non-sticky" role="banner">
	<div class="container-fluid header-container">
		<div class="row upper-header">
			<div class="col-xs-12 header-col">
				<div class="logo-wrapper header-item">
					<a class="sitename" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img class="logo" src="<?php echo esc_url( Assets\asset_path( 'images/kantapohjalogo_orange.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/>
						<h1 class="logo-text">Kantapohja</h1>
					</a>
				</div>
				<div class="top-nav-wrapper header-item">
					<?php
					if ( has_nav_menu( 'top_navigation' ) ) :
						wp_nav_menu( [
							'theme_location' => 'top_navigation',
							'menu_class'     => 'nav navbar-nav top-nav pull-right',
						] );
					endif;
					?>
				</div>
				<div class="search search-wrap header-item">
					<div class="search-form-container">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row lower-header">
			<nav class="primary-nav-container nav-primary" role="navigation">
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
				?>
			</nav>
		</div>
	</div>
	<?php get_template_part( 'partials/crisis-bulletin' ); ?>
</header>
