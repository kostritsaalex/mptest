<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

foreach ( $vendor->_get_fields( 'view_page_secondary' ) as $field ) :
	if ( ! is_null( $field->get_value() ) ) :
		?>
		<div class="hp-vendor__attribute hp-vendor__attribute--<?php echo esc_attr( $field->get_slug() ); ?>">
			<?php echo $field->display(); ?>
		</div>
		<?php
	endif;
endforeach;
