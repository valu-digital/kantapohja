<?php

$args = array( 'posts_per_page' => 1, 'post_type' => array( 'crisis_post' ) );

$crisis_query = new \WP_Query( $args );

if ( $crisis_query->have_posts() ) : ?>
	<div class="crisis-container">
		<div class="container-fluid">
			<?php while ( $crisis_query->have_posts() ) : ?>
				<?php $crisis_query->the_post(); ?>
				<div class="crisis row">
					<a class="col-xs-12" href="<?php the_permalink(); ?>">
						<div class="crisis_wrap col-xs-12 vertical">
							<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?php the_title(); ?>
						</div>
					</a>
				</div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
<?php endif;
