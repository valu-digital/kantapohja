<?php

namespace Valu\Kantapohja\Wrapper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme wrapper
 */

function template_path() {
	return Kantapohja_Wrapping::$main_template;
}

function sidebar_path() {
	return new Kantapohja_Wrapping( 'templates/sidebar.php' );
}

class Kantapohja_Wrapping {
	// Stores the full path to the main template file
	public static $main_template;

	// Basename of template file
	public $slug;

	// Array of templates
	public $templates;

	// Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	public static $base;

	public function __construct( $template = 'base.php' ) {
		$this->slug      = basename( $template, '.php' );
		$this->templates = [ $template ];

		if ( self::$base ) {
			$str = substr( $template, 0, - 4 );
			array_unshift( $this->templates, sprintf( $str . '-%s.php', self::$base ) );
		}
	}

	public function __toString() {
		$this->templates = apply_filters( 'kantapohja_wrap_' . $this->slug, $this->templates );

		return locate_template( $this->templates );
	}

	public static function wrap( $main ) {
		// Check for other filters returning null
		if ( ! is_string( $main ) ) {
			return $main;
		}

		self::$main_template = $main;
		self::$base          = basename( self::$main_template, '.php' );

		if ( 'index' === self::$base ) {
			self::$base = false;
		}

		return new Kantapohja_Wrapping();
	}
}

add_filter( 'template_include', [ __NAMESPACE__ . '\\Kantapohja_Wrapping', 'wrap' ], 109 );
