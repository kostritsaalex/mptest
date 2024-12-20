<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<div class="hp-listing-category__icon" data-component="inherit-color" data-source=".hp-listing-category" data-property="color" data-light="-50">
	<a href="<?php echo esc_url( $listing_category_url ); ?>">
		<?php if ( $listing_category->get_icon() ) : ?>
			<i class="hp-icon fas fa-<?php echo esc_attr( $listing_category->get_icon() ); ?>"></i>
		<?php else : ?>
			<i class="hp-icon fas fa-th-large"></i>
		<?php endif; ?>
	</a>
</div>
