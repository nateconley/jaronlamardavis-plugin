<?php
/**
 *
 */
class JlDavis_Plugin {
	/**
	 * Unique instance
	 */
	private static $instance;

	/**
	 * Get instance
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor
	 */
	private static __construct() {
		
	}
}