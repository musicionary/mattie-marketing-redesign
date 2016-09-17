<?php
defined('ABSPATH') or die('No direct access!');class CaptainForm_WP_Users extends CaptainForm_WP_Integrations_Handler{	const OPTION_DB_NAME = 'captainform_wp_users_public_key';
	static function connect($param = null)	{		parent::connect(self::OPTION_DB_NAME);	}	static function check_connection($param = null)	{		parent::check_connection(self::OPTION_DB_NAME);	}
	private static function get_wp_roles()	{		global $wp_roles;		$roles = array();		foreach ($wp_roles->role_names as $role => $name) 			$roles[] = $name;				return $roles;	}	static function new_user()	{		if (!self::authenticate(self::OPTION_DB_NAME)) {			echo self::message("There was an error while trying to authenticate with WordPress", 0);			exit();		}		$user_id = null;		$username = isset($_REQUEST['username']) ? self::strip_data($_REQUEST['username']) : '';		$email_address = isset($_REQUEST['email_address']) ? self::strip_data($_REQUEST['email_address']) : '';		$password = isset($_REQUEST['password']) ? self::strip_data($_REQUEST['password']) : '';		$website = isset($_REQUEST['website']) ? self::strip_data($_REQUEST['website']) : '';		$first_name = isset($_REQUEST['first_name']) ? self::strip_data($_REQUEST['first_name']) : '';		$last_name = isset($_REQUEST['last_name']) ? self::strip_data($_REQUEST['last_name']) : '';		$display_name = isset($_REQUEST['display_name']) ? self::strip_data($_REQUEST['display_name']) : '';		$nickname = isset($_REQUEST['nickname']) ? self::strip_data($_REQUEST['nickname']) : '';		$description = isset($_REQUEST['description']) ? self::strip_data($_REQUEST['description']) : '';		$rich_editing = isset($_REQUEST['rich_editing']) ? self::strip_data($_REQUEST['rich_editing']) : '';
		$show_admin_bar_front = isset($_REQUEST['show_admin_bar_front']) ? (self::strip_data($_REQUEST['show_admin_bar_front']) == 1 ? 'true' : 'false') : 'false' ; 
		$role = isset($_REQUEST['role']) ? strtolower(self::strip_data($_REQUEST['role'])) : '';
		$jabber =isset($_REQUEST['jabber']) ? self::strip_data($_REQUEST['jabber']) : '';
		$aim = isset($_REQUEST['aim']) ? self::strip_data($_REQUEST['aim']) : '';
		$yahoo =isset($_REQUEST['yahoo']) ?  self::strip_data($_REQUEST['yahoo']) : '';
		$wordpress_url = isset($_REQUEST['wordpress_url']) ? self::strip_data($_REQUEST['wordpress_url']) : '';
		$send_password = isset($_REQUEST['send_password']) == 1 ? (self::strip_data($_REQUEST['send_password']) == 1 ? true : false) : false;
		$random_password = isset($_REQUEST['random_password']) ? (self::strip_data($_REQUEST['random_password']) == 1 ? true : false) : false;
		
		if($random_password == false && trim($password) == "")
			$random_password = true;
		
		
		$username_exists = username_exists($username);
		$email_exists = email_exists($email_address);
		if(!empty($username_exists)|| !empty($email_exists))
		{
			$labels_arr = array();
			$message = '';
			if(!empty($username_exists))
				$labels_arr[] = 'username';
			if(!empty($email_exists))
				$labels_arr[] = 'email';
			$labels_string = implode(" and ", $labels_arr);
			$aux = (count($labels_arr)>1 ? "":  "s");
			$message = sprintf("There was an error when trying to create the WordPress user. Sorry, that %s already exist%s!", $labels_string, $aux);
			echo self::message($message, 0);
			exit();
		}
		
		if (empty($username_exists) && empty($email_exists))
		{
			// Generate the password and create the user			if ($random_password)
			{				$password = wp_generate_password(12, false);
			}			$user_id = wp_create_user($username, $password, $email_address);			if (is_numeric($user_id)) 
			{				wp_update_user(					array(						'ID' => $user_id,						'username' => $username,						'user_url' => $website,						'first_name' => $first_name,						'last_name' => $last_name,						'display_name' => $display_name,						'nickname' => $nickname,						'description' => $description,						'rich_editing' => $rich_editing ? 'true' : 'false',						'show_admin_bar_front' => $show_admin_bar_front,						'role' => $role,						'jabber' => $jabber,						'aim' => $aim,						'yahoo' => $yahoo,					)				);				// Set the role				$user = new WP_User($user_id);				$user->set_role($role);				
				// Email the user				$admin_email = get_option('admin_email');
				$headers = 'From: ' . $admin_email . ' <' . $admin_email . '>' . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
				$email_content = 'Hello,<br /><br />';				$email_content .= 'Your WordPress user account has been created on ' . $wordpress_url . '.<br />';				$email_content .= '<b>Username</b>: ' . $username . '<br />';
				$email_content .= '<b>Email Address</b>: ' . $email_address . '<br />';
				
				if($random_password || $send_password)					$email_content .= '<b>Password</b>: ' . $password . '<br /><br />';				$email_content .= 'You can log in here: ' . $wordpress_url . '/wp-login.php<br /><br />Best regards.';				
				wp_mail($email_address, 'Welcome!', $email_content, $headers);			}		}
		$data = array();		$data["user_id"] = $user_id;		$status = is_numeric($user_id) && $user_id > 0 ? 1 : 0;		$message  = '';
		if($status == 0 && is_wp_error( $user_id ))
		{
			$message =  $user_id->get_error_message();	
		}
		echo self::message($message, $status, json_encode($data));		exit();	}
	static function get_wp_data()	{		if (!self::authenticate(self::OPTION_DB_NAME)) {			echo self::message("There was an error while trying to authenticate with WordPress", 0);			exit();		}		$data = array();		$data["user_roles"] = self::get_wp_roles();		echo json_encode($data);		exit();	}}
new CaptainForm_WP_Users();add_action('wp_ajax_captainform_new_users_connect', array('CaptainForm_WP_Users', 'connect'));add_action('wp_ajax_nopriv_captainform_new_users_connect', array('CaptainForm_WP_Users', 'connect'));add_action('wp_ajax_captainform_new_user', array('CaptainForm_WP_Users', 'new_user'));add_action('wp_ajax_nopriv_captainform_new_user', array('CaptainForm_WP_Users', 'new_user'));add_action('wp_ajax_captainform_new_users_get_wp_data', array('CaptainForm_WP_Users', 'get_wp_data'));add_action('wp_ajax_nopriv_captainform_new_users_get_wp_data', array('CaptainForm_WP_Users', 'get_wp_data'));add_action('wp_ajax_captainform_new_users_check_connection', array('CaptainForm_WP_Users', 'check_connection'));add_action('wp_ajax_nopriv_captainform_new_users_check_connection', array('CaptainForm_WP_Users', 'check_connection'));