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

		// Add media page metaboxes
		add_action( 'cmb2_admin_init', array( $this, 'media_metaboxes' ) );
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

	public function media_metaboxes() {
		// Our custom prefix
		$prefix = 'jldavis';

		// Initiate new metabox
		$cmb = new_cmb2_box( array(
	        'id'            => 'test_metabox',
	        'title'         => __( 'Media', 'cmb2' ),
	        'object_types'  => array( 'page', ), // Post type
	        'show_on'		=> array( 'key' => 'id', 'value' => 9 ),
	        'context'       => 'normal',
	        'priority'      => 'high',
	        'show_names'    => true,
	    ) );

		// group field
		$group_field_id = $cmb->add_field( array(
		    'id'          => 'media_repeat_group',
		    'type'        => 'group',
		    'options'     => array(
		        'group_title'   => __( 'Entry {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
		        'add_button'    => __( 'Add Another Entry', 'cmb2' ),
		        'remove_button' => __( 'Remove Entry', 'cmb2' ),
		        'sortable'      => true,
		    ),
		) );

		$cmb->add_group_field( $group_field_id, array(
		    'name' => 'Caption (All Media Types)',
		    'id'   => 'caption',
		    'type' => 'text',
		) );

		$cmb->add_group_field( $group_field_id, array(
		    'name'    => 'Media Type',
		    'id'      => 'media_type',
		    'type'    => 'radio_inline',
		    'options' => array(
		        'video'		=> 'Video',
		        'picture'	=> 'Picture',
		        'article'	=> 'Article',
		        'music'		=> 'Music',
		    ),
		    'default' => 'picture',
		) );

		$cmb->add_group_field( $group_field_id, array(
		    'name' => 'oEmbed (Video)',
		    'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
		    'id'   => 'oembed',
		    'type' => 'oembed',
		) );

		$cmb->add_group_field( $group_field_id, array(
		    'name'    => 'Image (Picture, Article, Music)',
		    'desc'    => 'Upload an image.',
		    'id'      => 'image',
		    'type'    => 'file',
		    // Optional:
		    'options' => array(
		        'url' => true, // Hide the text input for the url
		    ),
		    'text'    => array(
		        'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
		    ),
		    // query_args are passed to wp.media's library query.
		    'query_args' => array(
		        'type' => 'application/pdf', // Make library only display PDFs.
		    ),
		) );

		$cmb->add_group_field( $group_field_id, array(
		    'name' => 'Url (Article, Music)',
		    'id'   => 'url',
		    'type' => 'text_url',
		) );
	}
}

$jldavis_plugin = Jldavis_Plugin::get_instance();