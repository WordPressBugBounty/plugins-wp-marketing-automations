<?php


namespace Action_Scheduler\Migration;

/**
 * Class ActionMigrator
 *
 * @package Action_Scheduler\Migration
 *
 * @since 3.0.0
 *
 * @codeCoverageIgnore
 */
class ActionMigrator {
	/**
	 * Source store instance.
	 *
	 * @var ActionScheduler_Store
	 */
	private $source;

	/**
	 * Destination store instance.
	 *
	 * @var ActionScheduler_Store
	 */
	private $destination;

	/**
	 * LogMigrator instance.
	 *
	 * @var LogMigrator
	 */
	private $log_migrator;

	/**
	 * ActionMigrator constructor.
	 *
	 * @param \ActionScheduler_Store $source_store Source store object.
	 * @param \ActionScheduler_Store $destination_store Destination store object.
	 * @param LogMigrator            $log_migrator Log migrator object.
	 */
	public function __construct( \ActionScheduler_Store $source_store, \ActionScheduler_Store $destination_store, LogMigrator $log_migrator ) {
		$this->source       = $source_store;
		$this->destination  = $destination_store;
		$this->log_migrator = $log_migrator;
	}

	/**
	 * Migrate an action.
	 *
	 * @param int $source_action_id Action ID.
	 *
	 * @return int 0|new action ID
	 * @throws \RuntimeException When unable to delete action from the source store.
	 */
	public function migrate( $source_action_id ) {
		try {
			$action = $this->source->fetch_action( $source_action_id );
			$status = $this->source->get_status( $source_action_id );
		} catch ( \Exception $e ) {
			$action = null;
			$status = '';
		}

		if ( is_null( $action ) || empty( $status ) || ! $action->get_schedule()->get_date() ) {
			// null action or empty status means the fetch operation failed or the action didn't exist.
			// null schedule means it's missing vital data.
			// delete it and move on.
			try {
				$this->source->delete_action( $source_action_id );
			} catch ( \Exception $e ) { // phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch
				// nothing to do, it didn't exist in the first place.
			}
			do_action( 'action_scheduler/no_action_to_migrate', $source_action_id, $this->source, $this->destination ); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores

			return 0;
		}

		try {

			// Make sure the last attempt date is set correctly for completed and failed actions.
			$last_attempt_date = ( \ActionScheduler_Store::STATUS_PENDING !== $status ) ? $this->source->get_date( $source_action_id ) : null;

			$destination_action_id = $this->destination->save_action( $action, null, $last_attempt_date );
		} catch ( \Exception $e ) {
			do_action( 'action_scheduler/migrate_action_failed', $source_action_id, $this->source, $this->destination ); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores

			return 0; // could not save the action in the new store.
		}

		try {
			switch ( $status ) {
				case \ActionScheduler_Store::STATUS_FAILED:
					$this->destination->mark_failure( $destination_action_id );
					break;
				case \ActionScheduler_Store::STATUS_CANCELED:
					$this->destination->cancel_action( $destination_action_id );
					break;
			}

			$this->log_migrator->migrate( $source_action_id, $destination_action_id );
			$this->source->delete_action( $source_action_id );

			$test_action = $this->source->fetch_action( $source_action_id );
			if ( ! is_a( $test_action, 'ActionScheduler_NullAction' ) ) {
				// translators: %s is an action ID.
				throw new \RuntimeException( sprintf( __( 'Unable to remove source migrated action %s', 'woocommerce' ), $source_action_id ) ); // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch
			}
			do_action( 'action_scheduler/migrated_action', $source_action_id, $destination_action_id, $this->source, $this->destination ); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores

			return $destination_action_id;
		} catch ( \Exception $e ) {
			// could not delete from the old store.
			$this->source->mark_migrated( $source_action_id );

			// phpcs:disable WordPress.NamingConventions.ValidHookName.UseUnderscores
			do_action( 'action_scheduler/migrate_action_incomplete', $source_action_id, $destination_action_id, $this->source, $this->destination );
			do_action( 'action_scheduler/migrated_action', $source_action_id, $destination_action_id, $this->source, $this->destination );
			// phpcs:enable

			return $destination_action_id;
		}
	}
}
