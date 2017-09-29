<?php
/**
 * Kantapohja includes
 *
 * The $kantapohja_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 */
$kantapohja_includes = [
	'lib/dependencies.php', // Dependencies
	'lib/assets.php',    // Scripts and stylesheets
	'lib/extras.php',    // Custom functions
	'lib/setup.php',     // Theme setup
	'lib/titles.php',    // Page titles
	'lib/wrapper.php',   // Theme wrapper class
	'lib/customizer.php', // Theme customizer
	'lib/taxonomies.php', // Custom taxonomies
	'lib/gallery.php',
	'lib/wp-bootstrap-nav-walker.php',
	'lib/wp-bootstrap-sidebar-walker.php',
];

foreach ( $kantapohja_includes as $file ) {
	if ( ! $filepath = locate_template( $file ) ) {
		trigger_error( sprintf( esc_html__( 'Error locating %s for inclusion', 'kantapohja' ), esc_html( $file ) ), E_USER_ERROR );
	}

	require_once $filepath;
}
unset( $file, $filepath );

/**
 * Encode email in ACF fields, requires email address encoder plugin
 */
if ( function_exists( 'eae_encode_emails' ) ) {
	add_filter( 'acf/load_value', 'eae_encode_emails' );
}

/**
 * Load a template part into a template
 *
 * @param string $slug The slug name for the generic template.
 * @param string $name The name of the specialised template.
 * @param array $params Any extra params to be passed to the template part.
 */
function get_template_part_extended( $slug, $name = null, $params = array() ) {

	/**
	 * Fires before the specified template part file is loaded.
	 *
	 * The dynamic portion of the hook name, `$slug`, refers to the slug name
	 * for the generic template part.
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string|null $name The name of the specialized template.
	 */
	do_action( "get_template_part_extended_{$slug}", $slug, $name );

	$templates = array();
	$name      = (string) $name;

	if ( '' !== $name ) {
		$templates[] = "{$slug}-{$name}.php";
	}

	$templates[] = "{$slug}.php";

	$GLOBALS['valu_template_params'] = $params;

	locate_template( $templates, true, false );

}

/**
 * Get template params.
 *
 * @return mixed
 */
function get_template_params() {
	return $GLOBALS['valu_template_params'];
}

/**
 * Get single template param.
 *
 * @param $template_param
 *
 * @return bool
 */
function get_template_param( $template_param ) {
	if ( isset( $GLOBALS['valu_template_params'][ $template_param ] ) ) {
		return $GLOBALS['valu_template_params'][ $template_param ];
	}

	return false;
}
