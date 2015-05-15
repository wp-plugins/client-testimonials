<?php
/*
Plugin Name: Client Testimonials
Plugin URI: http://wordpress.org/plugins/client-testimonials/
Description: Adds a custom post type for client testimonials.
Author: Sayful Islam
Version: 2.0.0
Author URI: http://sayful.net
License: GPLv2
*/

if (!class_exists('Client_Testimonials')):

class Client_Testimonials {

	/**
     * Start up
     */
	public function __construct(){
		add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts' ));
		add_action('init', array( $this, 'testimonials_post_type' ));
		add_action('save_post', array( $this, 'testimonials_save_post' ));
		add_filter( 'manage_edit-testimonials_columns', array( $this, 'testimonials_edit_columns' ));
		add_action( 'manage_posts_custom_column', array( $this, 'testimonials_columns'), 10, 2 );
		add_action('admin_head', array( $this, 'add_mce_button' ));
	}

	/**
	 * Enqueue the stylesheet
	 *
	 * This functions is attached to the 'wp_enqueue_scripts' action hook.
	 */
	public function enqueue_scripts(){
		//Only add these script if we are not in the admin dashboard
		if(!is_admin()){
			//Enqueing scripts
			wp_enqueue_script('jquery');
		    wp_enqueue_script('testimonials_script',plugins_url( '/js/script.js' , __FILE__ ),array( 'jquery' ));
		    wp_enqueue_script('sis_carousel_main_script',plugins_url( '/js/owl.carousel.js' , __FILE__ ),array( 'jquery' ));
		    wp_enqueue_style( 'testimonials_css', plugins_url( '/css/style.css', __FILE__ ) );
		}
	}

