<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<p><?php esc_html_e( 'An active membership is required for this action, please click on the button below to view the available plans.', 'hivepress-memberships' ); ?></p>
<button type="button" class="hp-button hp-button--wide button button--large button--primary alt" data-component="link" data-url="<?php echo esc_url( hivepress()->router->get_url( 'membership_plans_view_page' ) ); ?>"><?php esc_html_e( 'View Plans', 'hivepress-memberships' ); ?></button>
