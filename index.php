<?php

/**
 * Stores the name of the plugin's directory
 * @var string
 */
define( 'CPDW_PLUGIN_DIR_NAME', basename( dirname( __FILE__ ) ) );
/**
 * Stores the system path to the plugin's directory
 * @var string
 */
define( 'CPDW_PLUGIN_DIR_PATH', trailingslashit( wp_normalize_path( dirname( __FILE__ ) ) ) );

if ( vp_is_admin() ) {
    /*
     * Load widgets
     */
    require_once( CPDW_PLUGIN_DIR_PATH . 'widgets/WidgetStatsComments.php' );
    require_once( CPDW_PLUGIN_DIR_PATH . 'widgets/WidgetStatsPendingComments.php' );
    require_once( CPDW_PLUGIN_DIR_PATH . 'widgets/WidgetStatsSpamComments.php' );

    add_filter( 'valpress/dashboard/widgets/register', 'cpdw_register_widgets', 20, 1 );

    /**
     * Register widgets
     * @param array $widgets
     * @return array
     */
    function cpdw_register_widgets( $widgets = [] )
    {
        if ( !isset( $widgets[ 'App\\Widgets\\WidgetStatsComments' ] ) ) {
            $widgets[ 'App\\Widgets\\WidgetStatsComments' ] = 'cpdw_widget_comments';
        }
        if ( !isset( $widgets[ 'App\\Widgets\\WidgetStatsPendingComments' ] ) ) {
            $widgets[ 'App\\Widgets\\WidgetStatsPendingComments' ] = 'cpdw_widget_pending_comments';
        }
        if ( !isset( $widgets[ 'App\\Widgets\\WidgetStatsSpamComments' ] ) ) {
            $widgets[ 'App\\Widgets\\WidgetStatsSpamComments' ] = 'cpdw_widget_spam_comments';
        }
        return $widgets;
    }

    /**
     * Register the path to the translation file that will be used depending on the current locale
     */
    add_action( 'valpress/app/loaded', function () {
        vp_register_language_file( 'cpdw', path_combine( public_path( 'plugins' ), CPDW_PLUGIN_DIR_NAME, 'lang' ) );
    } );
}
