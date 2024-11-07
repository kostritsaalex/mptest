<?php
namespace HivePress\Components;

use HivePress\Helpers as hp;
use HivePress\Models;
use HivePress\Emails;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Component class.
 */
final class Followers extends Component {

    /**
     * Class constructor.
     *
     * @param array $args Component arguments.
     */
    public function __construct( $args = [] ) {
        // Attach functions to hooks here (e.g. add_action, add_filter).
        add_filter( 'hivepress/v1/components/request/context', [ $this, 'set_request_context' ] );
        add_filter( 'hivepress/v1/menus/user_account', [ $this, 'add_menu_item' ] );
        parent::__construct( $args );
    }

    // Implement the attached functions here.

    /**
     * Sets request context for pages.
     *
     * @param array $context Context values.
     * @return array
     */
    public function set_request_context( $context ) {

        // Get user ID.
        $user_id = get_current_user_id();

        // Get cached vendor IDs.
        $vendor_ids = hivepress()->cache->get_user_cache( $user_id, 'vendor_follow_ids', 'models/follow' );

        if ( is_null( $vendor_ids ) ) {

            // Get follows.
            $follows = Models\Follow::query()->filter(
                [
                    'user' => $user_id,
                ]
            )->get();

            // Get vendor IDs.
            $vendor_ids = [];

            foreach ( $follows as $follow ) {
                $vendor_ids[] = $follow->get_vendor__id();
            }

            // Cache vendor IDs.
            hivepress()->cache->set_user_cache( $user_id, 'vendor_follow_ids', 'models/follow', $vendor_ids );
        }

        // Set request context.
        $context['vendor_follow_ids'] = $vendor_ids;

        return $context;
    }

    /**
     * Adds menu item to user account.
     *
     * @param array $menu Menu arguments.
     * @return array
     */
    public function add_menu_item( $menu ) {
        if ( hivepress()->request->get_context( 'vendor_follow_ids' ) ) {
            $menu['items']['listings_feed'] = [
                'route'  => 'listings_feed_page',
                '_order' => 20,
            ];
        }

        return $menu;
    }
}