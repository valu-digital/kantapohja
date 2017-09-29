<?php

namespace Valu\Kantapohja\Customizer;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Valu\Kantapohja\Assets;

/**
 * Add postMessage support
 */
function customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
}

add_action( 'customize_register', __NAMESPACE__ . '\\customize_register' );

/**
 * Customizer JS
 */
function customize_preview_js() {
	wp_enqueue_script( 'kantapohja/customizer', Assets\asset_path( 'scripts/customizer.js' ), [ 'customize-preview' ], null,
	true );
}

add_action( 'customize_preview_init', __NAMESPACE__ . '\\customize_preview_js' );