	/**
	 * Creating the custom post type
	 *
	 * This functions is attached to the 'init' action hook.
	 */
	public function testimonials_post_type(){
		$labels = array(
			'name' => 'Testimonials',
			'singular_name' => 'Testimonial',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Testimonial',
			'edit_item' => 'Edit Testimonial',
			'new_item' => 'New Testimonial',
			'view_item' => 'View Testimonial',
			'search_items' => 'Search Testimonials',
			'not_found' =>  'No Testimonials found',
			'not_found_in_trash' => 'No Testimonials in the trash',
			'parent_item_colon' => '',
		);

		register_post_type( 'testimonials', array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'exclude_from_search' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => 10,
			'menu_icon' => 'dashicons-testimonial',
			'supports' => array( 'editor', 'thumbnail' ),
			'register_meta_box_cb' => array( $this, 'testimonials_meta_boxes'),
		) );

	}

	/**
	 * Adding the necessary metabox
	 *
	 * This functions is attached to the 'testimonials_post_type()' meta box callback.
	 */
	public function testimonials_meta_boxes(){
		add_meta_box( 'testimonials_form', 'Testimonial Details', array( $this, 'testimonials_form'), 'testimonials', 'normal', 'high' );
	}

	/**
	 * Adding the necessary metabox
	 *
	 * This functions is attached to the 'add_meta_box()' callback.
	 */
	public function testimonials_form() {
		$post_id = get_the_ID();
		$testimonial_data = get_post_meta( $post_id, '_testimonial', true );
		$client_name = ( empty( $testimonial_data['client_name'] ) ) ? '' : $testimonial_data['client_name'];
		$source = ( empty( $testimonial_data['source'] ) ) ? '' : $testimonial_data['source'];
		$link = ( empty( $testimonial_data['link'] ) ) ? '' : $testimonial_data['link'];

		wp_nonce_field( 'testimonials', 'testimonials' );
		?>
		<table class="form-table">
			<tr valign="top">
	            <th scope="row">
	                <label for="client_name">
	                    <?php _e('Client\'s Name (optional)','shapla') ?>
	                </label>
	            </th>
				<td>
					<input type="text" class="widefat" id="client_name" name="testimonial[client_name]" value="<?php echo esc_attr( $client_name ); ?>">
				</td>
			</tr>
			<tr valign="top">
	            <th scope="row">
	                <label for="source">
	                    <?php _e('Business/Site Name (optional)','shapla') ?>
	                </label>
	            </th>
				<td>
					<input type="text" class="widefat" id="source" name="testimonial[source]" value="<?php echo esc_attr( $source ); ?>">
				</td>
			</tr>
			<tr valign="top">
	            <th scope="row">
	                <label for="link">
	                    <?php _e('Business/Site Link (optional)','shapla') ?>
	                </label>
	            </th>
				<td>
					<input type="text" class="widefat" id="link" name="testimonial[link]" value="<?php echo esc_attr( $link ); ?>">
				</td>
			</tr>
		</table>
		<?php
	}

	/**
	 * Data validation and saving
	 *
	 * This functions is attached to the 'save_post' action hook.
	 */
	public function testimonials_save_post($post_id){

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( ! empty( $_POST['testimonials'] ) && ! wp_verify_nonce( $_POST['testimonials'], 'testimonials' ) )
			return;

		if ( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) )
				return;
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) )
				return;
		}

		if ( ! wp_is_post_revision( $post_id ) && 'testimonials' == get_post_type( $post_id ) ) {
			remove_action( 'save_post', array( $this, 'testimonials_save_post') );

			wp_update_post( array(
				'ID' => $post_id,
				'post_title' => 'Testimonial - ' . $post_id
			) );

			add_action( 'save_post', array( $this, 'testimonials_save_post') );
		}

		if ( ! empty( $_POST['testimonial'] ) ) {
			$testimonial_data['client_name'] = ( empty( $_POST['testimonial']['client_name'] ) ) ? '' : sanitize_text_field( $_POST['testimonial']['client_name'] );
			$testimonial_data['source'] = ( empty( $_POST['testimonial']['source'] ) ) ? '' : sanitize_text_field( $_POST['testimonial']['source'] );
			$testimonial_data['link'] = ( empty( $_POST['testimonial']['link'] ) ) ? '' : esc_url( $_POST['testimonial']['link'] );

			update_post_meta( $post_id, '_testimonial', $testimonial_data );
		} else {
			delete_post_meta( $post_id, '_testimonial' );
		}
	}

	/**
	 * Modifying the list view columns
	 *
	 * This functions is attached to the 'manage_edit-testimonials_columns' filter hook.
	 */
	public function testimonials_edit_columns( $columns ) {
		$columns = array(
			'cb' => '<input type="checkbox">',
			'title' => 'Title',
			'testimonial' => 'Testimonial',
			'testimonial-client-name' => 'Client\'s Name',
			'testimonial-source' => 'Business/Site',
			'testimonial-link' => 'Link',
			'testimonial-avatar' => 'Client\'s Avatar'
		);

		return $columns;
	}

	/**
	 * Customizing the list view columns
	 *
	 * This functions is attached to the 'manage_posts_custom_column' action hook.
	 */
	public function testimonials_columns( $column, $post_id ) {
		$testimonial_data = get_post_meta( $post_id, '_testimonial', true );
		switch ( $column ) {
			case 'testimonial':
				the_excerpt();
				break;
			case 'testimonial-client-name':
				if ( ! empty( $testimonial_data['client_name'] ) )
					echo $testimonial_data['client_name'];
				break;
			case 'testimonial-source':
				if ( ! empty( $testimonial_data['source'] ) )
					echo $testimonial_data['source'];
				break;
			case 'testimonial-link':
				if ( ! empty( $testimonial_data['link'] ) )
					echo $testimonial_data['link'];
				break;
			case 'testimonial-avatar':
				if ( has_post_thumbnail() )
					echo get_the_post_thumbnail( get_the_ID(), array(64,64));
				break;
		}
	}

	// Hooks your functions into the correct filters
	public function add_mce_button() {
	    // check user permissions
	    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
	        return;
	    }
	    // check if WYSIWYG is enabled
	    if ( 'true' == get_user_option( 'rich_editing' ) ) {
	        add_filter( 'mce_external_plugins', array( $this, 'add_tinymce_plugin') );
	        add_filter( 'mce_buttons', array( $this, 'register_mce_button') );
	    }
	}

	// Declare script for new button
	public function add_tinymce_plugin( $plugin_array ) {
	    $plugin_array['testimonials_mce_button'] = plugin_dir_url( __FILE__ ) .'/js/mce-button.js';
	    return $plugin_array;
	}

	// Register new button in the editor
	public function register_mce_button( $buttons ) {
	    array_push( $buttons, 'testimonials_mce_button' );
	    return $buttons;
	}
}

$client_testimonials = new Client_Testimonials();
endif;


include_once 'shortcode.php';
include_once 'widgets/widget-testimonials.php';