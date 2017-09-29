<?php

use Valu\Kantapohja\Wrapper;

?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<?php get_template_part( 'templates/head' ); ?>
<body <?php body_class(); ?>>
<!--[if lt IE 9]>
<div class="alert alert-warning">
	<?php esc_html_e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your
	browser</a> to improve your experience.', 'kantapohja'); ?>
</div>
<![endif]-->
<?php
do_action( 'get_header' );
get_template_part( 'templates/header' );
?>
<div class="wrap" role="document">
	<?php include Wrapper\template_path(); ?>
</div><!-- /.wrap -->
<?php
do_action( 'get_footer' );
get_template_part( 'templates/footer' );
wp_footer();
?>
</body>
</html>
