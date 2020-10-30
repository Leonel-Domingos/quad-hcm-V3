<?php

namespace Models;

class AccessToken extends Model {
	public static function with_token($token) {
		return parent::instance('token', $token);
	}
}

?>