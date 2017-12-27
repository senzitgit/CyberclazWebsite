<?php
/* "Copyright 2012 a3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
A3rev Plugin Admin UI

TABLE OF CONTENTS

- var plugin_name
- var admin_plugin_url
- var admin_plugin_dir
- var admin_pages
- admin_plugin_url()
- admin_plugin_dir()
- admin_pages()
- plugin_extension_start()
- plugin_extension_end()
- pro_fields_before()
- pro_fields_after()
- blue_message_box()

-----------------------------------------------------------------------------------*/

class People_Contact_Admin_UI
{
	/**
	 * @var string
	 * You must change to correct plugin name that you are working
	 */
	public $plugin_name = 'contact_people_ultimate';

	public $google_api_key_option = 'contact_people_ultimate_google_api_key';

	public $toggle_box_open_option = 'contact_people_ultimate_toggle_box_open';

	
	public $is_free_plugin = true;
	
	/**
	 * @var string
	 * You must change to correct class name that you are working
	 */
	public $class_name = 'WP_People_Contact';

	/**
	 * @var string
	 * You must change to correct pro plugin page url on a3rev site
	 */
	public $pro_plugin_page_url = 'http://a3rev.com/shop/contact-us-page-contact-people/';
	
	public $ultimate_plugin_page_url = 'http://a3rev.com/shop/contact-people-ultimate/';
	
	/**
	 * @var string
	 */
	public $admin_plugin_url;

	/**
	 * @var string
	 */
	public $admin_plugin_dir;

	/**
	 * @var array
	 * You must change to correct page you want to include scripts & styles, if you have many pages then use array() : array( 'quotes-orders-mode', 'quotes-orders-rule' )
	 */
	public $admin_pages = array( 'people-contact-manager', 'people-contact', 'people-category-manager' );


	/*-----------------------------------------------------------------------------------*/
	/* admin_plugin_url() */
	/*-----------------------------------------------------------------------------------*/
	public function admin_plugin_url() {
		if ( $this->admin_plugin_url ) return $this->admin_plugin_url;
		return $this->admin_plugin_url = untrailingslashit( plugins_url( '/', __FILE__ ) );
	}

	/*-----------------------------------------------------------------------------------*/
	/* admin_plugin_dir() */
	/*-----------------------------------------------------------------------------------*/
	public function admin_plugin_dir() {
		if ( $this->admin_plugin_dir ) return $this->admin_plugin_dir;
		return $this->admin_plugin_dir = untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/*-----------------------------------------------------------------------------------*/
	/* admin_pages() */
	/*-----------------------------------------------------------------------------------*/
	public function admin_pages() {
		$admin_pages = apply_filters( $this->plugin_name . '_admin_pages', $this->admin_pages );

		return (array)$admin_pages;
	}

	public function plugin_extension_boxes( $echo = false ) {

		/**
		 * extension_boxes
		 * =============================================
		 * array (
		 *		'id'				=> 'box_id'						: Enter unique your box id
		 *		'content'			=> 'html_content' 				: (required) Enter the html content to show inside the box
		 * 		'css'				=> 'custom style'				: custom style for the box container
		 * )
		 *
		 */
		$extension_boxes = apply_filters( $this->plugin_name . '_plugin_extension_boxes', array() );

		$output = '';
		if ( is_array( $extension_boxes ) && count( $extension_boxes ) > 0 ) {
			foreach ( $extension_boxes as $box ) {
				if ( ! isset( $box['id'] ) ) $box['id'] = '';
				if ( ! isset( $box['css'] ) ) $box['css'] = '';
				if ( ! isset( $box['content'] ) ) $box['content'] = '';

				$output .= '<div id="'. esc_attr( $box['id'] ) .'" class="a3_plugin_panel_extension_box" style="'. esc_attr( $box['css'] ) .'">';
				$output .= $box['content'];
				$output .= '</div>';
			}
		}

		if ( $echo )
			echo $output;
		else
			return $output;
	}

	/*-----------------------------------------------------------------------------------*/
	/* plugin_extension_start() */
	/* Start of yellow box on right for pro fields
	/*-----------------------------------------------------------------------------------*/
	public function plugin_extension_start( $echo = true ) {
		$output = '<div id="a3_plugin_panel_container">';
		$output .= '<div id="a3_plugin_panel_upgrade_area">';
		$output .= '<div id="a3_plugin_panel_extensions">';
		$output .= $this->plugin_extension_boxes( false );
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<div id="a3_plugin_panel_fields">';

		$output = apply_filters( $this->plugin_name . '_plugin_extension_start', $output );

		if ( $echo )
			echo $output;
		else
			return $output;
	}

	/*-----------------------------------------------------------------------------------*/
	/* plugin_extension_start() */
	/* End of yellow box on right for pro fields
	/*-----------------------------------------------------------------------------------*/
	public function plugin_extension_end( $echo = true ) {
		$output = '</div>';
		$output .= '</div>';

		$output = apply_filters( $this->plugin_name . '_plugin_extension_end', $output );

		if ( $echo )
			echo $output;
		else
			return $output;

	}

	/*-----------------------------------------------------------------------------------*/
	/* upgrade_top_message() */
	/* Show upgrade top message for pro fields
	/*-----------------------------------------------------------------------------------*/
	public function upgrade_top_message( $echo = false, $setting_id = '' ) {
		$upgrade_top_message = sprintf( '<div class="pro_feature_top_message">'
			. __( 'Advanced Settings - Upgrade to the <a href="%s" target="_blank">%s License</a> to activate these settings.', 'cup_cp' )
			. '</div>'
			, apply_filters( $this->plugin_name . '_' . $setting_id . '_pro_plugin_page_url', apply_filters( $this->plugin_name . '_pro_plugin_page_url', $this->pro_plugin_page_url ) )
			, apply_filters( $this->plugin_name . '_' . $setting_id . '_pro_version_name', apply_filters( $this->plugin_name . '_pro_version_name', __( 'Pro Version', 'cup_cp' ) ) )
		);

		$upgrade_top_message = apply_filters( $this->plugin_name . '_upgrade_top_message', $upgrade_top_message, $setting_id );

		if ( $echo ) echo $upgrade_top_message;
		else return $upgrade_top_message;

	}

	/*-----------------------------------------------------------------------------------*/
	/* pro_fields_before() */
	/* Start of yellow box on right for pro fields
	/*-----------------------------------------------------------------------------------*/
	public function pro_fields_before( $echo = true ) {
		echo apply_filters( $this->plugin_name . '_pro_fields_before', '<div class="pro_feature_fields">'. $this->upgrade_top_message() );
	}

	/*-----------------------------------------------------------------------------------*/
	/* pro_fields_after() */
	/* End of yellow border for pro fields
	/*-----------------------------------------------------------------------------------*/
	public function pro_fields_after( $echo = true ) {
		echo apply_filters( $this->plugin_name . '_pro_fields_after', '</div>' );
	}

	/*-----------------------------------------------------------------------------------*/
	/* blue_message_box() */
	/* Blue Message Box
	/*-----------------------------------------------------------------------------------*/
	public function blue_message_box( $message = '', $width = '600px' ) {
		$message = '<div class="a3rev_blue_message_box_container" style="width:'.$width.'"><div class="a3rev_blue_message_box">' . $message . '</div></div>';
		$message = apply_filters( $this->plugin_name . '_blue_message_box', $message );

		return $message;
	}

}

?>
