<article <?php post_class(); ?>>
	<div class="archive-content-wrap clearfix container-fluid">
		<div class="row">
			<div class="archive-left col-sm-4">
				<?php get_template_part( 'templates/entry-meta' ); ?>
			</div>
			<div class="archive-right col-xs-12">
				<header>
					<h3 class="entry-title archive-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
				</header>
				<div class="archive-entry-content row">
					<div class="entry-summary col-xs-12">
						<?php if ( get_field( 'post_ingress' ) ) : ?>
							<?php the_field( 'post_ingress' ); ?>
						<?php else : ?>
							<?php the_excerpt(); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
