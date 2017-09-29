<?php

use Valu\Kantapohja\Titles;

global $post;
$image_size = get_template_param( 'image_size' );
$page_level = 0;
$parent_id  = '';

if ( is_page() ) {
	$parents      = get_post_ancestors( $post->ID );
	$page_level   = count( $parents );
	$parents_keys = array_keys( $parents );
	$parents_last = end( $parents_keys );
	if ( $parents_last ) {
		$parent_id = $parents[ $parents_last ];
	} else {
		// is parent
		$parent_id = get_the_ID();
	}
	$section_title = empty( $parents ) ? get_the_title( $post->ID ) : get_the_title( $parents[ $parents_last ] );
} elseif ( is_singular( 'post' ) || is_home() ) {
	$parent_id     = get_option( 'page_for_posts' );
	$section_title = get_the_title( $parent_id );
} elseif ( is_singular( array( 'valu_people', 'office', 'purchase' ) ) ) {
	$parent_id     = get_option( 'page_for_posts' );
	$post_type     = get_post_type_object( get_post_type( $post ) );
	$section_title = $post_type->label;
} elseif ( is_archive() ) {
	$parent_id     = get_option( 'page_for_posts' );
	$section_title = get_the_archive_title();
} else {
	$section_title = Titles\title();
}

$thumb_id = get_post_thumbnail_id( $parent_id );

// Get parent thumb if no thumb and is page
if ( ! $thumb_id && is_page() ) {
	$parents      = get_post_ancestors( $post->ID );
	$parents_keys = array_keys( $parents );
	$parents_last = end( $parents_keys );
	$parent_id    = ( $parents ) ? $parents[ $parents_last ] : $post->ID;
	$thumb_id     = get_post_thumbnail_id( $parent_id );
	if ( $parents && get_post_thumbnail_id() ) {
		$thumb_id = get_post_thumbnail_id();
	}
} elseif ( $thumb_id && is_page() ) {
	// Has thumb, use that!
	$thumb_id = get_post_thumbnail_id();
}

if ( is_archive() || is_post_type_archive() || is_singular( 'post' ) || is_home() ) {
	if ( is_archive() || is_singular( 'post' ) || is_home() ) {
		$thumb_id = get_field( 'news_bg', 'option' );
	}
}
if ( is_post_type_archive( 'blog_post' ) || is_singular( 'blog_post' ) ) {
	$thumb_id = get_field( 'blog_bg', 'option' );
}
if ( is_post_type_archive( 'valu_people' ) || is_singular( 'valu_people' ) ) {
	$thumb_id = get_field( 'contacts_bg', 'option' );
}

// Still no thumb id, even from parents
if ( ! $thumb_id ) {
	$thumb_id = get_field( 'default_bg', 'option' );
}

// Set default image size
if ( ! $image_size ) {
	$image_size = 'content-banner';
}

if ( is_singular( 'reference' ) ) {
	$finnish_page   = get_page_by_path( '/referenssit/' );
	$translation_id = pll_get_post( $finnish_page->ID );
	if ( $translation_id ) {
		$section_title = get_the_title( $translation_id );
		$thumb_id      = get_post_thumbnail_id( $translation_id );
	}
}

$thumb_url = wp_get_attachment_image_src( $thumb_id, $image_size );
$bgimg     = esc_url( $thumb_url[0] );
?>

<div class="banner-service">
	<div class="banner-image" style="background-image: url('<?php echo esc_attr( $bgimg ); ?>')">
		<div class="banner-overlay">
			<div class="container-fluid container-section-title">
				<div class="row banner-row">
					<div class="col-xs-12">
						<?php if ( $page_level > 0 || is_single() || is_page_template( 'template-service.php' ) || is_singular( array( 'valu_people', 'office' ) ) ) : ?>
							<h2 class="section-title"><?php echo esc_html( isset( $section_title ) ? $section_title : post_type_archive_title() ); ?></h2>
						<?php else : ?>
							<h1 class="section-title"><?php echo esc_html( isset( $section_title ) ? $section_title : post_type_archive_title() ); ?></h1>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
