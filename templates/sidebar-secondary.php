<?php
global $post;

$ancestors = get_post_ancestors( get_the_ID() );

$post_parent_id = ( $ancestors ) ? end( $ancestors ) : get_the_ID();
$args           = [
	'title_li'    => '',
	'sort_column' => 'menu_order',
	'order'       => 'asc',
	'child_of'    => $post_parent_id,
	'walker'      => new WP_Bootstrap_Sidebar_Walker(),
];
?>

<ul class="hidden-xs sidebar-nav" id="accordion">
	<?php wp_list_pages( $args ); ?>
</ul>
