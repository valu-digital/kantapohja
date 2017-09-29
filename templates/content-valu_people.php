<?php

use Valu\Kantapohja\Extras;

?>
<article <?php post_class( 'col-md-6 col-lg-3' ); ?>>
	<div class="shadow-box">
		<div class="entry-content">
			<a href="<?php the_permalink(); ?>">
				<h3><?php the_title(); ?></h3>
			</a>
			<?php
			$current_language        = pll_current_language();
			$person_title            = ( 'fi' === $current_language ) ? get_field_object( 'person_title' ) : get_field_object( 'person_title_' . $current_language );
			$person_phone_number     = get_field_object( 'person_phone_number' );
			$person_mobile_number    = get_field_object( 'person_mobile_number' );
			$person_email            = get_field_object( 'person_email' );
			$person_company          = get_field_object( 'person_company' );
			$person_department       = get_field_object( 'person_department' );
			$person_visit_address    = get_field_object( 'person_visit_address' );
			$person_department_names = Extras\get_department_names();

			?>
			<?php if ( $person_title['value'] ) : ?>
				<span class="<?php echo esc_attr( $person_title['name'] ); ?>"><?php echo esc_html( $person_title['value'] ); ?></span>
			<?php endif; ?>

			<?php if ( $person_phone_number['value'] ) : ?>
				<span class="<?php echo esc_attr( $person_phone_number['name'] ); ?>"><?php esc_html_e( 'Tel ', 'kantapohja' ); ?><?php echo esc_html( $person_phone_number['value'] ); ?></span>
			<?php endif; ?>

			<?php if ( $person_mobile_number['value'] ) : ?>
				<span class="<?php echo esc_attr( $person_mobile_number['name'] ); ?>"><?php esc_html_e( 'Tel ', 'kantapohja' ); ?><?php echo esc_html( $person_mobile_number['value'] ); ?></span>
			<?php endif; ?>

			<?php if ( $person_email['value'] ) : ?>
				<span class="<?php echo esc_attr( $person_email['name'] ); ?>"><?php echo esc_html( $person_email['value'] ); ?></span>
			<?php endif; ?>

			<?php
			$office_id     = get_field( 'valu_people_office' );
			$address       = get_field( 'office_street_address', $office_id );
			$postal_office = get_field( 'office_post_office', $office_id );
			?>

			<?php if ( $office_id or $address or $postal_office or $person_department_names ) : ?>
				<a class="show_person blue btn">+ <?php esc_html_e( 'Show all information', 'kantapohja' ); ?></a>
			<?php endif; ?>

			<div class="office_information additional_content">

				<?php if ( $person_department_names ) : ?>
					<span class="strong"><?php esc_html_e( 'Unit', 'kantapohja' ); ?>:</span>
					<span class="person-department">
						<?php echo esc_html( join( ', ', $person_department_names ) ); ?>
					</span>
				<?php endif; ?>

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
			</div>

		</div>
	</div>
</article>
