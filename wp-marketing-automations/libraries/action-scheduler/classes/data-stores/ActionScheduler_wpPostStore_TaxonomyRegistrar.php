<?php

/**
 * Class ActionScheduler_wpPostStore_TaxonomyRegistrar
 *
 * @codeCoverageIgnore
 */
class ActionScheduler_wpPostStore_TaxonomyRegistrar {

	/**
	 * Registrar.
	 */
	public function register() {
		register_taxonomy( ActionScheduler_wpPostStore::GROUP_TAXONOMY, ActionScheduler_wpPostStore::POST_TYPE, $this->taxonomy_args() );
	}

	/**
	 * Get taxonomy arguments.
	 */
	protected function taxonomy_args() {
		$args = array(
			'label'             => __( 'Action Group', 'woocommerce' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch
			'public'            => false,
			'hierarchical'      => false,
			'show_admin_column' => true,
			'query_var'         => false,
			'rewrite'           => false,
		);

		$args = apply_filters( 'action_scheduler_taxonomy_args', $args );
		return $args;
	}
}
