<?php
$lang             = pll_current_language();
$department       = 'department_' . $lang;
$department_terms = get_the_terms( get_the_ID(), $department );
$services         = get_the_terms( get_the_ID(), 'service' );
?>
<div class="person-card clearfix col-xs-12 col-sm-6">
	<div class="row">
		<div class="entry-content col-xs-12">
			<a href="<?php the_permalink(); ?>">
				<p class="person-name"><?php echo get_the_title(); ?></p>
				<?php if ( get_field( 'person_title' ) ) : ?>
					<p class="person-title">
						<?php echo esc_html( get_field( 'person_title' ) ); ?><?php if ( ! is_wp_error( $department_terms ) and is_array( $department_terms ) ) : $department_terms_array = array(); ?><?php echo ','; ?>
							<?php foreach ( $department_terms as $term ) : ?>
								<?php $department_terms_array[] = esc_html( $term->name ); ?>
							<?php endforeach; ?>
							<?php if ( $department_terms_array ) : natsort( $department_terms_array ); ?>
								<span class="person-department">
									<?php echo esc_html( strtolower( join( ', ', $department_terms_array ) ) ); ?>
								</span>
							<?php endif; ?>
						<?php endif; ?>
					</p>
				<?php endif; ?>
				<?php if ( ! is_wp_error( $services ) and is_array( $services ) ) : $services_array = array(); ?>
					<?php foreach ( $services as $term ) : ?>
						<?php $services_array[] = esc_html( $term->name ); ?>
					<?php endforeach; ?>
					<?php if ( $services_array ) : natsort( $services_array ); ?>
						<p class="person-service">
							<?php echo esc_html( join( ', ', $services_array ) ); ?>
						</p>
					<?php endif; ?>
				<?php endif; ?>
				<?php
				$valu_people_office = get_field( 'valu_people_office' );
				?>
				<?php if ( $valu_people_office ) : ?>
					<p><?php echo get_the_title( $valu_people_office ); ?></p>
				<?php endif; ?>
				<?php if ( get_field( 'person_phone_number' ) ) : ?>
					<p class="person-phone"><?php echo esc_html( get_field( 'person_phone_number' ) ); ?></p>
				<?php endif; ?>
				<?php if ( get_field( 'person_mobile_number' ) ) : ?>
					<p class="person-mobile"><?php echo esc_html( get_field( 'person_mobile_number' ) ); ?></p>
				<?php endif; ?>
				<?php if ( get_field( 'person_email' ) ) : ?>
					<p class="person-email"><?php echo esc_html( get_field( 'person_email' ) ); ?></p>
				<?php endif; ?>
			</a>
		</div>
	</div>
</div>
