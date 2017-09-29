<?php while ( have_posts() ) : the_post(); ?>
	<?php
	$event_start_time     = get_field( 'event_start_time' );
	$event_end_time       = get_field( 'event_end_time' );
	$event_street_address = get_field( 'event_street_address' );
	$event_postalcode     = get_field( 'event_postalcode' );
	$event_postoffice     = get_field( 'event_postoffice' );
	$event_contact_name   = get_field( 'event_contact_name' );
	$event_contact_phone  = get_field( 'event_contact_phone' );
	$event_email          = get_field( 'event_email' );
	$event_url            = get_field( 'event_url' );
	?>
	<section class="reference-article">
		<div class="container-fluid container-fluid-small">
			<article <?php post_class(); ?>>
				<div class="row">
					<div class="col-xs-12">
						<div class="clearfix">
							<h1 class="entry-title"><?php the_title(); ?></h1>
							<a href="<?php echo esc_url( get_post_type_archive_link( 'event' ) ); ?>"
							   class="btn btn-info btn-lift btn-transparent reference-btn"><?php esc_html_e( 'Back to the listing', 'kantapohja' ); ?></a>
						</div>
					</div>
				</div>
				<div class="row content-row">
					<div class="col-xs-12 col-md-4 reference-stats">
						<p class="project-header"><?php esc_attr_e( 'Event time', 'kantapohja' ); ?>:</p>
						<span class="project-text">
								<time class="project-text event-date<?php echo esc_attr( date( 'dm', strtotime( $event_start_time ) ) !== date( 'dm', strtotime( $event_end_time ) ) ? ' multidate' : '' ); ?>" datetime="<?php echo esc_attr( $event_start_time ); ?>">
								<?php echo esc_attr( ( date( 'dm', strtotime( $event_start_time ) ) !== date( 'dm', strtotime( $event_end_time ) ) ? date( 'd.m.Y', strtotime( $event_start_time ) ) . ' &ndash; ' . date( 'd.m.Y', strtotime( $event_end_time ) ) : date( 'd.m.Y', strtotime( $event_start_time ) ) ) ); ?>
								</time>
							</span>
						<hr/>
						<?php if ( $event_street_address ) : ?>
							<p class="project-header"><?php esc_attr_e( 'Event address', 'kantapohja' ); ?>:</p>
							<span class="project-text">
								<?php echo esc_html( $event_street_address ); ?>
								<?php echo esc_html( $event_postalcode . ' ' . $event_postoffice ); ?>
							</span>
							<hr/>
						<?php endif; ?>
						<?php if ( $event_contact_name ) : ?>
							<p class="project-header"><?php esc_attr_e( 'Event contact person', 'kantapohja' ); ?>:</p>
							<span class="project-text"><?php echo esc_html( $event_contact_name ); ?></span>
							<span class="project-text"><?php echo esc_html( $event_contact_phone ); ?></span>
							<hr/>
						<?php endif; ?>
						<?php if ( $event_email || $event_url ) : ?>
							<p class="project-header"><?php esc_attr_e( 'Event information', 'kantapohja' ); ?>:</p>
							<span class="project-text"><?php echo esc_html( $event_email ); ?>	</span>
							<span class="project-text"><a
										href="<?php echo esc_url( $event_url ); ?>"><?php echo esc_html( $event_url ); ?></a></span>
							<hr/>
						<?php endif; ?>
					</div>
					<div class="col-xs-12 col-md-8 reference-content">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="entry-image">
								<?php the_post_thumbnail( 'post-thumbnail-large' ); ?>
							</div>
						<?php endif; ?>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</article>
		</div>
	</section>
	<?php get_template_part( 'partials/page-content-flexible' ); ?>
<?php endwhile;
