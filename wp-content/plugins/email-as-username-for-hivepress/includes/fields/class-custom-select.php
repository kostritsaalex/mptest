<?php
/**
 * Custom Select field.
 *
 * @package HivePress\Fields
 */

namespace HivePress\Fields;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Drop-down list.
 */
class Custom_Select extends Select {

	/**
	 * Validates field value.
	 *
	 * @return bool
	 */
	public function validate() {
//		if ( parent::validate() && ! is_null( $this->value ) ) {
//			$options = array_intersect_key( $this->options, array_flip( (array) $this->value ) );
//
//			// if ( count( $options ) !== count( (array) $this->value ) || array_filter(
//			// 	array_map(
//			// 		function( $option ) {
//			// 			return hp\get_array_value( $option, 'disabled' );
//			// 		},
//			// 		$options
//			// 	)
//			// ) ) {
//			// 	$this->add_errors( sprintf( hivepress()->translator->get_string( 'field_contains_invalid_value' ), $this->get_label( true ) ) );
//			// }
//
//			if ( $this->multiple && $this->max_values && count( $options ) > $this->max_values ) {
//				$this->add_errors( sprintf( hivepress()->translator->get_string( 'field_contains_too_many_values' ), $this->get_label( true ) ) );
//			}
//		}

		if ( isset( $this->errors['required'] ) && ! $this->options ) {
			unset( $this->errors['required'] );
		}

		return empty( $this->errors );
	}

}
