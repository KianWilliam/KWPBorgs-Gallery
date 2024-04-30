<?php


/**
 * KWPBorgs Gallery
 *
 * @package   KWPBorgs_Gallery
 * @author    KWProductions Co.
 * @license   GPL-2.0+
 * @link      https://extensions.kwproductions121.ir
 * @copyright All rights reserved
 */


/**
 * -----------------------------------------
 * Added for security reasons: http://codex.wordpress.org/Theme_Development#Template_Files
 * -----------------------------------------
 */
defined( 'ABSPATH' ) || exit;
/*-----------------------------------------*/

class Kwpborgs_Gallery_Admin_Metaboxes {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Sreens to display the custom metabox.
	 *
	 * @since 1.0.0
	 * @var array
	 */
	private $screens = array(
		'entries',
	);

	/**
	 * Metabox fields
	 *
	 * @since 1.0.0
	 * @var array
	 */
	private $fields = array();
	public $kwpborgs_gallery_defaults;

	/**
	 * Initialize the class
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		
		$this->fields = $this->metabox_fields();

		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'admin_footer' ) );
		
			
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
	

	/**
	 * Generate metabox fields.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function metabox_fields() {
		$meta_fields = array(
			array(
				'id'          => 'title',
				'label'       => esc_html__( 'Title', 'kwpborgs-gallery' ),
				'placeholder' => esc_html__( 'Borgs Lost!', 'kwpborgs-gallery' ),
				'type'        => 'text',
				'description' => esc_html__( 'Title of the gallery.', 'kwpborgs-gallery' ),
			),
		
		
			array(
				'id'          => 'imagespaths',
				'label'       => esc_html__( 'Images Paths(Select from media button bellow!)', 'kwpborgs-gallery' ),
				'placeholder' => esc_html__( 'Borgs Lost! | Borgs Died! ', 'kwpborgs-gallery' ),
				'type'        => 'textarea',
				'description' => esc_html__( 'The paths to the images you choose from upload image button .', 'kwpborgs-gallery' ),
			),
			
				array(
				'id'          => 'imagestexts',
				'label'       => esc_html__( 'Images Details', 'kwpborgs-gallery' ),
				'type'        => 'textarea',
				'placeholder' => esc_html__( 'haha 1 | haha 2', 'kwpborgs-gallery' ),
				'description' => esc_html__( 'Input the images details and separate them with | as the example!', 'kwpborgs-gallery' ),

			),
	
				array(
				'id'      => 'lib',
				'label'   => esc_html__( 'Include jQuery', 'kwpborgs-gallery' ),
				'type'    => 'select',
				'options' => array(
					'no'=> esc_html__( 'Disable jQuery', 'kwpborgs-gallery' ),
					 'yes'=>esc_html__( 'Enable jQuery', 'kwpborgs-gallery' ),
				),
		'default'=>'no'
				),
					array(
				'id'          => 'images',
				'label'       => esc_html__( 'Images Upload', 'kwpborgs-gallery' ),
				'type'        => 'media',
				'placeholder' => esc_html__( 'Upload Image(s)', 'kwpborgs-gallery' ),
			),
				 
			
				array(
				'id'          => 'cubeleft',
				'label'       => esc_html__( 'Cube Left', 'kwpborgs-gallery' ),
				'type'        => 'number',
				'description' => esc_html__( 'The left distance of the cube gallery', 'kwpborgs-gallery' ),
				'default' => 1, 
			),
			
				array(
				'id'          => 'cubetop',
				'label'       => esc_html__( 'Cube Top', 'kwpborgs-gallery' ),
				'type'        => 'number',
				'description' => esc_html__( 'The top distance of the cube gallery', 'kwpborgs-gallery' ),
				'default' => 1, 
			),
			
				array(
				'id'          => 'imagewidth',
				'label'       => esc_html__( 'Image Width', 'kwpborgs-gallery' ),
				'type'        => 'number',
				'description' => esc_html__( 'The width of the image to be processed', 'kwpborgs-gallery' ),
				'default' => 300, 
			),
			
			
				array(
				'id'          => 'imageheight',
				'label'       => esc_html__( 'Image Height', 'kwpborgs-gallery' ),
				'type'        => 'number',
				'description' => esc_html__( 'The height of the image to be processed', 'kwpborgs-gallery' ),
				'default' => 300, 
			),
			
			
				array(
				'id'          => 'rows',
				'label'       => esc_html__( 'Rows', 'kwpborgs-gallery' ),
				'type'        => 'number',
				'description' => esc_html__( 'The rows to be applied to the image to be processed', 'kwpborgs-gallery' ),
				'default' => 10, 
			),
			
			
				array(
				'id'          => 'cols',
				'label'       => esc_html__( 'Columns', 'kwpborgs-gallery' ),
				'type'        => 'number',
				'description' => esc_html__( 'The columns to be applied to the image to be processed', 'kwpborgs-gallery' ),
				'default' => 10, 
			),
			
			
				array(
				'id'          => 'cubespeed',
				'label'       => esc_html__( 'Cube Speed', 'kwpborgs-gallery' ),
				'type'        => 'number',
				'description' => esc_html__( 'The speed of cube while spinning!', 'kwpborgs-gallery' ),
				'default' => 5000, 
			),
			
			
				array(
				'id'          => 'imagespeed',
				'label'       => esc_html__( 'Cube Dimension Speed', 'kwpborgs-gallery' ),
				'type'        => 'number',
				'description' => esc_html__( 'The speed of building each dimension of the cube!', 'kwpborgs-gallery' ),
				'default' => 10000, 
			),
			
			
			array(
				'id'      => 'axis',
				'label'   => esc_html__( 'Select Axis', 'kwpborgs-gallery' ),
				'type'    => 'select',
				'options' => array(
					'X'  => esc_html__( 'X', 'kwpborgs-gallery' ),
					'Y'   => esc_html__( 'Y', 'kwpborgs-gallery' ),			
				),
				'default'=>'X',
			),
				array(
				'id'          => 'cubebackcolor',
				'label'       => esc_html__( 'Cube Background Color', 'kwpborgs-gallery' ),
				'type'        => 'color',
				'description' => esc_html__( 'This is cube background color.', 'kwpborgs-gallery' ),
				'default' => '#000000',
			),
			
			
				array(
				'id'          => 'dimensionbackcolor',
				'label'       => esc_html__( 'Cube Dimension Background Color', 'kwpborgs-gallery' ),
				'type'        => 'color',
				'description' => esc_html__( 'This is cube dimension background color.', 'kwpborgs-gallery' ),
				'default' => '#ffffff',
			),
			
			
		);
		return apply_filters( 'kwpborgs_gallery_meta_fields', $meta_fields );
	}

	/**
	 * Add Meta Boxes
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function add_meta_boxes() {
		
		foreach ( $this->screens as $screen ) {
			add_meta_box(
				'kwpborgs_gallery_data',
				esc_html__( 'KWPborgs Gallery Metaboxes', 'kwpborgs-gallery' ),
				array( $this, 'kwpborgs_gallery_meta_box_callback' ),
				$screen,
				'normal',
				'high'
			);
		}
		
	}

	/**
	 * Generates the HTML for the meta box
	 *
	 * @param object $post WordPress post object.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function kwpborgs_gallery_meta_box_callback( $data ) {
		wp_nonce_field( 'kwpborgs_gallery_data', 'kwpborgs_gallery_nonce' );
		$this->generate_fields( $data );
	}

	/**
	 * Adds scripts for media uploader.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function admin_footer() {
		
		    wp_enqueue_media();
	
	}

	/**
	 * Generates the field's HTML for the meta box.
	 *
	 * @param object $post The post object.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function generate_fields( $data ) {
		$output = '';
      $d = (array) $data;

		foreach ( $this->fields as $field ) {
			$label       = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
		
			
	
			if(isset($data) && $data!==NULL && $field['id']!=='images' && !empty($d[$field['id']]))
			$db_value    = $d[$field['id']];
		    else
				if(isset($field['default']) && !empty($field['default']) &&  $field['id']!=='images')
			$db_value = $field['default'];
		      else
				  $db_value = '';
			$description = isset( $field['description'] ) ? esc_html( $field['description'] ) : '';

			switch ( $field['type'] ) {
				case 'checkbox':
					$input = sprintf(
						'<input %s id="%s" name="%s" type="checkbox" value="1">',
						'1' === $db_value ? 'checked' : '',
						$field['id'],
						$field['id']
					);
					break;
				case 'media':
					$input = sprintf(
						'<input class="regular-text file_url" id="%s" name="%s" type="text" placeholder="%s" value="%s"> <input class="button kwpborgs-gallery-media" id="%s_button" name="%s_button" data-uploader_button_text="Upload an image" type="button" value="Upload" />',
						$field['id'],
						$field['id'],
						$field['placeholder'],
						$db_value,
						$field['id'],
						$field['id']
					);
					break;
				case 'radio':
					$input  = '<fieldset>';
					$input .= '<legend class="screen-reader-text">' . $field['label'] . '</legend>';
					$i      = 0;
					foreach ( $field['options'] as $key => $value ) {
						$field_value = !is_numeric( $key ) ? $key : $value;
						$input .= sprintf(
							'<label><input %s id="%s" name="%s" type="radio" value="%s"> %s</label>%s',
							$db_value === $field_value ? 'checked' : '',
							$field['id'],
							$field['id'],
							$field_value,
							$value,
							$i < count( $field['options'] ) - 1 ? '<br>' : ''
						);
						$i++;
					}
					$input .= '</fieldset>';
					break;
				case 'select':
					$input = sprintf(
						'<select id="%s" name="%s">',
						$field['id'],
						$field['id']
					);
					foreach ( $field['options'] as $key => $value ) {
						$field_value = ! is_numeric( $key ) ? $key : $value;
						$input      .= sprintf(
							'<option %s value="%s">%s</option>',
							$db_value === $field_value ? 'selected' : '',
							$field_value,
							$value
						);
					}
					$input .= '</select>';
					break;
				case 'textarea':
					$input = sprintf(
						'<textarea class="large-text" id="%s" name="%s" placeholder="%s" rows="5">%s</textarea>',
						$field['id'],
						$field['id'],
						$field['placeholder'],
						$db_value
					);
					break;
				case 'number':
					$input = sprintf(
						'<input class="small-text" id="%s" name="%s" type="%s" value="%s" size="30"><div class="description">%s</div>',
						$field['id'],
						$field['id'],
						$field['type'],
						$db_value,
						$description
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s"><div class="description">%s</div>',
						'color' !== $field['type'] ? 'class="regular-text"' : '',
						$field['id'],
						$field['id'],
						$field['type'],
						$db_value,
						$description
					);
			}
			$output .= sprintf(
				'<tr><th scope="row">%s</th><td>%s</td></tr>',
				$label,
				$input
			);
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}

	/**
	 * Hooks into WordPress' save_post function.
	 *
	 * @param int $post_id Post ID.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function kwpborgs_gallery_sanitize_options( $input) {
		
			$valid = array();
				$valid = $input;
				$error = "";
			
				$valid['title']=wp_kses_post($input['title']);
							
				if(empty($valid['title']))
				{
					add_settings_error('kwpborgs_gallery', esc_attr('mycode121'), __("title can not be empty ", "wpse"), 'error' );
					$valid['title'] = wp_kses_post('coward stupid borgs are lost!');
				}
	
		return $valid;
	}
}
