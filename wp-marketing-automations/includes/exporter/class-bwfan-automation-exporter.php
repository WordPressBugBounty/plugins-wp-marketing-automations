<?php

namespace BWFAN\Exporter;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/***
 * Class Automation_Exporter
 *
 * @package Autonami
 */
class Automation extends Base {

	public $export_id = 0;
	/**
     * Class constructor
     */
    public function __construct() {
        $this->type = 'automation';
    }

    /**
     * Handle automation export
     *
	 * @param $user_id
	 * @param $export_id
	 *
	 * @return void
	 */
    public function handle_export( $user_id, $export_id = 0 ){
		$this->export_id = $export_id;
        $get_export_automations_data = BWFAN_Core()->automations->get_json( '', 2 );
        $status_data = [
            'status' => 3,
            'msg' => [
                'Unable to create export file.',
            ]
        ];

        $filename = 'automation-export-'.time().'.json';

        if ( ! file_exists( self::$export_folder . '/' ) ) {
            wp_mkdir_p( self::$export_folder );
        }

        $res = file_put_contents( self::$export_folder . '/' . $filename, $get_export_automations_data, 8 );

        if ( $res ) {
            $status_data = [
                'status' => 2,
                'url' => self::$export_folder . '/' . $filename,
                'msg' => [
                    __( 'File created successfully', 'wp-marketing-automations' )
                ]
            ];
        }

        $user_data = get_user_meta( $user_id, 'bwfan_single_export_status', true );

        $user_data[ $this->type ] = $status_data;

        update_user_meta( $user_id, 'bwfan_single_export_status', $user_data );

	    BWFAN_Core()->exporter->unschedule_export_action( [
		    'type'      => $this->type,
		    'user_id'   => $user_id,
		    'export_id' => $this->export_id
	    ] );
    }
}

/**
 * Register exporter
 */
BWFAN_Core()->exporter->register_exporter( 'automation', 'BWFAN\Exporter\Automation' );