<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/nicomollet
 * @since      1.0.0
 *
 * @package    Tmsm_Golf_Features
 * @subpackage Tmsm_Golf_Features/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Tmsm_Golf_Features
 * @subpackage Tmsm_Golf_Features/includes
 * @author     Nicolas Mollet <nmollet@thalassotherapie.com>
 */
class Tmsm_Golf_Features_Install {

	/**
	 * Activation of the plugin
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		self::create_roles();

	}

	/**
	 * Deactivation of the plugin
	 *
	 * @since    1.0.2
	 */
	public static function deactivate() {
		self::remove_roles();
	}


	/**
	 * Create roles and capabilities.
	 *
	 * @since    1.0.0
	 */
	public static function create_roles() {
		global $wp_roles;

		if ( ! class_exists( 'WP_Roles' ) ) {
			return;
		}

		if ( ! isset( $wp_roles ) ) {
			$wp_roles = new WP_Roles();
		}

		// Golf Association role
		add_role( 'golf_association', __( 'Golf Association', 'tmsm-golf-features' ), array(
			'read'                   => true,
			'edit_posts'             => true,
			'edit_published_posts'   => true,
			'edit_others_posts'      => true,
			'read_private_posts'     => true,
			'publish_posts'          => true,
		) );

		// Golf Manager role
		add_role( 'golf_manager', __( 'Golf Manager', 'tmsm-golf-features' ), array(
			'level_9'                => true,
			'level_8'                => true,
			'level_7'                => true,
			'level_6'                => true,
			'level_5'                => true,
			'level_4'                => true,
			'level_3'                => true,
			'level_2'                => true,
			'level_1'                => true,
			'level_0'                => true,
			'read'                   => true,
			'read_private_pages'     => true,
			'read_private_posts'     => true,
			'edit_users'             => true,
			'edit_posts'             => true,
			'edit_pages'             => true,
			'edit_published_posts'   => true,
			'edit_published_pages'   => true,
			'edit_private_pages'     => true,
			'edit_private_posts'     => true,
			'edit_others_posts'      => true,
			'edit_others_pages'      => true,
			'publish_posts'          => true,
			'publish_pages'          => true,
			'delete_posts'           => true,
			'delete_pages'           => true,
			'delete_private_pages'   => true,
			'delete_private_posts'   => true,
			'delete_published_pages' => true,
			'delete_published_posts' => true,
			'delete_others_posts'    => true,
			'delete_others_pages'    => true,
			'manage_categories'      => true,
			'moderate_comments'      => true,
			'upload_files'           => true,
		) );

		$capabilities = self::get_core_capabilities();

		foreach ( $capabilities as $cap_group ) {
			foreach ( $cap_group as $cap ) {
				$wp_roles->add_cap( 'golf_manager', $cap );
				$wp_roles->add_cap( 'golf_association', $cap );
				$wp_roles->add_cap( 'administrator', $cap );
				$wp_roles->add_cap( 'editor', $cap );
			}
		}
	}

	/**
	 * Get capabilities for WooCommerce - these are assigned to admin/shop manager during installation or reset.
	 *
	 * @return array
	 */
	private static function get_core_capabilities() {

		$capabilities['golf_features'] = array(
			'golf_weather',
		);
		return $capabilities;
	}

	/**
	 * Remove roles
	 *
	 * @since    1.0.2
	 */
	public static function remove_roles() {
		global $wp_roles;

		if ( ! class_exists( 'WP_Roles' ) ) {
			return;
		}

		if ( ! isset( $wp_roles ) ) {
			$wp_roles = new WP_Roles();
		}

		$capabilities = self::get_core_capabilities();

		foreach ( $capabilities as $cap_group ) {
			foreach ( $cap_group as $cap ) {
				$wp_roles->remove_cap( 'golf_manager', $cap );
				$wp_roles->remove_cap( 'golf_association', $cap );
			}
		}

		remove_role( 'golf_manager' );
		remove_role( 'golf_association' );
	}

}
