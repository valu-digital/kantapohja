<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'partials/banner-front-page' ); ?>
	<?php get_template_part( 'partials/page-content-flexible' ); ?>
<?php endwhile;
