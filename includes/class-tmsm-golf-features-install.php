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
		self::update_roles();

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
			'level_1'                       => true,
			'level_0'                       => true,
			'read'                          => true,
			'gravityforms_edit_forms'       => true,
			'gravityforms_create_form'      => true,
			'gravityforms_view_entries'     => true,
			'gravityforms_edit_entries'     => true,
			'gravityforms_delete_entries'   => true,
			'gravityforms_export_entries'   => true,
			'gravityforms_view_entry_notes' => true,
			'gravityforms_edit_entry_notes' => true,
			'gravityforms_preview_forms'    => true,
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
	 * Update roles and capabilities.
	 *
	 * @since    1.0.0
	 */
	public static function update_roles() {

		$golf_manager = get_role('golf_manager');

		// Golf Manager role
		$capabilities = array(
			'level_9',
			'level_8',
			'level_7',
			'level_6',
			'level_5',
			'level_4',
			'level_3',
			'level_2',
			'read_private_pages',
			'read_private_posts',
			'edit_users',
			'edit_posts',
			'edit_pages',
			'edit_published_posts',
			'edit_published_pages',
			'edit_private_pages',
			'edit_private_posts',
			'edit_others_posts',
			'edit_others_pages',
			'publish_posts',
			'publish_pages',
			'delete_posts',
			'delete_pages',
			'delete_private_pages',
			'delete_private_posts',
			'delete_published_pages',
			'delete_published_posts',
			'delete_others_posts',
			'delete_others_pages',
			'manage_categories',
			'moderate_comments',
			'upload_files',
		);

		foreach ( $capabilities as $cap ) {
			$golf_manager->remove_cap( $cap );
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
		    'view_admin_dashboard'
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
