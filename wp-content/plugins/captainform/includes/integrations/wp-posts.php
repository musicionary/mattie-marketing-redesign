<?php
defined('ABSPATH') or die('No direct access!');

class CaptainForm_WP_POSTS extends CaptainForm_WP_Integrations_Handler
{
	const OPTION_DB_NAME = '123cf_post_public_key';

	public static function connect($param = null)
	{
		parent::connect(self::OPTION_DB_NAME);
	}

	public static function check_connection($param = null)
	{
		parent::check_connection(self::OPTION_DB_NAME);
	}

	public static function new_post()
	{
		if (!self::authenticate(self::OPTION_DB_NAME)) {
			echo self::message("There was an error while trying to authenticate with wordpress", 0);
			exit();
		}
		$post_title = strip_tags(rawurldecode($_POST["post_title"]));
		$post_title = preg_replace("/&nbsp;/", ' ', $post_title);
		$post_title = stripslashes($post_title);

		$post_content = rawurldecode($_POST["post_content"]);
		$post_content = stripslashes($post_content);
		$post_status = $_POST["post_status"];
		$post_category = urldecode($_POST["post_category"]);
		$post_author = $_POST["post_author"];
		$post_format = $_POST["post_format"];
		$comments = $_POST["comment_status"];
		$comments == "1" ? $comment_status = "open" : $comment_status = "closed";
		$post_excerpt = rawurldecode($_POST["post_excerpt"]);
		$post_excerpt = preg_replace("/&nbsp;/", ' ', $post_excerpt);
		$post_excerpt = stripslashes($post_excerpt);
		$post_tags = explode(",", rawurldecode($_POST["post_tags"]));
		$post_image = str_replace(" ", "+", $_POST["post_image"]);
		$post_image_name = $_POST["post_image_name"];

		$custom_fields_keys = self::get_custom_post_fields();
		$custom_fields_values = array();
		foreach ($custom_fields_keys as $key) {
			if ($_POST[$key]) {
				$custom_fields_values[rawurldecode($key)] = $_POST[$key];
			}
		}

		$post_categories = explode(",", $post_category);
		$cat_id_arr = array();
		if (is_array($post_categories)) {
			foreach ($post_categories as $category_name) {
				$category_id = get_cat_ID($category_name);
				if ($category_id) {
					$cat_id_arr[] = $category_id;
				}
			}
		}

		$new_post = array(
			'post_author' => $post_author,
			'post_title' => $post_title,
			'post_content' => $post_content,
			'post_status' => $post_status,
			'comment_status' => $comment_status,
			'post_excerpt' => $post_excerpt,
			'post_category' => $cat_id_arr
		);

		$post_id = wp_insert_post($new_post);
		if ($post_id) {
			foreach ($custom_fields_values as $meta_key => $meta_value) {
				add_post_meta($post_id, str_replace("|***|", " ", $meta_key), $meta_value);
			}
			set_post_format($post_id, $post_format);
			wp_set_post_tags($post_id, $post_tags);
			if (isset($post_image) && RetrieveExtension($post_image)) {
				self::upload_image($post_id, $post_image, $post_image_name);
			}
			echo self::message("New post created", 1);
			exit();
		}
		echo self::message("There was an error while trying to create new post", 0);
		exit();	}

	private static function get_custom_post_fields()
	{
		global $wpdb;
		$custom_fields = array();
		$fields = $wpdb->get_results('SELECT DISTINCT meta_key FROM wp_postmeta', OBJECT);
		foreach ($fields as $field) {
			if (substr($field->meta_key, 0, 1) != "_") {

				$meta_key = str_replace(" ", "|***|", $field->meta_key);
				$custom_fields[] = $meta_key;
			}
		}
		return $custom_fields;
	}

	private static function insert_child_category($category, $wp_categories)
	{
		if ($category->parent == 0) {
			$wp_categories[] = $category;
			$args = array('hierarchical' => true, 'hide_empty' => 0, 'child_of' => $category->cat_ID);
			$child_categories = get_categories($args);
			foreach ($child_categories as $child_cat) {
				$wp_categories[] = $child_cat;
			}
		}
		return $wp_categories;
	}

