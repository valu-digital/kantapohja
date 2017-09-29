<div class="breadcrumb-container">
	<div class="container-fluid breadcrumb-fluid">
		<?php if ( function_exists( 'yoast_breadcrumb' ) && ! is_singular( 'reference' ) ) : ?>
			<?php yoast_breadcrumb( '<div class="breadcrumbs">', '</div>' ); ?>
		<?php endif; ?>
	</div>
</div>
