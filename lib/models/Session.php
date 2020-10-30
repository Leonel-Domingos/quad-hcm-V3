<?php

namespace Models;

class Session extends Model {

	public function touch() {
		return $this->update('updated_at', dt('now'));
	}

	public static function with_token($token) {
		return parent::instance('token', $token);
	}

	public static function get_iv($value) {
		return sha1($value.ENCRYPTION_KEY);
	}

	public static function with_cookie($value) {
            if ($value) {
                $value = explode('|', $value);
                if (count($value) === 2 && ((int)$value[0] === 0 || (int)$value[0] > time())) {
                    $iv = self::get_iv($value[0]);
                    $cookie_data = explode('.', trim(\Common\Util::decrypt($value[1], ENCRYPTION_KEY, $iv)));
                    if (isset($cookie_data[0]) && isset($cookie_data[1])) {
                        $token = $cookie_data[0];
                        $session_id = $cookie_data[1];
                        $session = parent::instance($session_id);
                        if ($session) {
                            if (hash_hmac('sha256', $token, $iv) === $session->cookie_token) {
                                return $session;
                            }
                        }
                    }
                }
            }
            return false;
	}

	public static function destroy_cookie() {
            if (isset($_COOKIE[AUTH_COOKIE_NAME])) {
                unset($_COOKIE[AUTH_COOKIE_NAME]);
                setcookie(AUTH_COOKIE_NAME, null, time() -1, '/', '', true, true);
            }
	}

	public static function create(User $user, $platform = \App\App::PLATFORM_WEB) {
            $token = hash('sha256', \Common\Util::token());

            return self::insert([
                    'user_id' => $user->ID,
                    'token' => $token,
                    'platform' => $platform
            ]);
	}

	public function get_user() {
            $user = User::instance($this->user_id);
            $user->set_user_profiles();
            $x = $user->name();
            return $user;
	}

	// https://stackoverflow.com/questions/244882/what-is-the-best-way-to-implement-remember-me-for-a-website
	public function set_web_cookie() {
            $token = \Common\Util::token();
            $expires = time() + (60 * 60 * 24 * 30); // 30 days
            $iv = self::get_iv($expires);

            $hashed_token = hash_hmac('sha256', $token, $iv);

            $result = $this->update('cookie_token', $hashed_token);
            if ($result) {
                ## PTE: neste ponto poderei adicionar informação à cookie...
                $cookie = $token.'.'.$this->id;
                $cookie_data = $expires.'|'.\Common\Util::encrypt($cookie, ENCRYPTION_KEY, $iv);
                setcookie(AUTH_COOKIE_NAME, $cookie_data, $expires, '/', '', isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on', true);
                return true;
            } 
            else return false;
	}

	public function set_web_session() {
            if ($this->platform == \App\App::PLATFORM_WEB) {
                    $_SESSION[AUTH_TOKEN_SESSION_NAME] = $this->token;
            }
            return true;
	}

	public function ping() {
            return $this->update('active_at', dt('now'));
	}

	public function destroy() {
            if ($this->platform == \App\App::PLATFORM_WEB) {
                $_SESSION[AUTH_TOKEN_SESSION_NAME] = null;
                if (isset($_SESSION['oauth_provider'])) {
                    $config = \App\App::get_oauth_config($_SESSION['oauth_provider']);
                    $hybridauth = new \Hybridauth\Hybridauth($config);
                    $hybridauth->disconnectAllAdapters();
	            $_SESSION['oauth_provider'] = null;
	        }
                self::destroy_cookie();
                session_unset();
                session_destroy();
            }
            $this->delete();
	}
}
?>