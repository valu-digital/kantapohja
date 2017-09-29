<div class="sidebar-content">
	<?php

	$sidebar_recent = get_field( 'sidebar_recent_articles' );

	if ( $sidebar_recent > 0 || is_single() && ! is_singular( 'valu_people' ) ) {
		get_template_part_extended( 'partials/sidebar', 'recent', array( 'sidebar_recent' => $sidebar_recent ) );
	}

	if ( have_rows( 'sidebar_content' ) ) :

		while ( have_rows( 'sidebar_content' ) ) : the_row();

			$layout       = get_row_layout();
			$layout_class = preg_replace( '/_/', '-', $layout );
			?>

			<?php if ( 'sidebar_attachments' === $layout ) : ?>

				<?php if ( have_rows( 'sidebar_attachments_content' ) ) : ?>
					<section class="widget widget-attachments" data-addsearch="include">
						<h3><?php esc_html_e( 'Attachments', 'kantapohja' ); ?></h3>
						<div class="widget-content">
							<?php while ( have_rows( 'sidebar_attachments_content' ) ) : the_row();
								$attachments = get_sub_field( 'attachment' );
								?>
								<?php foreach ( $attachments as $attachment ) : ?>
									<div class="attachment link-container">
										<i class="fa fa-angle-right" aria-hidden="true"></i><a
												href="<?php echo esc_url( $attachment->guid ); ?>"
												target="_blank"><?php echo esc_html( $attachment->post_title ); ?></a>
									</div>
								<?php endforeach; ?>
							<?php endwhile; ?>
						</div>
					</section>
				<?php endif; ?>

			<?php elseif ( 'person_lifts_layout' === $layout ) : ?>

				<section class="widget <?php echo esc_attr( $layout_class ); ?>" data-addsearch="include">
					<h3><?php esc_html_e( 'Contact us', 'kantapohja' ); ?></h3>

					<div class="widget-content">
						<?php
						$contacts = get_sub_field( 'sidebar_select_contacts' );

						if ( $contacts ) : ?>
							<?php foreach ( $contacts as $post ) : ?>
								<?php setup_postdata( $post ); ?>
								<?php get_template_part( 'partials/person-card-single' ); ?>
							<?php endforeach; ?>
							<?php wp_reset_postdata(); ?>
						<?php endif; ?>
					</div>
				</section>

			<?php elseif ( 'sidebar_shortcut_links' === $layout ) : ?>

				<section class="widget <?php echo esc_attr( $layout_class ); ?>" data-addsearch="include">
					<h3><?php the_sub_field( 'sidebar_shortcut_links_title' ); ?></h3>
					<div class="widget-content"><?php get_template_part( 'partials/sidebar-shortcut-links' ); ?></div>
				</section>

			<?php elseif ( 'banner_lift' === $layout ) : ?>

				<section class="widget <?php echo esc_attr( $layout_class ); ?>" data-addsearch="include">
					<?php get_template_part( 'partials/sidebar-banner-lift' ); ?>
				</section>

				<?php // "vapaa nosto" ?>
			<?php elseif ( 'sidebar_lift' === $layout ) : ?>

				<section class="widget <?php echo esc_attr( $layout_class ); ?>" data-addsearch="include">
					<h3><?php the_sub_field( 'sidebar_lift_title' ); ?></h3>

					<div class="widget-content"><?php the_sub_field( 'sidebar_lift_content' ); ?></div>
				</section>

			<?php elseif ( 'sidebar_contacts' === $layout ) : ?>

				<section class="widget <?php echo esc_attr( $layout_class ); ?>" data-addsearch="include">
					<h3><?php esc_html_e( 'Contact us', 'kantapohja' ); ?></h3>
					<div class="widget-content">
						<?php
						$sidebar_contact_persons = get_sub_field( 'sidebar_contact_persons', false );
						if ( $sidebar_contact_persons ) : ?>
							<ul>
								<?php foreach ( $sidebar_contact_persons as $post_id ) : ?>
									<?php $post = get_post( $post_id );
									setup_postdata( $post );
									$current_language = pll_current_language();
									$person_title     = ( 'fi' === $current_language ) ? get_field( 'person_title' ) : get_field( sprintf( 'person_title_%s', $current_language ) );
									$terms            = get_the_terms( get_the_ID(), sprintf( 'department_%s', $current_language ) );
									?>
									<li>
										<strong><?php the_title(); ?></strong>

										<p>
											<?php if ( $person_title ) : ?>
												<em><?php echo esc_html( $person_title ); ?></em><br/>
											<?php endif; ?>
											<?php if ( ! is_wp_error( $terms ) and is_array( $terms ) ) :

												$terms_array = array(); ?>
												<?php foreach ( $terms as $term ) : ?>
												<?php $terms_array[] = esc_html( $term->name ); ?>
											<?php endforeach; ?>
												<?php if ( $terms_array ) : natsort( $terms_array ); ?>
												<em class="person-department">
													<?php echo esc_html( join( ', ', $terms_array ) ); ?>
												</em><br/>
											<?php endif; ?>
											<?php endif; ?>
											<?php if ( get_field( 'person_phone_number' ) ) : ?>
												<em><?php the_field( 'person_phone_number' ); ?></em><br/>
											<?php endif; ?>
											<?php if ( get_field( 'person_mobile_number' ) ) : ?>
												<em><?php the_field( 'person_mobile_number' ); ?></em><br/>
											<?php endif; ?>
											<?php if ( get_field( 'person_email' ) ) : ?>
												<em><?php the_field( 'person_email' ); ?></em><br/>
											<?php endif; ?>

											<?php if ( strlen( get_field( 'person_visit_address' ) ) > 5 ) : ?>
												<span><?php the_field( 'person_visit_address' ); ?></span>
											<?php endif; ?>

										</p>
									</li>
								<?php endforeach; ?>
							</ul>
							<?php wp_reset_postdata(); ?>
						<?php endif; ?>
					</div>
				</section>

			<?php elseif ( 'sidebar_facebook_feed' === $layout ) : ?>

				<section class="widget <?php echo esc_attr( $layout_class ); ?>" data-addsearch="include">
					<h3><?php esc_html_e( 'Facebook', 'kantapohja' ); ?></h3>

					<div id="fb-root"></div>
					<script>(function (d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s);
                            js.id = id;
                            js.src = "//connect.facebook.net/fi_FI/sdk.js#xfbml=1&version=v2.5";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));
					</script>

					<div class="widget-content">
						<div class="fb-page" data-href="<?php echo esc_url( get_sub_field( 'sidebar_facebook_feed_url' ) ); ?>" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false" data-show-posts="true">
							<div class="fb-xfbml-parse-ignore">
								<blockquote cite="<?php echo esc_url( get_sub_field( 'sidebar_facebook_feed_url' ) ); ?>">
									<a href="<?php echo esc_url( get_sub_field( 'sidebar_facebook_feed_url' ) ); ?>">Facebook</a>
								</blockquote>
							</div>
						</div>
					</div>
				</section>

			<?php endif;

		endwhile;

	endif;

	?>
</div>
