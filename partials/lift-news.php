<?php

use Valu\Kantapohja\Assets;

$newslift_newsnumber = get_sub_field( 'newslift_newsnumber' );
?>
<section class="article-list main-lift lift container-fluid">
	<div class="row article-list-container">

		<div class="col-xs-12 col-md-4 articles news">
			<img class="news-logo svg-icon" src="<?php echo esc_url( Assets\asset_path( 'images/icons/icon_newspaper.svg' ) ); ?>"/>
			<h2 class="news"><?php esc_html_e( 'Press releases', 'kantapohja' ); ?></h2>


			<?php
			$args      = array(
				'post_type'      => array( 'post' ),
				'posts_per_page' => $newslift_newsnumber,
				'category_name'  => 'tiedotteet,press-releases',
			);
			$the_query = new \WP_Query( $args );
			?>

			<?php if ( $the_query->have_posts() ) : ?>
				<div class="article-list-articles">
					<?php while ( $the_query->have_posts() ) : ?>
						<?php $the_query->the_post(); ?>
						<div class="row article-list-row" data-mh="articlelistgroup">
							<div class="col-xs-12 cell">
								<time class="updated" datetime="<?php echo esc_html( get_post_time( 'c', true ) ); ?>">
									<?php the_time( get_option( 'date_format' ) ); ?>
								</time>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</div>
						</div>
					<?php endwhile; ?>
				</div>

				<?php
				$cat_name = 'tiedotteet';
				if ( function_exists( 'pll_current_language' ) ) {
					if ( 'en' === pll_current_language() ) {
						$cat_name = 'press-releases';
					}
				}
				$category = get_category_by_slug( $cat_name );
				$cat_link = get_category_link( $category->term_id )
				?>
				<a class="btn btn-lift btn-dark-text" href="<?php echo esc_url( $cat_link ); ?>"><?php esc_html_e( 'See all', 'kantapohja' ); ?></a>
				<?php wp_reset_postdata(); ?>

			<?php endif; ?>


		</div>

		<div class="col-xs-12 col-md-4 articles bulletins">
			<img class="news-logo svg-icon" src="<?php echo esc_url( Assets\asset_path( 'images/icons/icon_bulletin.svg' ) ); ?>"/>
			<h2 class="news"><?php esc_html_e( 'Bulletin board', 'kantapohja' ); ?></h2>

			<?php
			$args      = array(
				'post_type'      => array( 'post' ),
				'posts_per_page' => $newslift_newsnumber,
				'category_name'  => 'ilmoitukset,announcements',
			);
			$the_query = new \WP_Query( $args );
			?>

			<?php if ( $the_query->have_posts() ) : ?>
				<div class="article-list-articles">
					<?php while ( $the_query->have_posts() ) : ?>
						<?php $the_query->the_post(); ?>
						<div class="row article-list-row" data-mh="articlelistgroup">
							<div class="col-xs-12 cell">
								<time class="updated" datetime="<?php echo esc_html( get_post_time( 'c', true ) ); ?>">
									<?php the_time( get_option( 'date_format' ) ); ?>
								</time>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</div>
						</div>
					<?php endwhile; ?>
				</div>

				<a class="btn btn-lift btn-dark-text" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">
					<?php esc_html_e( 'See all', 'kantapohja' ); ?>
				</a>

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>


		</div>

		<div class="col-xs-12 col-md-4 articles vacancies">
			<img class="news-logo svg-icon" src="<?php echo esc_url( Assets\asset_path( 'images/icons/icon_human.svg' ) ); ?>"/>
			<h2 class="news"><?php esc_html_e( 'Vacancies', 'kantapohja' ); ?></h2>

			<?php
			$lang = 'fi';
			if ( function_exists( pll_current_language() ) ) {
				$lang = pll_current_language();
			}
			if ( 'fi' !== $lang || 'sv' !== 'lang' ) {
				// no support for other languages than fi or sv in kuntarekry
				$lang = 'fi';
			}

			//$feed_address = 'https://www.kuntarekry.fi/' . $lang . '/job-search-rss?query=&field_job_location[0]=533&field_publication_time_value=All&search_api_language[0]=' . $lang . '&sort_by=search_api_relevance&items_per_page=20';
			$feed_address = 'https://www.kuntarekry.fi/fi/job-search-rss?query=&field_publication_time_value=All&search_api_language[0]=' . $lang . '&sort_by=search_api_relevance&items_per_page=20';
			$rss          = fetch_feed( $feed_address );

			$maxitems = 10;

			if ( ! is_wp_error( $rss ) ) :
				$maxitems  = $rss->get_item_quantity( $newslift_newsnumber );
				$rss_items = $rss->get_items( 0, $maxitems );
			endif;
			?>

			<?php if ( $rss_items ) : ?>
				<div class="article-list-articles">
					<?php foreach ( $rss_items as $item ) : ?>
						<div class="row article-list-row" data-mh="articlelistgroup">
							<div class="col-xs-12 col-sm-9 cell">
								<time class="job-published" datetime="<?php esc_html( get_post_time( 'c', true ) ); ?>"><?php echo esc_html( $item->get_date( 'd.m.Y' ) ); ?></time>
								<a href="<?php echo esc_url( $item->get_permalink() ); ?>" title="<?php printf( esc_html( __( 'Posted %s', 'kantapohja' ) ), esc_html( $item->get_date( 'd.m.Y | G:i' ) ) ); ?>">
									<?php echo esc_html( $item->get_title() ); ?>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<a class="btn btn-lift btn-dark-text"
				   href="https://www.kuntarekry.fi/fi/job-search?query=&field_job_location%5B%5D=533&sort_by=search_api_relevance&items_per_page=20&field_publication_time_value=All&search_api_language%5B%5D=fi&search_api_language%5B%5D=<?php echo esc_attr( $lang ); ?>">
					<?php esc_html_e( 'See all', 'kantapohja' ); ?>
				</a>

			<?php endif; ?>

			<?php wp_reset_postdata(); ?>

		</div>
	</div>
</section>
