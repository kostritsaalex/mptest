<?php
namespace HivePress\Controllers;

use HivePress\Helpers as hp;
use HivePress\Models;
use HivePress\Blocks;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Controller class.
 */
final class Followers extends Controller {

    /**
     * Class constructor.
     *
     * @param array $args Controller arguments.
     */
    public function __construct( $args = [] ) {
        $args = hp\merge_arrays(
            [
                'routes' => [
                    // Define custom URL routes here.
                    'listings_feed_page' => [
                        'title'     => esc_html__( 'Feed', 'foo-followers' ),
                        'base'      => 'user_account_page',
                        'path'      => '/feed',
                        'redirect'  => [ $this, 'redirect_feed_page' ],
                        'action'    => [ $this, 'render_feed_page' ],
                        'paginated' => true,
                    ],
                ],
            ],
            $args
        );

        parent::__construct( $args );
    }

    // Implement the route actions here.

    /**
     * Redirects listing feed page.
     *
     * @return mixed
     */
    public function redirect_feed_page() {

        // Check authentication.
        if ( ! is_user_logged_in() ) {
            return hivepress()->router->get_return_url( 'user_login_page' );
        }

        // Check followed vendors.
        if ( ! hivepress()->request->get_context( 'vendor_follow_ids' ) ) {
            return hivepress()->router->get_url( 'user_account_page' );
        }

        return false;
    }

    /**
     * Renders listing feed page.
     *
     * @return string
     */
    public function render_feed_page() {

        // Create listing query.
        $query = Models\Listing::query()->filter(
            [
                'status'     => 'publish',
                'vendor__in' => hivepress()->request->get_context( 'vendor_follow_ids' ),
            ]
        )->order( [ 'created_date' => 'desc' ] )
            ->limit( get_option( 'hp_listings_per_page' ) )
            ->paginate( hivepress()->request->get_page_number() );

        // Set request context.
        hivepress()->request->set_context(
            'post_query',
            $query->get_args()
        );

        // Render page template.
        return ( new Blocks\Template(
            [
                'template' => 'listings_feed_page',

                'context'  => [
                    'listings' => [],
                ],
            ]
        ) )->render();
    }

}