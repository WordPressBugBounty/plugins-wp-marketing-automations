<?php

class BWFAN_Model_Tasks extends BWFAN_Model {
	static $primary_key = 'ID';

	public static function get_tasks( $automation_ids ) {
		global $wpdb;

		if ( ! is_array( $automation_ids ) || count( $automation_ids ) === 0 ) {
			return array();
		}

		$automationCount         = count( $automation_ids );
		$stringPlaceholders      = array_fill( 0, $automationCount, '%s' );
		$placeholders_automation = implode( ', ', $stringPlaceholders );
		$sql_query               = "Select * FROM {table_name} WHERE automation_id IN ($placeholders_automation)";
		$sql_query               = $wpdb->prepare( $sql_query, $automation_ids ); // WPCS: unprepared SQL OK
		$active_tasks            = self::get_results( $sql_query );

		return $active_tasks;
	}

	/**
	 * Return Task detail with its meta details
	 *
	 * @param $task_id
	 *
	 * @return array|object|void|null
	 */
	public static function get_task_with_data( $task_id ) {

		$task = self::get( $task_id );
		if ( ! is_array( $task ) || empty( $task ) ) {
			return [];
		}
		$task['meta'] = BWFAN_Model_Taskmeta::get_task_meta( $task_id );

		return $task;

	}

	/**
	 * Check if any task is available for execution.
	 *
	 * @return bool
	 */
	public static function maybe_tasks_available() {
		global $wpdb;
		$time  = current_time( 'timestamp', 1 );
		$table = self::_table();
		$query = $wpdb->prepare( "SELECT MAX(`ID`) FROM {$table} WHERE `e_date` < %s AND `status` = 0", $time );
		$count = $wpdb->get_var( $query ); //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
		if ( empty( $count ) ) {
			return false;
		}

		return true;
	}

}
