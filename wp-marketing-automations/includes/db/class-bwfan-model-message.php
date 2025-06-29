<?php

if ( ! class_exists( 'BWFAN_Model_Message' ) && BWFAN_Common::is_pro_3_0() ) {

	class BWFAN_Model_Message extends BWFAN_Model {
		static $primary_key = 'ID';

		public static function get_messages( $args = array() ) {
			global $wpdb;
			$table = self::_table();

			$sql = "SELECT * FROM {$table}";
			if ( ! is_array( $args ) || empty( $args ) ) {
				return $wpdb->get_results( $sql, ARRAY_A ); //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
			}

			$where_sql = ' WHERE 1=1';

			/** Get by Track id */
			if ( isset( $args['track_id'] ) && ! empty( $args['track_id'] ) ) {
				$where_sql .= " AND track_id = '{$args['track_id']}'";
			}

			/** Get by Subject */
			if ( isset( $args['sub'] ) && ! empty( $args['sub'] ) ) {
				$where_sql .= " AND sub = {$args['sub']}";
			}

			/** Get by Body */
			if ( isset( $args['body'] ) && ! empty( $args['body'] ) ) {
				$where_sql .= " AND body = {$args['body']}";
			}

			/** Set Pagination */
			$pagination_sql = '';
			$limit          = isset( $args['limit'] ) ? absint( $args['limit'] ) : 0;
			$offset         = isset( $args['offset'] ) ? absint( $args['offset'] ) : 0;
			if ( ! empty( $limit ) || ! empty( $offset ) ) {
				$pagination_sql = " limit $offset, $limit";
			}

			$sql = $sql . $where_sql . $pagination_sql;
//		$total_sql   = "SELECT count(*) FROM {$table}" . $where_sql;
//		$grab_totals = isset( $args['grab_totals'] ) && ! empty( absint( $args['grab_totals'] ) );

			return $wpdb->get_results( $sql, ARRAY_A ); //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
		}

		public static function get_message_by_track_id( $track_id ) {
			global $wpdb;
			$table = self::_table();
			if ( is_array( $track_id ) ) {
				$placeholders = array_fill( 0, count( $track_id ), '%d' );
				$placeholders = implode( ', ', $placeholders );
				$sql          = "SELECT ID,sub as subject, body as template, data, track_id FROM {$table} WHERE track_id IN ($placeholders)";

				return $wpdb->get_results( $wpdb->prepare( $sql, $track_id ), ARRAY_A ); //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
			}

			$sql = "SELECT ID,sub as subject, body as template, data FROM {$table} WHERE track_id = %d LIMIT 0, 1";

			return $wpdb->get_row( $wpdb->prepare( $sql, $track_id ), ARRAY_A ); //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
		}
	}
}