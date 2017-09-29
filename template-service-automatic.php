<?php
/**
 * Template Name: Automaattinen tarjotinsivu
 */
?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="service-page">
		<?php get_template_part( 'templates/content', 'service-automatic' ); ?>
	</div>
<?php endwhile;
