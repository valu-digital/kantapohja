<?php if ( is_archive() || is_home() || is_page_template( 'template-dynasty-meetings.php' ) ) : ?>
	<?php if ( ! is_post_type_archive( 'valu_people' ) ) : ?>
		<?php
		$categories = get_categories(
			array(
				'orderby' => 'term_id',
				'lang'    => pll_current_language(),
			)
		);
		if ( $categories ) : ?>
			<ul class="sidebar-nav">
				<?php foreach ( $categories as $category ) : ?>
					<li class="page_item">
						<a href="<?php echo esc_attr( get_category_link( $category->term_id ) ); ?>"
						   class="<?php echo esc_html( ( is_category( $category->term_id ) ? 'current_cat' : '' ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>

<?php if ( is_post_type_archive( 'valu_people' ) ) : ?>
	<div class="sidebar-facets">
		<section class="widget widget-valu_people-search">
			<h3 class="facet_header"><?php esc_html_e( 'Search', 'kantapohja' ); ?></h3>
			<?php echo facetwp_display( 'facet', 'valu_people_search' ); ?>
		</section>
		<section class="widget wiget-department">
			<h3 class="facet_header"><?php esc_html_e( 'Unit', 'kantapohja' ); ?></h3>
			<?php echo facetwp_display( 'facet', sprintf( 'department_%s', pll_current_language() ) ); ?>
		</section>
	</div>
<?php endif;
