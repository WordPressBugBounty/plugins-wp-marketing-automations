<?php

namespace BWFAN\Exporter;

/**
 * Calls base class
 */
abstract class Base {

	/** Handle exporter response type */
	public static $EXPORTER_ONGOING = 1;
	public static $EXPORTER_SUCCESS = 2;
	public static $EXPORTER_FAILED = 3;

	/** Export folder */
	public static $export_folder = WP_CONTENT_DIR . '/uploads/woofunnels-upload/autonami-single-export';

	/**
	 * Exporter Type
	 *
	 * @var string
	 */
	protected $type = '';

	/**
	 * Abstract function to process export action
	 *
	 * @param $user_id
	 * @param $export_id
	 *
	 * @return mixed
	 */
	abstract public function handle_export( $user_id, $export_id = 0 );

	/**
	 * Save processed and count data in table
	 *
	 * @return mixed
	 */
	public function maybe_insert_data_in_table() {
	}
}
