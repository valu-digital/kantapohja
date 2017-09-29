<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="sr-only"><?php esc_html_e( 'Search for:', 'kantapohja' ); ?></label>
	<div class="input-group">
		<input type="search" tabindex="1" value="<?php echo get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php esc_html_e( 'Search site', 'kantapohja' ); ?>" required>
		<span class="input-group-btn">
			<button type="submit" class="search-submit btn">
				<span class="glyphicon glyphicon-search" aria-hidden="true" data-toggle="collapse" data-target=".search-form-collapse" type="button">
				</span>
			</button>
		</span>
	</div>
</form>
