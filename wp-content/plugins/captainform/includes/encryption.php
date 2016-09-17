<?php

class captainform_encrytion
{
	public static $cryptKey = 'q923Mr!x';

	public static function encrypt($str)
	{
		$str_arr = str_split($str);
		$pass_arr = str_split(self::$cryptKey);
		$add = 0;
		$div = strlen($str) / strlen(self::$cryptKey);
		while ($add <= $div) {
			if (!isset($newpass))
				$newpass = '';
			$newpass .= self::$cryptKey;
			$add++;
		}
		$pass_arr = str_split($newpass);
		foreach ($str_arr as $key => $asc) {
			if (!isset($ascii))
				$ascii = "";
			$pass_int = ord($pass_arr[$key]);
			$str_int = ord($asc);
			$int_add = $str_int + $pass_int;
			$ascii .= chr($int_add);
		}
		return '===' . self::base64url_encode($ascii);
	}

	public static function decrypt($enc)
	{
		if (self::left($enc, 3) == '===') {
			$enc = self::base64url_decode(self::trim_left($enc, 3));
			if (strlen($enc) == 0) {
				return '';
			}
			$enc_arr = str_split($enc);
			$pass_arr = str_split(self::$cryptKey);
			$add = 0;
			$div = strlen($enc) / strlen(self::$cryptKey);
			while ($add <= $div) {
				$newpass .= self::$cryptKey;
				$add++;
			}
			$pass_arr = str_split($newpass);
			foreach ($enc_arr as $key => $asc) {
				$pass_int = ord($pass_arr[$key]);
				$enc_int = ord($asc);
				$str_int = $enc_int - $pass_int;
				$ascii .= chr($str_int);
			}
			return $ascii;
		} else {
			return self::old_cf_wpp_decrypt($enc);
		}
	}

	public static function old_cf_wpp_decrypt($str)
	{
		if (strlen($str) == 0)
			return '';
		$key = self::$cryptKey;
		$str = mcrypt_decrypt(MCRYPT_DES, $key, base64_decode($str), MCRYPT_MODE_ECB);
		$block = mcrypt_get_block_size('des', 'ecb');
		$pad = ord($str[($len = strlen($str)) - 1]);
		return substr($str, 0, strlen($str) - $pad);
	}

	public static function base64url_encode($data)
	{
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}

	public static function base64url_decode($data)
	{
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
	}

	public static function right($value, $count)
	{
		return substr($value, ($count * -1));
	}

	public static function left($string, $count)
	{
		return substr($string, 0, $count);
	}

	public static function trim_left($string, $count)
	{
		return substr($string, $count);
	}
}

/**
 * encrypt params
 * @param string
 **/
function captainform_wpp_encrypt($str)
{
	return captainform_encrytion::encrypt($str);
}

/**
 * decrypt params
 * @param string
 **/
function captainform_wpp_decrypt($str)
{
	return captainform_encrytion::decrypt($str);
}
