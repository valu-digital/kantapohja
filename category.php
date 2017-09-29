<?php
use Valu\Kantapohja\Extras;

?>
	<div class="archive-wrapper facetwp-template">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'templates/content', 'archive' ); ?>
		<?php endwhile; ?>
		<?php if ( ! have_posts() ) : ?>
			<div class="alert alert-warning">
				<?php esc_html_e( 'Sorry, no results were found.', 'kantapohja' ); ?>
			</div>
		<?php endif; ?>
		<div class="row">
			<div class="col-xs-12 pagination-wrap">
				<?php
				Extras\pagination();
				?>
			</div>
		</div>
	</div>

<?php wp_reset_postdata();
