<?php get_template_part( 'partials/mobilenav-secondary' ); ?>
<?php use Valu\Kantapohja\Titles; ?>
	<h1><?php echo esc_html( Titles\title() ); ?></h1>
<?php if ( function_exists( 'the_field' ) and get_field( 'post_ingress' ) ) : ?>
	<div class="page-ingress post-ingress">
		<?php the_field( 'post_ingress' ); ?>
	</div>
<?php endif; ?>
<?php the_content(); ?>
	<div class="contact-lift-container clearfix">
		<?php get_template_part( 'partials/person-card' ); ?>
	</div>
	<div class="contact-lift-container grouplift_container clearfix">
		<?php get_template_part( 'partials/group-card' ); ?>
	</div>
	<div class="office-lift-container clearfix">
		<?php get_template_part( 'partials/office-card' ); ?>
	</div>
	<div class="purchase-lift-container clearfix">
		<?php get_template_part( 'partials/purchase-card' ); ?>
	</div>
	<div class="clearer clearfix">&nbsp;</div>
<?php wp_link_pages( [ 'before' => '<nav class="page-nav"><p>' . __( 'Pages:', 'kantapohja' ), 'after' => '</p></nav>' ] );
