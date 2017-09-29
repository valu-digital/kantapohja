<?php

use Valu\Kantapohja\Setup;
use Valu\Kantapohja\Wrapper;

?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<?php get_template_part( 'templates/head' ); ?>
<body <?php body_class(); ?>>
<!--[if lt IE 9]>
<div class="alert alert-warning">
	<?php esc_html_e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
	your
	browser</a> to improve your experience.', 'kantapohja'); ?>
</div>
<![endif]-->
<?php
do_action( 'get_header' );
get_template_part( 'templates/header' );
get_template_part( 'partials/banner', 'default' );
get_template_part( 'partials/breadcrumb' );
?>
<div class="wrap container-fluid <?php echo( is_page_template( 'template-references.php' ) ? 'container-fluid-full' : '' ); ?>"
	 role="document">
	<div class="content row">
		<!-- /.main -->
		<?php if ( Setup\display_sidebar() ) : ?>
			<aside class="sidebar sidebar-secondary<?php echo( is_archive() || is_home() || is_page_template( 'template-dynasty-meetings.php' ) ? ' sidebar-archive' : '' ) ?>" role="complementary">
				<?php get_template_part( 'templates/sidebar' ); ?>
			</aside><!-- /.sidebar -->
		<?php endif; ?>
		<main class="main" role="main" id="content">
			<div class="page-content">
				<?php include Wrapper\template_path(); ?>
			</div>
		</main>
	</div>
	<!-- /.content -->
</div>
<!-- /.wrap -->
<?php
do_action( 'get_footer' );
get_template_part( 'templates/footer' );
wp_footer();
?>
</body>
</html>
