<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class(); ?>>
		<header>
			<?php get_template_part( 'templates/entry-meta' ); ?>
		</header>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<hr/>
		<?php if ( function_exists( 'the_field' ) && get_field( 'post_ingress' ) ) : ?>
			<div class="entry-ingress">
				<?php the_field( 'post_ingress' ); ?>
			</div>
		<?php endif; ?>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-image">
				<?php the_post_thumbnail( 'post-thumbnail-large' ); ?>
			</div>
		<?php endif; ?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<footer>
			<?php wp_link_pages( [
				'before' => '<nav class="page-nav"><p>' . __( 'Pages:', 'kantapohja' ),
				'after'  => '</p></nav>',
			] ); ?>
		</footer>
	</article>
<?php endwhile;
