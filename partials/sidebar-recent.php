<?php

use Valu\Kantapohja\Taxonomies;

$sidebar_recent = get_template_param( 'sidebar_recent' );
if ( is_null( $sidebar_recent ) ) {
	$sidebar_recent = 5;
}

$category  = get_the_category();
$post_type = ( is_page() ? 'post' : get_post_type() );
$had_posts = false;

$services = Taxonomies\get_service_tree();

$news_args = array(
	'post_type'           => $post_type,
	'posts_per_page'      => $sidebar_recent,
	'post__not_in'        => array( get_the_ID() ),
	'ignore_sticky_posts' => 1,
	'tax_query'           => array(
		array(
			'taxonomy' => 'service',
			'field'    => 'slug',
			'terms'    => $services,
			'operator' => 'IN',
		),
	),
);

$args = $news_args;
if ( ! is_page() || is_single() || is_singular( 'blog_post' ) ) {
	$category_args = array( 'category__in' => array( $category[0]->cat_ID ) );
	if ( is_single() || is_singular( 'blog_post' ) ) {
		$news_args = array(
			'post_type'           => $post_type,
			'posts_per_page'      => $sidebar_recent,
			'post__not_in'        => array( get_the_ID() ),
			'ignore_sticky_posts' => 1,
		);
	}
	$args = wp_parse_args( $news_args, $category_args );
}

if ( is_page() ) {
	$args = $news_args;
}

$recent = new WP_Query( $news_args );
?>

<?php if ( $recent->have_posts() ) : ?>

	<?php $had_posts = true; ?>

	<section class="widget widget-recent" data-addsearch="include">
		<h3><?php esc_html_e( 'News', 'kantapohja' ); ?></h3>
		<div class="sidebar-news">

			<?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
				<div class="row news-row">
					<div class="col-xs-12 news-col date">
						<a href="<?php the_permalink(); ?>">
							<?php the_time( 'd.m.Y' ); ?>
						</a>
					</div>
					<div class="col-xs-12 news-col content">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</div>
				</div>
			<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>

			<?php if ( $had_posts && ! is_single() && ! is_singular( 'blog_post' ) ) : ?>
				<div class="more-posts">
					<?php
					$posts_archive_id   = get_option( 'page_for_posts' );
					$posts_archive_link = get_permalink( $posts_archive_id );
					$more_articles_msg  = __( 'More articles', 'kantapohja' );
					if ( is_single() ) {
						$more_articles_msg = __( 'Back to the list of articles', 'kantapohja' );
					}
					?>
					<a class="btn btn-block btn-lift btn-dark-text" href="<?php echo esc_url( $posts_archive_link ); ?>" title="<?php echo esc_html( $more_articles_msg ); ?>">
						<?php echo esc_html( $more_articles_msg ); ?>
					</a>
				</div>
			<?php endif; ?>

		</div>
	</section>

<?php endif;
