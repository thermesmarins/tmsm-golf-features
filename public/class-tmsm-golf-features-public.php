<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/nicomollet
 * @since      1.0.0
 *
 * @package    Tmsm_Golf_Features
 * @subpackage Tmsm_Golf_Features/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tmsm_Golf_Features
 * @subpackage Tmsm_Golf_Features/public
 * @author     Nicolas Mollet <nmollet@thalassotherapie.com>
 */
class Tmsm_Golf_Features_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tmsm-golf-features-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tmsm-golf-features-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the shortcodes
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {
		add_shortcode( 'tmsm-golf-features-weather', array( $this, 'weather_shortcodes') );
	}

	/**
	 * Weather shortcode
	 *
	 * @since    1.0.0
	 */
	public function weather_shortcodes($atts) {
		$atts = shortcode_atts( array(
			'option' => '',
		), $atts, 'tmsm-golf-features-weather' );

		$option = $atts['option'];

		switch($option){
			case 'bagallowed':
				$label = __( 'Bag allowed:', 'tmsm-golf-features' );
				break;
			case 'cartallowed':
				$label = __( 'Cart allowed:', 'tmsm-golf-features' );
				break;
			case 'summergreen':
				$label = __( 'Summer green:', 'tmsm-golf-features' );
				break;
			default:
				$label = '';
				break;
		}

		$value = '';
		if(!empty($option)){
			$value =  get_option( $this->option_name . '_'.$option );
			if($value == 1){
				$value = __( 'Yes', 'tmsm-golf-features' );
			}
			else{
				$value = __( 'No', 'tmsm-golf-features' );
			}
		}

		$output = sprintf( '<span class="weather-item"><span class="weather-label">%s</span> <span class="weather-value">%s</span></span>',
			$label,
			$value
		);

		return $output;
	}

}
