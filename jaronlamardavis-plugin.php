<?php
/**
 * Plugin Name: Jaron Lamar Davis
 * Plugin URI: https://github.com/nateconley/jaronlamardavis-plugin
 * Description: For Custom Functionality
 * Author: Nate Conley
 * Author URI: http://nateconley.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
class Jldavis_Plugin {
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
	private function __construct() {
		// Add front page metaboxes
		add_action( 'cmb2_admin_init', array( $this, 'front_page_metaboxes' ) );
	}

	/**
	 * Add custom metaboxes to front page
	 */
	public function front_page_metaboxes() {
		// Our custom prefix
		$prefix = 'jldavis';

		// Initiate new metabox
		$cmb = new_cmb2_box( array(
			'id' 		=> 'front_page_images',
			'title' 	=> 'Home page images',
			'object_types' => array( 'page' ),
			'show_on' 	=> array( 
								'key' => 'id',
								'value' => 5
							),
		) );

		$cmb->add_field( array(
		    'name'    => 'Image One',
		    'desc'    => 'Upload an image or enter an URL.',
		    'id'      => $prefix . '_front_page_image_one',
		    'type'    => 'file',
		    'text'    => array(
		        'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
		    ),
		) );

		$cmb->add_field( array(
		    'name'    => 'Image Two',
		    'desc'    => 'Upload an image or enter an URL.',
		    'id'      => $prefix . '_front_page_image_two',
		    'type'    => 'file',
		    'text'    => array(
		        'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
		    ),
		) );

		$cmb->add_field( array(
		    'name'    => 'Image Three',
		    'desc'    => 'Upload an image or enter an URL.',
		    'id'      => $prefix . '_front_page_image_three',
		    'type'    => 'file',
		    'text'    => array(
		        'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
		    ),
		) );

		// Initiate new metabox
		$cmb2 = new_cmb2_box( array(
			'id' 		=> 'front_page_bio',
			'title' 	=> 'Home page bio excerpt',
			'object_types' => array( 'page' ),
			'show_on' 	=> array( 
								'key' => 'id',
								'value' => 5
							),
		) );

		$cmb2->add_field( array(
			'name'    => 'The text:',
		    'id'      => $prefix . '_front_page_bio',
		    'type'    => 'wysiwyg',
		) );
	}
}

$jldavis_plugin = Jldavis_Plugin::get_instance();