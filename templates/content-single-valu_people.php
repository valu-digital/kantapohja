<?php

use Valu\Kantapohja\Extras;

?>
<article <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="row">
			<div class="profile_img entry-img col-xs-12">
				<?php the_post_thumbnail( 'post-thumbnail-large' ); ?>
			</div>
		</div>
	<?php endif; ?>
	<h1><?php the_title(); ?></h1>
	<?php
	$current_language              = ( pll_current_language() === 'ru' ) ? 'en' : pll_current_language();
	$person_title                  = ( 'fi' === $current_language ) ? get_field_object( 'person_title' ) : get_field_object( sprintf( 'person_title_%s', $current_language ) );
	$person_phone_number           = get_field_object( 'person_phone_number' );
	$person_mobile_number          = get_field_object( 'person_mobile_number' );
	$person_email                  = get_field_object( 'person_email' );
	$person_responsibilities       = get_field_object( 'person_responsibilities' );
	$person_additional_information = get_field_object( 'person_additional_information' );
	$person_department_names       = Extras\get_department_names();
	?>
	<?php if ( $person_title['value'] ) : ?>
		<p class="<?php echo esc_html( $person_title['name'] ); ?>"><?php echo esc_html( $person_title['value'] ); ?></p>
	<?php endif; ?>

	<?php
	$valu_people_office = get_field( 'valu_people_office' );
	?>
	<?php if ( $valu_people_office ) : ?>
		<p><?php echo get_the_title( $valu_people_office ); ?></p>
	<?php endif; ?>

	<?php if ( $person_phone_number['value'] ) : ?>
		<p class="<?php echo esc_html( $person_phone_number['name'] ); ?>">
			<?php esc_html_e( 'Tel ', 'kantapohja' ); ?><?php echo esc_html( $person_phone_number['value'] ); ?>
		</p>
	<?php endif; ?>

	<?php if ( $person_mobile_number['value'] ) : ?>
		<p class="<?php echo esc_html( $person_mobile_number['name'] ); ?>">
			<?php esc_html_e( 'Tel ', 'kantapohja' ); ?><?php echo esc_html( $person_mobile_number['value'] ); ?>
		</p>
	<?php endif; ?>

	<?php if ( $person_email['value'] ) : ?>
		<p class="<?php echo esc_html( $person_email['name'] ); ?>"><?php echo esc_html( $person_email['value'] ); ?></p>
	<?php endif; ?>

	<?php if ( $person_department_names ) : ?>
		<span class="strong"><?php esc_html_e( 'Unit', 'kantapohja' ); ?>:</span>
		<span class="person-department">
						<?php echo esc_html( join( ', ', $person_department_names ) ); ?>
					</span>
	<?php endif; ?>

	<?php if ( $person_responsibilities['value'] ) : ?>
		<span class="strong"><?php esc_html_e( 'Responsibilities', 'kantapohja' ); ?>:</span>
		<p class="<?php echo esc_html( $person_responsibilities['name'] ); ?>"><?php echo wp_kses_post( $person_responsibilities['value'] ); ?></p>
	<?php endif; ?>

	<?php if ( $person_additional_information['value'] ) : ?>
		<p class="<?php echo esc_html( $person_additional_information['name'] ); ?>"><?php echo esc_html( $person_additional_information['value'] ); ?></p>
	<?php endif; ?>

	<?php
	$office_id     = get_field( 'valu_people_office' );
	$address       = get_field( 'office_street_address', $office_id );
	$postal_office = get_field( 'office_post_office', $office_id );
	?>
	<?php if ( $office_id ) : ?>
		<span class="strong"><?php esc_html_e( 'Office', 'kantapohja' ); ?>:</span>
		<span><?php echo get_the_title( $office_id ); ?></span>
	<?php endif; ?>
	<?php if ( $address ) : ?>
		<span><?php echo esc_html( $address ); ?></span>
	<?php endif; ?>
	<?php if ( $postal_office ) : ?>
		<span><?php echo esc_html( $postal_office ); ?></span>
	<?php endif; ?>

</article>
