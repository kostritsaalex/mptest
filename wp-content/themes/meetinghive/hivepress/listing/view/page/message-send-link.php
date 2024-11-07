<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<button type="button" class="hp-listing__action hp-listing__action--message button button--large button--secondary" data-component="link" data-url="#<?php if ( is_user_logged_in() ) : ?>message_send_modal_<?php echo esc_attr( $listing->get_id() ); else : ?>user_login_modal<?php endif; ?>">
	<span><?php echo esc_html( hivepress()->translator->get_string( 'send_message' ) ); ?></span>
	<i class="hp-icon fas fa-paper-plane"></i>
</button>
