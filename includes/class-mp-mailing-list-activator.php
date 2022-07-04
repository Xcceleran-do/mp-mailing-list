<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/EsubalewAmenu/
 * @since      1.0.0
 *
 * @package    Mp_Mailing_List
 * @subpackage Mp_Mailing_List/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Mp_Mailing_List
 * @subpackage Mp_Mailing_List/includes
 * @author     Esubalew Amenu <esubalew.a2009@gmail.com>
 */
class Mp_Mailing_List_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {


		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		self::ds_mailing_lists_create_table();
	}

	public static function ds_mailing_lists_create_table()
	{
		global $table_prefix, $wpdb;

		$wp_ds_table = $table_prefix . "ds_mailing_lists";

		if ($wpdb->get_var("show tables like '$wp_ds_table'") != $wp_ds_table) {
			$sql = "CREATE TABLE `" . $wp_ds_table . "` ( ";
			$sql .= "  `id` int(10) unsigned NOT NULL AUTO_INCREMENT, ";

			$sql .= "  `email`  varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, ";

			$sql .= "  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, ";
			$sql .= "  `updated_at` TIMESTAMP DEFAULT NULL, ";
			$sql .= "  `deleted_at` TIMESTAMP DEFAULT NULL, ";

			$sql .= "  PRIMARY KEY (`id`) ";
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";

			dbDelta($sql);
		}
	}

}
