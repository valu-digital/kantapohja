<?php
/**
 * Template Name: Tarjotinsivu
 */
?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="service-page">
		<?php get_template_part( 'templates/content', 'service' ); ?>
	</div>
<?php endwhile;
