<?php
if ( ! function_exists( 'get_field' ) || ! function_exists( 'get_field' ) ) {
	return false;
}
?>
<a class="skip-link screen-reader-text" href="#content" tabindex="1">
	<?php esc_html_e( 'Skip to content', 'kantapohja' ); ?>
</a>
<div class="nav-header mobile-header visible-xs visible-sm">
	<?php get_template_part( 'templates/header-mobile' ); ?>
</div>
<div class="nav-header desktop-header hidden-xs hidden-sm">
	<?php get_template_part( 'templates/header-desktop' ); ?>
</div>
