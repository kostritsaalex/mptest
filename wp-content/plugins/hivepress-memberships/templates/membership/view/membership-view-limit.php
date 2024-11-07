<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( $membership->get_view_limit() ) :
	?>
	<div class="hp-membership__view-limit hp-meta">
		<?php
		/* translators: %s: views number. */
		echo esc_html( sprintf( __( '%s views left', 'hivepress-memberships' ), $membership->display_view_limit() ) );
		?>
	</div>
	<?php
endif;
