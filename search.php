<?php
use Valu\Kantapohja\Extras;

?>
<?php if ( ! have_posts() ) : ?>
	<div class="alert alert-warning">
		<?php esc_html_e( 'Sorry, no results were found.', 'kantapohja' ); ?>
	</div>
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'templates/content', 'search' ); ?>
<?php endwhile; ?>

<?php
Extras\pagination();
