<?php
$events_background_image     = get_sub_field( 'events_background_image' );
$events_background_image_src = wp_get_attachment_image_src( $events_background_image, 'banner' );
$main_title                  = get_sub_field( 'main_title' );
$i                           = 0;
$maxitems                    = 10;

$titles = array(
	'Valokuvanäyttely',
	'Lounaskonsertti',
	'Koko perheen liikuntapäivä',
	'Opastettu kävelykierros museossa',
	'Kauppakeskuksen avajaiset',
	'Kuukauden elokuva',
	'Lasten liikuntaleiri',
	'Kävelykierros kansallispuistossa',
);
?>

<section class="events" data-stellar-background-ratio="0.3" style="background-image: url(<?php echo esc_url( $events_background_image_src[0] ); ?>);">
	<div class="events-background-color main-lift">
		<div class="events-container container-fluid">
			<?php if ( $main_title ) : ?>
				<div class="row lift-title-row">
					<div class="col-xs-12 col">
						<h2 class="lift-title"><?php echo esc_html( $main_title ); ?></h2>
					</div>
				</div>
			<?php endif; ?>
			<div class="row lift-content-row">
				<div class="col-xs-12 col">
					<?php foreach ( $titles as $title ) : ?>
						<?php if ( $i < 8 ) : ?>
							<div class="event-item col-xs-12 col-sm-6 col-md-3">
								<a class="clearfix" href="#" target="_blank">
									<div class="event-background">
										<div class="entry-content">
											<h2 class="entry-time">
												<?php
												$rand_days  = rand( 0, 10 );
												$rand_hours = rand( 0, 5 );
												$add_days   = strtotime( "+$rand_days Days" );
												$add_hours  = strtotime( "+$rand_hours Hours" );
												echo esc_html( date( 'd.m.Y', $add_days ) . ' Klo ' . date( 'h:00', $add_hours ) );
												?>
											</h2>
											<hr>
											<p class="entry-title"><?php echo esc_html( $title ); ?></p>
										</div>
									</div>
								</a>
							</div>
							<?php $i ++; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="row lift-footer-row">
				<div class="col-xs-12 col">
					<a class="btn btn-lift btn-green"
					   href="#"><?php esc_html_e( 'All events', 'kantapohja' );
						?></a>
				</div>
			</div>
		</div>
	</div>
</section>
