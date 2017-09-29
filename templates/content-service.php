<?php
use Valu\Kantapohja\Extras;

global $child_page_title, $child_page_link, $thumb_id, $external_link;
$parents    = get_post_ancestors( get_the_ID() );
$page_level = count( $parents );
?>
<?php if ( $page_level > 0 ) : ?>
	<h1><?php the_title(); ?></h1>
<?php endif; ?>
	<div class="service-content">
		<?php the_content(); ?>
	</div>
<?php if ( have_rows( 'tray_links' ) ) : ?>
	<div class="row">
		<?php while ( have_rows( 'tray_links' ) ) : the_row(); ?>
			<?php
			$linkchoice = get_sub_field( 'internal_or_external' );
			if ( 'internal' === $linkchoice ) :
				?>
				<?php
				$tray_page = get_sub_field( 'tray_page' ); ?>
				<?php if ( $tray_page ) : ?>
				<?php foreach ( $tray_page as $post ) : ?>
					<?php
					setup_postdata( $post );
					$params['lift']['thumb_id']         = Extras\get_thumbnail_id();
					$params['lift']['child_page_title'] = get_the_title();
					$params['lift']['child_page_link']  = get_the_permalink();
					$params['lift']['external_link']    = false;
					?>
					<?php get_template_part_extended( 'partials/content-service-lift', '', $params ); ?>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
			<?php elseif ( 'external' === $linkchoice ) : ?>
				<?php
				$params['lift']['thumb_id']         = get_sub_field( 'tray_ex_image' );
				$params['lift']['child_page_title'] = get_sub_field( 'tray_ex_text' );
				$params['lift']['child_page_link']  = get_sub_field( 'tray_ex_url' );
				$params['lift']['external_link']    = true;
				?>
				<?php get_template_part_extended( 'partials/content-service-lift', '', $params ); ?>
			<?php endif; ?>
		<?php endwhile; ?>
	</div>
<?php endif;
