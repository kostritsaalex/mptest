<?php
/**
 * Plugin Name: Custom Order Deliver
 * Description: Overrides the Order Deliver class to customize the confirmation text.
 * Version: 1.0
 * Author: Your Name
 */

// In functions.php or custom-order-deliver.php

namespace YourNamespace;

use HivePress\Forms\Order_Deliver;

// Ensure your code doesn't run before required files are loaded.
add_action('plugins_loaded', function() {
    class Custom_Order_Deliver extends Order_Deliver {
        public function __construct( $args = [] ) {
            // Custom changes here.
            $args = \HivePress\Helpers\merge_arrays(
                [
                    'description' => esc_html__( 'Are you sure?', 'HivePress' ),
                ],
                $args
            );
            parent::__construct( $args );
        }
    }

    // Instantiate your custom class or hook it where necessary.
    // Example, instantiate if needed:
    // $order_form = new \YourNamespace\Custom_Order_Deliver($args);
});


// Instantiate your custom class where necessary
// Ensure to integrate it with the existing plugin setup