	public static function get_wp_data()
	{
		if (!self::authenticate(self::OPTION_DB_NAME)) {
			echo captainform_cfp_message("There was an error while trying to authenticate with wordpress", 0);
			exit();
		}		
		global $wpdb;
		$data = array();
		$custom_fields = array();

		$fields = $wpdb->get_results("SELECT DISTINCT meta_key FROM {$wpdb->prefix}postmeta", OBJECT);
		foreach ($fields as $field) {
			if (substr($field->meta_key, 0, 1) != "_") {
				$custom_fields[] = $field->meta_key;
			}
		}
		$data["custom_fields"] = $custom_fields;
		$args = array('orderby' => 'name', 'hierarchical' => true, 'hide_empty' => 0, 'parent' => 0);
		$categories = get_categories($args);
		$wp_categories = array();
		foreach ($categories as $category) {
			$wp_categories = self::insert_child_category($category, $wp_categories);
		}

		$data["categories"] = $wp_categories;
		$args_authors = array('who' => 'author');
		$users = get_users($args_authors);
		$authors = array();
		foreach ($users as $user) {
			$authors[] = array("id" => $user->data->ID, "username" => $user->data->user_login);
		}
		$data["authors"] = $authors;
		echo json_encode($data);
		exit();
	}	
	private static function upload_image($post_id, $post_image, $post_image_name = null)
	{
		$upload_dir = wp_upload_dir();
		$upload_path = str_replace('/', DIRECTORY_SEPARATOR, $upload_dir['path']) . DIRECTORY_SEPARATOR;
		$decoded_img = base64_decode($post_image);
		if (!$post_image_name) {
			$filename = 'image.png';
		} else {
			$filename = $post_image_name;
		}
		$hashed_filename = md5($filename . microtime()) . '_' . $filename;
		$image_upload = file_put_contents($upload_path . $hashed_filename, $decoded_img);
		if (!function_exists('wp_handle_sideload')) {
			require_once(ABSPATH . 'wp-admin/includes/file.php');
		}
		if (!function_exists('wp_get_current_user')) {
			require_once(ABSPATH . 'wp-includes/pluggable.php');
		}

		$file = array();
		$file['error'] = '';
		$file['tmp_name'] = $upload_path . $hashed_filename;
		$file['name'] = $hashed_filename;
		$file['type'] = 'image/jpg';
		$file['size'] = filesize($upload_path . $hashed_filename);

		$file_return = wp_handle_sideload($file, array('test_form' => false));
		$file_url = $file_return['file'];
		$filetype = wp_check_filetype(basename($file_url), null);
		$attachment = array(
			'guid' => $upload_dir['url'] . '/' . basename($file_url),
			'post_mime_type' => $filetype['type'],
			'post_title' => preg_replace('/\.[^.]+$/', '', basename($file_url)),
			'post_content' => '',
			'post_status' => 'inherit'
		);
		$attach_id = wp_insert_attachment($attachment, $file_url, $post_id);
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		$attach_data = wp_generate_attachment_metadata($attach_id, $file_url);
		wp_update_attachment_metadata($attach_id, $attach_data);
		update_post_meta($post_id, '_thumbnail_id', $attach_id);
	}
}

new CaptainForm_WP_POSTS();
add_action('wp_ajax_cfp-connect', array('CaptainForm_WP_POSTS', 'connect'));
add_action('wp_ajax_nopriv_cfp-connect', array('CaptainForm_WP_POSTS', 'connect'));
add_action('wp_ajax_cfp-new-post', array('CaptainForm_WP_POSTS', 'new_post'));
add_action('wp_ajax_nopriv_cfp-new-post', array('CaptainForm_WP_POSTS', 'new_post'));
add_action('wp_ajax_cfp-get-wp-data', array('CaptainForm_WP_POSTS', 'get_wp_data'));
add_action('wp_ajax_nopriv_cfp-get-wp-data', array('CaptainForm_WP_POSTS', 'get_wp_data'));
add_action('wp_ajax_cfp-check-connection', array('CaptainForm_WP_POSTS', 'check_connection'));
add_action('wp_ajax_nopriv_cfp-check-connection', array('CaptainForm_WP_POSTS', 'check_connection'));

