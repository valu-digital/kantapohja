<?php

use Valu\Kantapohja\Extras;

if ( ! class_exists( 'Some_Feed' ) ) {
	return;
}

$main_title = get_sub_field( 'main_title' );

$somefeed = new Some_Feed();
$somedata = get_transient( 'somedata_transient' );

if ( ! $somedata ) {
	$somedata = $somefeed->get_somefeed();
	set_transient( 'somedata_transient', $somedata, 600 );
}

$zone   = get_option( 'timezone_string' );
$format = sprintf( '%s %s', get_option( 'date_format' ), get_option( 'time_format' ) );

if ( $somedata ) : ?>
	<section class="some-feed main-lift">
		<div class="lift-title-row">
			<h2 class="lift-title black-text"><?php echo esc_html( $main_title ); ?></h2>
		</div>
		<div class="some-container">
			<div class="container-fluid">
				<div class="some-row flex">
					<?php foreach ( $somedata as $status ) : ?>
						<?php
						$classes = array( $status['site'] );

						if ( 'youtube' !== $status['site'] ) {
							$classes[] = $status['type'];
						}

						if ( ! isset( $status['thumbnail'] ) ) {
							$classes[] = 'eloaded';
						}
						?>
						<div class="element flex <?php echo esc_attr( join( ' ', $classes ) ); ?>" data-category="<?php echo esc_attr( $status['site'] ); ?>">
							<article class="hentry post flex">
								<?php if ( ! empty( $status['thumbnail'] ) ) : ?>
									<div class="entry-image">
										<a href="<?php echo esc_url( $status['link'] ); ?>" target="_blank">
											<?php
											$url    = ( isset( $status['thumbnail']['href'] ) && ! empty( $status['thumbnail']['href'] ) ) ? $status['thumbnail']['href'] : '';
											$width  = ( isset( $status['thumbnail']['width'] ) && ! empty( $status['thumbnail']['width'] ) ) ? $status['thumbnail']['width'] : '';
											$height = ( isset( $status['thumbnail']['height'] ) && ! empty( $status['thumbnail']['height'] ) ) ? $status['thumbnail']['height'] : '';
											?>
											<img src="<?php echo esc_url( $url ); ?>" width="<?php echo esc_attr( $width ); ?>" height="<?php echo esc_attr( $height ); ?>" class="img-responsive"/>
										</a>
									</div>
								<?php endif; ?>
								<div class="bottom flex">
									<div class="entry-content flex">
										<?php echo wp_kses_post( make_clickable( wpautop( esc_html( $status['caption'] ) ) ) ); ?>
									</div>
									<div class="entry-footer">
										<a href="<?php echo esc_url( $status['link'] ); ?>" target="_blank">
										<span class="some-icon <?php echo esc_attr( $status['site'] ); ?>">
											<i class="fa fa-<?php echo esc_attr( ( 'facebook' === $status['site'] ? $status['site'] . '-official' : $status['site'] ) ); ?>"></i>
										</span>
											<time class="updated"><?php echo esc_html( Extras\date_timezone( $format, $status['created_at'], $zone ) ); ?></time>
										</a>
									</div>
								</div>
							</article>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif;
