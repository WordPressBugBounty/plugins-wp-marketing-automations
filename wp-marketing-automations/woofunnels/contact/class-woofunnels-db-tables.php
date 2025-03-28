<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'WooFunnels_DB_Tables' ) ) {
	/**
	 * Class WooFunnels_DB_Tables
	 */
	#[AllowDynamicProperties]
	class WooFunnels_DB_Tables {

		/**
		 * instance of class
		 * @var null
		 */
		private static $ins = null;

		/**
		 * WooFunnels_DB_Tables constructor.
		 */
		public function __construct() {
			add_filter( 'bwf_add_db_table_schema', array( $this, 'create_db_tables' ), 10, 2 );
		}

		/**
		 * @return WooFunnels_DB_Tables|null
		 */
		public static function get_instance() {
			if ( null === self::$ins ) {
				self::$ins = new self;
			}

			return self::$ins;
		}

		/**
		 * Add bwf_contact table
		 *
		 *  Warning: check if it exists first, which could cause SQL errors.
		 */
		public function create_db_tables( $args, $tables ) {

			if ( $tables['version'] !== BWF_DB_VERSION || ! in_array( 'bwf_contact', $tables['tables'], true ) ) {
				$args[] = [
					'name'   => 'bwf_contact',
					'schema' => "CREATE TABLE `{table_prefix}bwf_contact` (
					`id` int(12) unsigned NOT NULL AUTO_INCREMENT,
					`wpid` int(12) NOT NULL,
					`uid` varchar(35) NOT NULL DEFAULT '',
					`email` varchar(100) NOT NULL,
					`f_name` varchar(100),
					`l_name` varchar(100),
					`contact_no` varchar(20),
					`country` char(2),
					`state` varchar(100),
					`timezone` varchar(50) DEFAULT '',
					`type` varchar(20) DEFAULT 'lead',
					`source` varchar(100) DEFAULT '',
					`points` bigint(20) unsigned NOT NULL DEFAULT '0', 
					`tags` longtext,
					`lists` longtext,
					`last_modified` DateTime NOT NULL,
					`creation_date` DateTime NOT NULL,
					`status` int(2) NOT NULL DEFAULT 1,
					PRIMARY KEY (`id`),
					KEY `id` (`id`),
					KEY `wpid` (`wpid`),
					KEY `uid` (`uid`),
					UNIQUE KEY `email` (`email`)
	                ) {table_collate};",
				];
			}
			if ( $tables['version'] !== BWF_DB_VERSION || ! in_array( 'bwf_contact_meta', $tables['tables'], true ) ) {
				$args[] = [
					'name'   => 'bwf_contact_meta',
					'schema' => "CREATE TABLE `{table_prefix}bwf_contact_meta` (
					`meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
					`contact_id` bigint(20) unsigned NOT NULL DEFAULT '0',
					`meta_key` varchar(50) DEFAULT NULL,    
					`meta_value` longtext,
					PRIMARY KEY (`meta_id`)
		            ) {table_collate};",
				];
			}

			if ( $tables['version'] !== BWF_DB_VERSION || ! in_array( 'bwf_wc_customers', $tables['tables'], true ) ) {
				$args[] = [
					'name'   => 'bwf_wc_customers',
					'schema' => "CREATE TABLE `{table_prefix}bwf_wc_customers` (
	                `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
	                `cid` int(12) NOT NULL,
	                `l_order_date` DateTime NOT NULL,
	                `f_order_date` DateTime NOT NULL,
	                `total_order_count` int(7) NOT NULL,
	                `total_order_value` double NOT NULL,
	                `aov` double NOT NULL,
	                `purchased_products` longtext,
	                `purchased_products_cats` longtext,
	                `purchased_products_tags` longtext,
	                `used_coupons` longtext,
	                PRIMARY KEY (`id`),
	                KEY `id` (`id`), 
	                UNIQUE KEY `cid` (`cid`)
	                )  {table_collate};",
				];
			}

			if ( $tables['version'] !== BWF_DB_VERSION || ! in_array( 'wfco_report_views', $tables['tables'], true ) ) {
				$args[] = [
					'name'   => 'wfco_report_views',
					'schema' => "CREATE TABLE `{table_prefix}wfco_report_views` (
					id bigint(20) unsigned NOT NULL auto_increment,
					date date NOT NULL,
					no_of_sessions int(11) NOT NULL DEFAULT '1',
					object_id bigint(20) DEFAULT '0',
					type tinyint(2) NOT NULL COMMENT '1 - Abandonment 2 - Landing visited 3 - Landing converted 4 - Aero visited 5- Thank you visited 6 - NextMove 7 - Funnel session 8-Optin visited 9-Optin converted 10- Optin thank you visited 11- Optin thank you converted' DEFAULT '1',
					PRIMARY KEY  (id),
					KEY date (date),
					KEY object_id (object_id),
					KEY type (type)
				) {table_collate};",
				];
			}


			return $args;
		}
	}

	WooFunnels_DB_Tables::get_instance();
}