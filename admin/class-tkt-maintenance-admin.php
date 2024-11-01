<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.tukutoi.com/
 * @since      1.0.0
 *
 * @package    Tkt_Maintenance
 * @subpackage Tkt_Maintenance/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin settings, enqueues scripts required for settings.
 *
 * @package    Tkt_Maintenance
 * @subpackage Tkt_Maintenance/admin
 * @author     bedas <hello@tukutoi.com>
 */
class Tkt_Maintenance_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The shortname of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_short    The shortname of this plugin, used for function prefix and option prefix.
	 */
	private $plugin_short;

	/**
	 * The Settings section name of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $settings    The settings name of this plugin.
	 */
	private $settings;

	/**
	 * The slug-name of the settings page.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $section   The slug-name of the settings page on which to show the sections.
	 */
	private $section;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $plugin_short      The shortname of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $plugin_short, $version ) {

		$this->plugin_name  = $plugin_name;
		$this->plugin_short = $plugin_short;
		$this->version      = $version;

		$this->settings     = $this->plugin_short . '_setting_section';
		$this->section      = 'reading';

	}

	/**
	 * Callback to register the Settings Sections for this Plugin
	 *
	 * @since    1.0.0
	 */
	private function register_settings() {

		add_settings_section(
			$this->settings,
			esc_html__( 'TukuToi Maintenance Settings', 'tkt-maintenance' ),
			array( $this, 'setting_section_cb' ),
			$this->section
		);

		add_settings_field(
			$this->plugin_short . '_active',
			esc_html__( 'Activate maintenance mode', 'tkt-maintenance' ),
			array( $this, 'active_cb' ),
			$this->section,
			$this->settings
		);

		add_settings_field(
			$this->plugin_short . '_dequeue_styles_scripts',
			esc_html__( 'Dequeue Styles and Scripts', 'tkt-maintenance' ),
			array( $this, 'dequeue_styles_scripts' ),
			$this->section,
			$this->settings
		);

		add_settings_field(
			$this->plugin_short . '_logo',
			esc_html__( 'Add Custom Logo', 'tkt-maintenance' ),
			array( $this, 'logo_cb' ),
			$this->section,
			$this->settings
		);

		add_settings_field(
			$this->plugin_short . '_footer',
			esc_html__( 'Add Custom Footer Text', 'tkt-maintenance' ),
			array( $this, 'footer_cb' ),
			$this->section,
			$this->settings
		);

		add_settings_field(
			$this->plugin_short . '_header',
			esc_html__( 'Add Custom Header Text', 'tkt-maintenance' ),
			array( $this, 'header_cb' ),
			$this->section,
			$this->settings
		);

		add_settings_field(
			$this->plugin_short . '_http_header',
			esc_html__( 'Add Custom HTTP Header Message', 'tkt-maintenance' ),
			array( $this, 'http_header_cb' ),
			$this->section,
			$this->settings
		);

		add_settings_field(
			$this->plugin_short . '_http_status',
			esc_html__( 'Add Custom HTTP Status Code', 'tkt-maintenance' ),
			array( $this, 'http_status_cb' ),
			$this->section,
			$this->settings
		);

		add_settings_field(
			$this->plugin_short . '_retry_after',
			esc_html__( 'Add Custom Timeout to retry Crawling', 'tkt-maintenance' ),
			array( $this, 'retry_after_cb' ),
			$this->section,
			$this->settings
		);

		add_settings_field(
			$this->plugin_short . '_time',
			esc_html__( 'Add Custom End Time', 'tkt-maintenance' ),
			array( $this, 'time_cb' ),
			$this->section,
			$this->settings
		);

		add_settings_field(
			$this->plugin_short . '_image',
			esc_html__( 'Add Custom Background Image', 'tkt-maintenance' ),
			array( $this, 'image_cb' ),
			$this->section,
			$this->settings
		);

		register_setting(
			$this->section,
			$this->plugin_short . '_active',
			array(
				'type' => 'number',
				'sanitize_callback' => array(
					$this,
					'validate_number',
				),
			)
		);

		register_setting(
			$this->section,
			$this->plugin_short . '_dequeue_styles_scripts',
			array(
				'type' => 'number',
				'sanitize_callback' => array(
					$this,
					'validate_number',
				),
			)
		);

		register_setting(
			$this->section,
			$this->plugin_short . '_logo',
			array(
				'type' => 'string',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		register_setting(
			$this->section,
			$this->plugin_short . '_footer',
			array(
				'type' => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		register_setting(
			$this->section,
			$this->plugin_short . '_header',
			array(
				'type' => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		register_setting(
			$this->section,
			$this->plugin_short . '_http_header',
			array(
				'type' => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		register_setting(
			$this->section,
			$this->plugin_short . '_http_status',
			array(
				'type' => 'number',
				'sanitize_callback' => array(
					$this,
					'validate_number',
				),
			)
		);

		register_setting(
			$this->section,
			$this->plugin_short . '_retry_after',
			array(
				'type' => 'number',
				'sanitize_callback' => array(
					$this,
					'validate_number',
				),
			)
		);

		register_setting(
			$this->section,
			$this->plugin_short . '_time',
			array(
				'type' => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		register_setting(
			$this->section,
			$this->plugin_short . '_image',
			array(
				'type' => 'string',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

	}

	/**
	 * Callback to register Setting Sections of this Plugin
	 *
	 * @since    1.0.0
	 */
	public function setting_section_cb() {

		echo '<p>' . esc_html__( 'Configure and activate maintenance mode.', 'tkt-maintenance' ) . '</p>';
		echo '<p><em>' . esc_html__( 'To add Custom CSS, use the ', 'tkt-maintenance' ) . '<a href="' . esc_url( get_admin_url( null, 'customize.php' ) ) . '" target="_blank">' . esc_html__( 'Appearance Customize Screen', 'tkt-maintenance' ) . '</a>' . esc_html__( '. To add Custom JS, use ', 'tkt-maintenance' ) . '<a href="https://developer.wordpress.org/reference/functions/wp_enqueue_script/" target="_blank">' . esc_html__( ' WordPress Enqueue Functions', 'tkt-maintenance' ) . '</a>.<em></p>';

	}

	/**
	 * Callback to activate Maintenance Mode.
	 *
	 * @since    1.0.0
	 */
	public function active_cb() {

		echo '<fieldset><legend class="screen-reader-text"><span>' . esc_html__( 'Check to activate maintenance mode', 'tkt-maintenance' ) . '</span></legend><label for="' . esc_attr( $this->plugin_short ) . '_active"><input name="' . esc_attr( $this->plugin_short ) . '_active" id="' . esc_attr( $this->plugin_short ) . '_active" type="checkbox" value="1" ' . checked( 1, $this->validate_number( get_option( $this->plugin_short . '_active' ) ), false ) . ' />' . esc_html__( 'Check to activate maintenance mode', 'tkt-maintenance' ) . '</label></fieldset>';

	}

	/**
	 * Callback to Dequeue all styles and scripts.
	 *
	 * @since    1.0.0
	 */
	public function dequeue_styles_scripts() {

		echo '<fieldset><legend class="screen-reader-text"><span>' . esc_html__( 'Check to dequeue all styles and scripts during maintenance mode', 'tkt-maintenance' ) . '</span></legend><label for="' . esc_attr( $this->plugin_short ) . '_dequeue_styles_scripts"><input name="' . esc_attr( $this->plugin_short ) . '_dequeue_styles_scripts" id="' . esc_attr( $this->plugin_short ) . '_dequeue_styles_scripts" type="checkbox" value="1" ' . checked( 1, $this->validate_number( get_option( $this->plugin_short . '_dequeue_styles_scripts' ) ), false ) . ' />' . esc_html__( 'Check to dequeue all styles and scripts during maintenance mode', 'tkt-maintenance' ) . '</label></fieldset>';

	}

	/**
	 * Callback to add custom Logo Image URL.
	 *
	 * @since    1.0.0
	 */
	public function logo_cb() {

		echo '<fieldset><legend class="screen-reader-text"><span>' . esc_html__( 'Enter an URL or Upload an Image for the Logo', 'tkt-maintenance' ) . '</span></legend><input name="' . esc_attr( $this->plugin_short ) . '_logo" id="' . esc_attr( $this->plugin_short ) . '_logo" type="text" size="36" value="' . esc_url_raw( get_option( $this->plugin_short . '_logo' ) ) . '" /><input id="' . esc_attr( $this->plugin_short ) . '_logo_button" class="button" type="button" value="Upload Image" /><p class="description">' . esc_html__( 'Enter an URL or Upload an Image for the Logo', 'tkt-maintenance' ) . '</p></fieldset>';

	}

	/**
	 * Callback to add custom Footer Text.
	 *
	 * @since    1.0.0
	 */
	public function footer_cb() {

		echo '<fieldset><legend class="screen-reader-text"><span>' . esc_html__( 'Add your own Footer Text', 'tkt-maintenance' ) . '</span></legend><input name="' . esc_attr( $this->plugin_short ) . '_footer" id="' . esc_attr( $this->plugin_short ) . '_footer" type="text" value="' . esc_attr( get_option( $this->plugin_short . '_footer' ) ) . '" /><p class="description">' . esc_html__( 'Add your own Footer Text', 'tkt-maintenance' ) . '</p></fieldset>';

	}

	/**
	 * Callback to add custom Header Text.
	 *
	 * @since    1.0.0
	 */
	public function header_cb() {

		echo '<fieldset><legend class="screen-reader-text"><span>' . esc_html__( 'Add your own Header Text', 'tkt-maintenance' ) . '</span></legend><input name="' . esc_attr( $this->plugin_short ) . '_header" id="' . esc_attr( $this->plugin_short ) . '_header" type="text" value="' . esc_attr( get_option( $this->plugin_short . '_header' ) ) . '" /><p class="description">' . esc_html__( 'Add your own Header Text', 'tkt-maintenance' ) . '</p></fieldset>';

	}

	/**
	 * Callback to add custom HTTP Header Message.
	 *
	 * @since    1.0.0
	 */
	public function http_header_cb() {

		echo '<fieldset><legend class="screen-reader-text"><span>' . esc_html__( 'Add a Custom HTTP Header Message', 'tkt-maintenance' ) . '</span></legend><input name="' . esc_attr( $this->plugin_short ) . '_http_header" id="' . esc_attr( $this->plugin_short ) . '_http_header" type="text" value="' . esc_attr( get_option( $this->plugin_short . '_http_header' ) ) . '" /><p class="description">' . esc_html__( 'Add a Custom HTTP Header Message', 'tkt-maintenance' ) . '</p></fieldset>';

	}

	/**
	 * Callback to add custom Header Status.
	 *
	 * @since    1.0.0
	 */
	public function http_status_cb() {

		echo '<fieldset><legend class="screen-reader-text"><span>' . esc_html__( 'Add a Custom HTTP Status', 'tkt-maintenance' ) . '</span></legend><input name="' . esc_attr( $this->plugin_short ) . '_http_status" id="' . esc_attr( $this->plugin_short ) . '_http_status" type="text" value="' . esc_attr( get_option( $this->plugin_short . '_http_status' ) ) . '" /><p class="description">' . esc_html__( 'Add a Custom HTTP Status', 'tkt-maintenance' ) . '</p></fieldset>';

	}

	/**
	 * Callback to add custom Retry After Timeout.
	 *
	 * @since    1.0.0
	 */
	public function retry_after_cb() {

		echo '<fieldset><legend class="screen-reader-text"><span>' . esc_html__( 'Add a Custom Timeout for Crawlers to Retry after X Seconds', 'tkt-maintenance' ) . '</span></legend><input name="' . esc_attr( $this->plugin_short ) . '_retry_after" id="' . esc_attr( $this->plugin_short ) . '_retry_after" type="text" value="' . esc_attr( get_option( $this->plugin_short . '_retry_after' ) ) . '" /><p class="description">' . esc_html__( 'Add a Custom Timeout for Crawlers to Retry after X Seconds', 'tkt-maintenance' ) . '</p></fieldset>';

	}

	/**
	 * Callback to add custom Countdown Time.
	 *
	 * @since    1.0.0
	 */
	public function time_cb() {

		echo '<fieldset><legend class="screen-reader-text"><span>' . esc_html__( 'Add your own Countdown End Time', 'tkt-maintenance' ) . '</span></legend><input name="' . esc_attr( $this->plugin_short ) . '_time" id="' . esc_attr( $this->plugin_short ) . '_time" type="text" value="' . esc_attr( get_option( $this->plugin_short . '_time' ) ) . '" /><p class="description">' . esc_html__( 'Add your own Countdown End Time. Any valid JS ', 'tkt-maintenance' ) . '<a target="_blank" href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Date#examples"><code>Date()</code></a>' . esc_html__( 'format accepted.', 'tkt-maintenance' ) . '</p></fieldset>';

	}

	/**
	 * Callback to add custom Background Image URL.
	 *
	 * @since    1.0.0
	 */
	public function image_cb() {

		echo '<fieldset><legend class="screen-reader-text"><span>' . esc_html__( 'Enter an URL or Upload an Image for the Background', 'tkt-maintenance' ) . '</span></legend><input name="' . esc_attr( $this->plugin_short ) . '_image" id="' . esc_attr( $this->plugin_short ) . '_image" type="text" size="36" value="' . esc_url_raw( get_option( $this->plugin_short . '_image' ) ) . '" /><input id="' . esc_attr( $this->plugin_short ) . '_image_button" class="button" type="button" value="Upload Image" /><p class="description">' . esc_html__( 'Enter an URL or Upload an Image for the Background', 'tkt-maintenance' ) . '</p></fieldset>';

	}

	/**
	 * Register the JavaScript for the admin-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		$screen = get_current_screen();

		if ( 'options-reading' === $screen->base ) {

			wp_enqueue_media();
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tkt-maintenance-admin.js', array( 'jquery' ), $this->version, false );

		}

	}

	/**
	 * Callback to validate Number and checkbox values (1 or 0).
	 *
	 * @param    mixed $input value to validate.
	 * @since    1.0.0
	 */
	public function validate_number( $input ) {

		if ( 1 == $input ) {
			return 1;
		}
		if ( is_numeric( $input ) ) {
			return $input;
		}
		if ( empty( $input ) ) {
			return '';
		}

		return 0;

	}


	/**
	 * Public callback to register the Settings Sections for this Plugin
	 *
	 * @since    1.0.0
	 */
	public function init_settings() {

		if ( is_admin() && ( current_user_can( 'manage_options' ) || current_user_can( 'manage_network_options' ) ) ) {
			$this->register_settings();
		}

	}

}
