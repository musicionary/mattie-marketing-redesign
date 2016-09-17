<?php
if(!function_exists('tt_instagram_data')){
	/**
	* Get data from instagram by scrapping user's feed
	* @since 1.9.2
	* @return array Image Data & User Stats
	*/
	function tt_instagram_data( $username, $cache_hours, $nr_images ) {
		return false;
	}
}

if(!function_exists('tt_instagram_generate_output')){
	/**
	* Generate instagram output
	* @since 1.9.2
	*/
	function tt_instagram_generate_output( $username, $cache_hours, $nr_images , $thumbs = true, $callback = '' ){
		return false;
	}
}