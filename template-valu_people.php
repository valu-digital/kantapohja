<?php
/**
 * Template Name: Yhteystiedot
 */
?>

	<div class="facets valu_people_facets">
		<?php echo facetwp_display( 'facet', 'valu_people_alphabet' ); ?>
	</div>

	<div class="valu_people-archive clearfix">
		<?php echo facetwp_display( 'template', 'valu_people' ); ?>
	</div>

<?php echo facetwp_display( 'pager' );
