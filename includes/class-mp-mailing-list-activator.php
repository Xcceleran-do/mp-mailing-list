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

		self::mp_mailing_lists_create_table();
		self::mp_mailing_contact_create_table();
		self::mp_mailing_group_emails_create_table();
		self::mp_mailing_group_email_status_create_table();
	}
	
	public static function mp_mailing_lists_create_table()
	{
		global $table_prefix, $wpdb;

		$wp_mp_table = $table_prefix . "mp_mailing_lists";

		if ($wpdb->get_var("show tables like '$wp_mp_table'") != $wp_mp_table) {
			$sql = "CREATE TABLE `" . $wp_mp_table . "` ( ";
			$sql .= "  `id` int(10) unsigned NOT NULL AUTO_INCREMENT, ";

			$sql .= "  `email_address`  varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL, ";

			$sql .= "  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, ";
			$sql .= "  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP, ";
			$sql .= "  `deleted_at` TIMESTAMP NULL DEFAULT NULL, ";

			$sql .= "  PRIMARY KEY (`id`) ";
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";

			dbDelta($sql);
		}
		else {
			$res = $wpdb->query("SHOW COLUMNS FROM $wp_mp_table LIKE 'mail_type'");
			if (!$res) $wpdb->query("ALTER TABLE $wp_mp_table ADD `mail_type` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL AFTER email_address;");
		}

	}

	public static function mp_mailing_contact_create_table()
	{
		global $table_prefix, $wpdb;

		$wp_mp_table = $table_prefix . "mp_mailing_contact";

		if ($wpdb->get_var("show tables like '$wp_mp_table'") != $wp_mp_table) {
			$sql = "CREATE TABLE `" . $wp_mp_table . "` ( ";
			$sql .= "  `id` int(10) unsigned NOT NULL AUTO_INCREMENT, ";

			$sql .= "  `fname`  varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `lname`  varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `email_address`  varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `message` text COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `user_id` int(11), ";

			$sql .= "  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, ";
			$sql .= "  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP, ";
			$sql .= "  `deleted_at` TIMESTAMP NULL DEFAULT NULL, ";

			$sql .= "  PRIMARY KEY (`id`) ";
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";

			dbDelta($sql);
		}
	}
	public static function mp_mailing_group_emails_create_table()
	{
		global $table_prefix, $wpdb;

		$wp_mp_table = $table_prefix . "mp_mailing_group_emails";

		if ($wpdb->get_var("show tables like '$wp_mp_table'") != $wp_mp_table) {
			$sql = "CREATE TABLE `" . $wp_mp_table . "` ( ";
			$sql .= "  `id` int(10) unsigned NOT NULL AUTO_INCREMENT, ";

			$sql .= "  `email_type`  varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL, "; //'article_notification', 'followers', 'mailing_list', 'opted_in', 'promotional'

			$sql .= "  `email_template`  varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, "; // used email template id
			$sql .= "  `object_id`  varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, "; // is the email is post published email, the object_id is post id

			$sql .= "  `sent_status`  varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `user_id` int(11), ";

			$sql .= "  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, ";
			$sql .= "  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP, ";
			$sql .= "  `deleted_at` TIMESTAMP NULL DEFAULT NULL, ";

			$sql .= "  PRIMARY KEY (`id`) ";
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";

			dbDelta($sql);
		}
	}

	public static function mp_mailing_group_email_status_create_table()
	{
		global $table_prefix, $wpdb;

		$wp_mp_table = $table_prefix . "mp_mailing_group_email_status";

		if ($wpdb->get_var("show tables like '$wp_mp_table'") != $wp_mp_table) {
			$sql = "CREATE TABLE `" . $wp_mp_table . "` ( ";
			$sql .= "  `id` int(10) unsigned NOT NULL AUTO_INCREMENT, ";

			$sql .= "  `mailing_group_id` int(11) NOT NULL, ";
			$sql .= "  `ses_message_id`  varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `recipient_email`  varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL, ";
			$sql .= "  `status`  varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL, ";

			$sql .= "  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, ";
			$sql .= "  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP, ";
			$sql .= "  `deleted_at` TIMESTAMP NULL DEFAULT NULL, ";

			$sql .= "  PRIMARY KEY (`id`) ";
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";

			dbDelta($sql);
		}
	}

}