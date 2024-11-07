<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( $membership->get_expired_time() ) :
	?>
	<time class="hp-membership__expired-date hp-meta" datetime="<?php echo esc_attr( date( 'Y-m-d H:i:s', $membership->get_expired_time() ) ); ?>">
		<?php
		if ( $membership->get_expired_time() > time() ) :
			/* translators: %s: date. */
			printf( esc_html__( 'Expires on %s', 'hivepress-memberships' ), date_i18n( get_option( 'date_format' ), $membership->get_expired_time() ) );
		else :
			/* translators: %s: date. */
			printf( esc_html__( 'Expired on %s', 'hivepress-memberships' ), date_i18n( get_option( 'date_format' ), $membership->get_expired_time() ) );
		endif;
		?>
	</time>
	<?php
endif;
