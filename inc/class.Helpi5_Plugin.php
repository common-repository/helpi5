<?php

class Helpi5_Plugin
{
    public static function init()
    {
        add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_frontend_assets' ) );
        add_action( 'admin_menu', array( __CLASS__, 'register_settings_page' ) );
        add_action( 'admin_init', array( __CLASS__, 'save_settings' ) );
        add_action( 'admin_notices', array( __CLASS__, 'show_success_notice' ) );
        add_filter( 'plugin_action_links_'.plugin_basename( HELPI5_FILE ),  array( __CLASS__, 'output_settings_link' ) );
    }
    public static function enqueue_frontend_assets()
    {
        $settings = self::get_settings();

        if( $settings['api_key'] ) :

            wp_register_script( 'helpi5', 'https://app.helpi5.com/CDN/helpi5.min.js' );
            wp_register_script( 'helpi5-init', plugins_url( 'assets/js/init.js', HELPI5_FILE ), array( 'jquery', 'helpi5' ), HELPI5_VERSION );
            wp_localize_script( 'helpi5-init', 'helpi5_config', $settings );
            wp_enqueue_script( 'helpi5-init' );

        endif;
    }

    private static function get_settings()
    {
        $settings = get_option( 'helpi5_settings' );

        if( !$settings || !is_array( $settings ) ) :
            $settings = array(
                'api_key' => '',
                'button_css' => ''
            );
        endif;

        return $settings;
    }

    private static function is_saving_settings()
    {
        return isset( $_POST['action'] )
        && $_POST['action'] == 'helpi5_save_settings'
        && current_user_can( 'manage_options' )
        && wp_verify_nonce( $_POST['_wpnonce'], 'helpi5_save_settings' );
    }

    public static function save_settings()
    {
        if( self::is_saving_settings() ) :

            $settings = array(
                'api_key' => sanitize_text_field( $_POST['helpi5']['api_key'] ),
                'button_css' => sanitize_textarea_field( $_POST['helpi5']['button_css'] )
            );

            update_option( 'helpi5_settings', $settings );
            wp_redirect( 'options-general.php?page=helpi5-settings&success' );
            exit;

        endif;
    }

    public static function register_settings_page()
    {
        add_options_page( __('Helpi5 Settings', 'helpi5'),
        __('Helpi5 Settings', 'helpi5'), 'manage_options',
        'helpi5-settings', array( __CLASS__, 'settings_page' ) );
    }

    public static function settings_page()
    {
        $settings = self::get_settings();
        include HELPI5_DIR.'/templates/settings_page.php';
    }

    public static function show_success_notice()
    {
        $screen = get_current_screen();

        if( $screen->id == 'settings_page_helpi5-settings' && isset( $_GET['success'] ) ) :
            include HELPI5_DIR.'/templates/notice.php';
        endif;
    }

    public static function output_settings_link( $links )
    {
        $links[] = sprintf(
            '<a href="%s">%s</a>',
            esc_attr( admin_url( 'options-general.php?page=helpi5-settings' ) ),
            __( 'Settings', 'helpi5' )
        );
        return $links;
    }
}
