<?php

use Valu\Kantapohja\Extras;

$parents    = get_post_ancestors( get_the_ID() );
$page_level = count( $parents );

$args     = array(
	'post_type'      => 'page',
	'post_status'    => 'publish',
	'post_parent'    => get_the_ID(),
	'orderby'        => 'menu_order',
	'order'          => 'asc',
	'posts_per_page' => - 1,
);
$children = new WP_Query( $args ); ?>
<?php if ( $page_level > 0 ) : ?>
	<h1><?php the_title(); ?></h1>
<?php endif; ?>
	<div class="service-content">
		<?php the_content(); ?>
	</div>
<?php if ( $children->have_posts() ) : ?>
	<div class="row">
		<?php while ( $children->have_posts() ) : $children->the_post(); ?>
			<?php
			$params['lift']['thumb_id']         = Extras\get_thumbnail_id();
			$params['lift']['child_page_title'] = get_the_title();
			$params['lift']['child_page_link']  = get_the_permalink();
			$params['lift']['external_link']    = false;
			?>
			<?php get_template_part_extended( 'partials/content-service-lift', '', $params ); ?>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</div>
<?php endif;
