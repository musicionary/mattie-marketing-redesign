<?php

use Abraham\TwitterOAuth\TwitterOAuth;

if(!function_exists('tt_twitter_get_tweets')){
	function tt_twitter_get_tweets($twitteruser,$count,$instance){
		return false;
	}
}

if(!function_exists('tt_getConnectionWithAccessToken')){
	function tt_getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
		return false;
	}
}

if(!function_exists('tt_linkify')){
	function tt_linkify($status_text){
		return false;
	}
}

/**
* Twitter backwards comptibility
* @since 1.9.2
* @todo: remove it when all themes updated
*/
if(!function_exists('twitter_generate_output')){
	function twitter_generate_output($user, $number, $callback='', $step_callback='', $before=false, $after=false, $instance = null){
		return false;
	}
}

if(!function_exists('tt_twitter_generate_output')){
	function tt_twitter_generate_output($user, $number, $callback='', $step_callback='', $before=false, $after=false, $instance = null){
		return false;
	}
}