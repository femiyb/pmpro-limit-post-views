<?php
/**
 * Paid Memberships Pro - Limit Post Views Settings Page
 *
 * Displays settings page.
 *
 * @since 0.3.0
 * @package PMPro_Limit_Post_Views
 */

// Check permissions first.
if ( ! current_user_can( apply_filters( 'pmpro_edit_member_capability', 'manage_options' ) ) ) {
	wp_die( 'You do not have sufficient permissions to access this page.' );
}

require_once( PMPRO_DIR . '/adminpages/admin_header.php' );

/**
 * Display membership limits section.
 *
 * @since 0.3.0
 */
function pmprolpv_settings_section_limits() {
	echo '<p>' . esc_html( __( 'Allow visitors or members limited access to view posts they do not already have access to view.', 'pmpro-limit-post-views' ) ) . '</p>';
}

/**
 * Display membership limits field.
 *
 * @since 0.3.0
 */
function pmprolpv_settings_field_limits( $level_id ) {
	$limit = get_option( 'pmprolpv_limit_' . $level_id );
	?>
	<input size="2" type="text" id="level_<?php echo esc_attr( $level_id ); ?>_views"
	       name="pmprolpv_limit_<?php echo esc_attr( $level_id ); ?>[views]" value="<?php echo esc_attr( $limit['views'] ); ?>">
	<?php esc_html_e( ' views per ', 'pmpro-limit-post-views' ); ?>
	<select name="pmprolpv_limit_<?php echo esc_attr( $level_id ); ?>[period]" id="level_<?php echo esc_attr( $level_id ); ?>_period">
		<option
			value="hour" <?php selected( $limit['period'], 'hour' ); ?>><?php esc_html_e( 'Hour', 'pmpro-limit-post-views' ); ?></option>
		<option
			value="day" <?php selected( $limit['period'], 'day' ); ?>><?php esc_html_e( 'Day', 'pmpro-limit-post-views' ); ?></option>
		<option
			value="week" <?php selected( $limit['period'], 'week' ); ?>><?php esc_html_e( 'Week', 'pmpro-limit-post-views' ); ?></option>
		<option
			value="month" <?php selected( $limit['period'], 'month' ); ?>><?php esc_html_e( 'Month', 'pmpro-limit-post-views' ); ?></option>
	</select>
	<?php
}

/**
 * Display redirection section.
 *
 * @since 0.3.0
 */
function pmprolpv_settings_section_redirection() {
}

/**
 * Display redirection field.
 *
 * @since 0.3.0
 */
function pmprolpv_settings_field_redirect_page() {
	global $pmpro_pages;
	$page_id = get_option( 'pmprolpv_redirect_page' );

	// Default to Levels page.
	if ( empty( $page_id ) ) {
		$page_id = $pmpro_pages['levels'];
	}

	wp_dropdown_pages( array(
		'selected' => $page_id,
		'name' => 'pmprolpv_redirect_page',
	));
}

/**
 * Display JavaScript field.
 *
 * @since 0.3.0
 */
function pmprolpv_settings_field_use_js() {
	$use_js = get_option( 'pmprolpv_use_js' );
	?>
	<input value="1" type="checkbox" id="use_js" name="pmprolpv_use_js" <?php checked( $use_js, 1 ); ?>>
	<?php
}

// Display settings page.
?>
	<h1><?php esc_html_e( 'Limit Post Views Add On', 'pmpro-limit-post-views' ); ?></h1>
	<hr />
	<form action="options.php" method="POST">
		<?php settings_fields( 'pmpro-limitpostviews' ); ?>
		<?php do_settings_sections( 'pmpro-limitpostviews' ); ?>
		<?php submit_button(); ?>
	</form>
<?php

require_once( PMPRO_DIR . '/adminpages/admin_footer.php' );
