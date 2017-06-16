<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/nicomollet
 * @since      1.0.0
 *
 * @package    Tmsm_Golf_Features
 * @subpackage Tmsm_Golf_Features/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tmsm_Golf_Features
 * @subpackage Tmsm_Golf_Features/admin
 * @author     Nicolas Mollet <nmollet@thalassotherapie.com>
 */
class Tmsm_Golf_Features_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'tmsm_golf_features';

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tmsm_Golf_Features_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tmsm_Golf_Features_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tmsm-golf-features-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tmsm_Golf_Features_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tmsm_Golf_Features_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tmsm-golf-features-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_menu_page_weather() {
		$this->plugin_screen_hook_suffix = add_menu_page(
			__( 'Weather', 'tmsm-golf-features' ),
			__( 'Weather', 'tmsm-golf-features' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page_weather' ),
			'dashicons-cloud'
		);
	}

	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page_weather() {
		include_once 'partials/weather.php';
	}

	/**
	 * Register all related settings of this plugin
	 *
	 * @since  1.0.0
	 */
	public function register_settings_weather() {
		add_settings_section(
			$this->option_name . '_weather',
			__( 'Weather', 'tmsm-golf-features' ),
			array( $this, 'setting_section_weather_callback' ),
			$this->plugin_name
		);

		add_settings_field(
			$this->option_name . '_bagallowed',
			__( 'Bag allowed', 'tmsm-golf-features' ),
			array( $this, 'setting_field_bagallowed_callback' ),
			$this->plugin_name,
			$this->option_name . '_weather',
			array( 'label_for' => $this->option_name . '_bagallowed' )
		);

		add_settings_field(
			$this->option_name . '_cartallowed',
			__( 'Cart allowed', 'tmsm-golf-features' ),
			array( $this, 'setting_field_cartallowed_callback' ),
			$this->plugin_name,
			$this->option_name . '_weather',
			array( 'label_for' => $this->option_name . '_cartallowed' )
		);

		add_settings_field(
			$this->option_name . '_summergreen',
			__( 'Summer green', 'tmsm-golf-features' ),
			array( $this, 'setting_field_summergreen_callback' ),
			$this->plugin_name,
			$this->option_name . '_weather',
			array( 'label_for' => $this->option_name . '_summergreen' )
		);

		register_setting( $this->plugin_name, $this->option_name . '_bagallowed', 'intval' );
		register_setting( $this->plugin_name, $this->option_name . '_cartallowed', 'intval' );
		register_setting( $this->plugin_name, $this->option_name . '_summergreen', 'intval' );
	}

	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function setting_section_weather_callback() {
		echo '<p>' . __( 'Please change the settings accordingly.', 'tmsm-golf-features' ) . '</p>';
	}

	/**
	 * Render the radio input field for bagallowed option
	 *
	 * @since  1.0.0
	 */
	public function setting_field_bagallowed_callback() {
		$bagallowed = get_option( $this->option_name . '_bagallowed' );
		?>
		<fieldset>
			<label>
				<input type="radio" name="<?php echo $this->option_name . '_bagallowed' ?>" id="<?php echo $this->option_name . '_bagallowed' ?>" value="1" <?php checked( $bagallowed, 1 ); ?>>
				<?php _e( 'Yes', 'tmsm-golf-features' ); ?>
			</label>
			<br>
			<label>
				<input type="radio" name="<?php echo $this->option_name . '_bagallowed' ?>" value="0" <?php checked( $bagallowed, 0 ); ?>>
				<?php _e( 'No', 'tmsm-golf-features' ); ?>
			</label>
		</fieldset>
		<?php
	}

	/**
	 * Render the radio input field for cartallowed option
	 *
	 * @since  1.0.0
	 */
	public function setting_field_cartallowed_callback() {
		$cartallowed = get_option( $this->option_name . '_cartallowed' );
		?>
		<fieldset>
			<label>
				<input type="radio" name="<?php echo $this->option_name . '_cartallowed' ?>" id="<?php echo $this->option_name . '_cartallowed' ?>" value="1" <?php checked( $cartallowed, 1 ); ?>>
				<?php _e( 'Yes', 'tmsm-golf-features' ); ?>
			</label>
			<br>
			<label>
				<input type="radio" name="<?php echo $this->option_name . '_cartallowed' ?>" value="0" <?php checked( $cartallowed, 0 ); ?>>
				<?php _e( 'No', 'tmsm-golf-features' ); ?>
			</label>
		</fieldset>
		<?php
	}

	/**
	 * Render the radio input field for summergreen option
	 *
	 * @since  1.0.0
	 */
	public function setting_field_summergreen_callback() {
		$summergreen = get_option( $this->option_name . '_summergreen' );
		?>
		<fieldset>
			<label>
				<input type="radio" name="<?php echo $this->option_name . '_summergreen' ?>" id="<?php echo $this->option_name . '_cartallowed' ?>" value="1" <?php checked( $summergreen, 1 ); ?>>
				<?php _e( 'Yes', 'tmsm-golf-features' ); ?>
			</label>
			<br>
			<label>
				<input type="radio" name="<?php echo $this->option_name . '_summergreen' ?>" value="0" <?php checked( $summergreen, 0 ); ?>>
				<?php _e( 'No', 'tmsm-golf-features' ); ?>
			</label>
		</fieldset>
		<?php
	}

}
