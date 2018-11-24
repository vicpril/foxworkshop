<?php
/**
 *
 * Search form.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
?>
<div class="widget-search">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<div class="input-group">
			<input type="text" placeholder="<?php esc_html_e( 'Search', 'maison' ); ?>" name="s" class="form-control"/>
			<span class="input-group-btn"> <button type="submit" class="btn btn-white"><i class="ion-android-search"></i></button> </span>
			<input type="hidden" name="post_type" value="post" class="post_type" />
		</div>
	</form>
</div>