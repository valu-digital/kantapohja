<?php
$frontpage_id       = get_option( 'page_on_front' );
$most_popular_pages = get_field( 'most_popular_pages', $frontpage_id, false );
?>

<?php if ( $most_popular_pages ) : ?>
	<ul class="footer-nav most-popular">
		<?php foreach ( $most_popular_pages as $post ) : ?>
			<?php setup_postdata( $post ); ?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php endforeach; ?>
	</ul>
	<?php wp_reset_postdata(); ?>
<?php endif;
