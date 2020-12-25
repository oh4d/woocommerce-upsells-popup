<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WC_UpSells_Popup
{
    /**
     * @var string
     */
    public $version = '1.0.0';

    /**
     * @var string
     */
    public $bootstrap_warning_message;

    /**
     * @var null
     */
    protected static $_instance = null;

    /**
     * WC_UpSells_Popup constructor.
     */
    public function __construct()
    {
        $this->define_constants();

        $this->includes();

        $this->init_hooks();
    }

    /**
     * @return WC_UpSells_Popup|null
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     *
     */
    public function on_plugins_loaded()
    {
        try
        {
            $this->dependencies();

            $this->init();
        }
        catch (\Exception $e)
        {
            $this->bootstrap_warning_message = $e->getMessage();

            add_action('admin_notices', array($this, 'bootstrap_warning'));
        }
    }

    public function includes()
    {
        include_once WC_UPSELLS_POPUP_ABSPATH . '/includes/class-wc-upsells-popup-post-types.php';

        if ($this->is_request( 'admin')) {
            include_once WC_UPSELLS_POPUP_ABSPATH . '/includes/admin/class-wc-upsells-popup-admin.php';
        }

        if ($this->is_request('frontend')) {
            $this->frontend_includes();
        }
    }

    private function init()
    {
        new WC_UpSells_Popup_Post_Types();

        if ($this->is_request( 'admin')) {
            new WC_UpSells_Popup_Admin();
        }

        if ($this->is_request('frontend')) {
            new WC_UpSells_Popup_Cart();
            new WC_UpSells_Popup_Frontend();
        }
    }

    /**
     * Echo Bootstrap Warning Message
     *
     * @return void
     */
    public function bootstrap_warning()
    {
        if (!empty($this->bootstrap_warning_message)) :
            ?>
            <div class="error fade">
                <p>
                    <strong><?php echo $this->bootstrap_warning_message; ?></strong>
                </p>
            </div>
        <?php
        endif;
    }

    /**
     * Check Plugin Dependencies
     *
     * @throws Exception
     * @return void
     */
    public function dependencies()
    {
        if (!function_exists('WC')) {
            throw new Exception(__('WC UpSells Popup requires WooCommerce to be activated', 'wc-upsells-popup'));
        }
    }

    private function init_hooks()
    {
        add_action('plugins_loaded', array($this, 'on_plugins_loaded'));
    }

    private function frontend_includes()
    {
        include_once WC_UPSELLS_POPUP_ABSPATH . '/includes/class-wc-upsells-popup-cart.php';
        include_once WC_UPSELLS_POPUP_ABSPATH . '/includes/class-wc-upsells-popup-frontend.php';
    }

    /**
     * Define constants
     */
    private function define_constants()
    {
        define('WC_UPSELLS_POPUP_VERSION', $this->version);
        define('WC_UPSELLS_POPUP_ABSPATH', dirname( WC_UPSELLS_POPUP_PLUGIN_FILE ));
    }

    /**
     * What type of request is this?
     *
     * @param  string $type admin, ajax, cron or frontend.
     * @return bool
     */
    private function is_request($type) {
        switch ($type) {
            case 'admin':
                return is_admin();
            case 'ajax':
                return defined('DOING_AJAX');
            case 'cron':
                return defined('DOING_CRON');
            case 'frontend':
                return (!is_admin() || defined( 'DOING_AJAX')) && !defined( 'DOING_CRON' );
        }
    }
}
