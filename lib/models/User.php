<?php

namespace Models;
use \Common\Util;

class User extends Model {
    
    private $_profiles = null;
    private $_current_profile = null;
    public $NOME = '';
    public $NOME_REDZ = '';

    public static function validate_username($username, &$message = '') {
        $message = 'The username is already taken';

        $user = self::with_username($username) ? true : false;
        if (!$user) {
            $message = 'The username is not in use';
            return true;
        }

        return false;
    }

    public static function validate_email($email, &$message = '') {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = 'Email is not valid';
            return false;
        }

        $user = self::with_email($email) ? true : false;
        if (!$user) {
            $message = 'The email is not in use';
            return true;
        }

        $message = 'The email is already taken';

        return false;
    }

    public function verify_email($token) {
        if ($this->verified) return true;

        $request = $this->get_request(RequestType::EMAIL_VERIFICATION);
        if ($request && $request->token === $token) {
            if (!$request->is_valid()) {
                throw new \Exception('The verification token is no longer valid');
            }

            $verified = $request->verify();
            if ($verified) {
                $request->complete();
                $this->update('verified', 1);
            }

            return $verified;
        }

        throw new \Exception('Invalid verification token');
    }

    public function name() {
        #$parts = [$this->firstname, $this->lastname];
        #return $this->firstname ? implode(' ', $parts) : $this->username;
        
        $names = Model::query("SELECT NOME, NOME_REDZ FROM ".DB_NAME.".RH_IDENTIFICACOES WHERE RHID = ? ", [$this->RHID]);
        $this->NOME = $names[0]->NOME;
        $this->NOME_REDZ= $names[0]->NOME_REDZ;

        if ($this->NOME === '') {
            $this->NOME = $this->UTILIZADOR;
        }
        
        if ($this->NOME_REDZ === '') {
            $this->NOME_REDZ = $this->UTILIZADOR;
        }
        
        return $names['NOME'];
    }

    public function set_password($password) {
        $salt = token();
        $hash = password_hash($salt.$password, PASSWORD_DEFAULT);

        return $this->update([
            'PASSWORD' => $hash,
            'PASSWORD_SALT' => $salt
        ]);
    }

    public static function with_email($email) {
        return parent::instance('EMAIL', $email);
    }

    public static function with_username($username) {
        return parent::instance('UTILIZADOR', $username);
    }

    public function verify_password($password) {
        $salted_current_password = $this->PASSWORD;
        $salted_password = $this->PASSWORD_SALT.$password;

        if (password_verify($salted_password, $salted_current_password)) {
            if (password_needs_rehash($salted_current_password, PASSWORD_DEFAULT)) {
                $salt = token();
                $new_salted_hash = password_hash($salt.$password, PASSWORD_DEFAULT);

                $this->update([
                    'PASSWORD' => $new_salted_hash,
                    'PASSWORD_SALT' => $salt
                ]);
            }

            return true;
        } else return false;
    }

    public function create_session($platform) {
        return Session::create($this, $platform);
    }

    public function get_avatar($size = 48) {
        $gravatar = new \Common\Gravatar($this->EMAIL);
        $gravatar->set_size($size);
        return $gravatar->get_url();
    }

    public function create_access_token() {
        $token = sha1(token());

        return AccessToken::insert([
            'user_id' => $this->ID,
            'token' => $token
        ]);
    }

    public function validate_access_token($token) {
        $token = AccessToken::with_token($token);
        if ($token) {
            return $token->user_id == $this->ID;
        }

        return false;
    }

    public function notify($subject, $body) {
        if (!$this->EMAIL) return false;

        $mailer = new \Common\Mailer;

        $body = $mailer->format_body($body, \Common\Mailer::TEMPLATE_DEFAULT);
        return $mailer->submit($this->EMAIL, $subject, $body);
    }

    public function create_web_session($platform, $remember = false) {
        
        $session = $this->create_session($platform);
        
        $results = $session->set_web_session();

        // create cookie
        if ($remember) $session->set_web_cookie();
        return $session;
    }

    public function get() {
        $data = $this->to_array(['ID', 'UTILIZADOR', 'EMAIL', 'DT_INSERTED']);
        $data = Model::format_dates(array('DT_INSERTED'), $data, \DateTime::ISO8601);

        $data['name'] = $this->name();
        $data['avatar_url'] = $this->get_avatar();

        return $data;
    }

    /*
     * Determina os perfis do utilizador
     */
    public function set_user_profiles() {
        # determina os perfis associados ao utilizador
        if ($this->ID != '') {
            $this->_profiles = \Models\Profile::get_user_profiles($this->ID);

            $idx = -1;
            $this->_current_profile = 0;
            foreach ($this->_profiles as $rec) {
                $idx += 1;
                if ($rec->ID_PERFIL == @$_SESSION['id_perfil']) {
                    $this->_current_profile = $idx;
                    break;
                };
            }
        }
    }
    
    /*
     * Obtêm informação dos perfis disponíveis para o utilizador
     */
    public function get_profiles() {
        return $this->_profiles;
    }

    /*
     * Obtêm informação do perfil selecionado
     */
    public function get_current_profile() {
        return $this->_profiles[$this->_current_profile];
    }
        
    
    public function show_current_profile() {
        return $this->_profiles[$this->_current_profile]->DS_PERFIL;
        
    }
    
    public function show_current_profile_list() {
        
        $lista = '<select id="profile_change" class="">';
        $idx = -1;
        foreach ($this->_profiles as $rec) {
            $idx += 1;
            if ($idx == $this->_current_profile) {
                $lista .= ' <option value="'.$rec->ID_PERFIL.'" selected=selected >'.$rec->DS_PERFIL.'</option>';
            }
            else {
                $lista .= ' <option value="'.$rec->ID_PERFIL.'">'.$rec->DS_PERFIL.'</option>';
            }
        }
        $lista .= '</select>';
        
        return $lista;
    }
    
    public function change_current_profile($id_profile) {
        $idx = -1;
        foreach ($this->_profiles as $rec) {
            $idx += 1;
            if ($rec->ID_PERFIL == @$_SESSION['id_perfil']) {
                $this->_current_profile = $idx;
                break;
            };
        }
    }
    
    public function get_user_thumbnail() {

        $thumbnail = '';
        $mime = '';
        $src = '';
        
        $image = 'https://quad-systems.pt/QUAD_HCM_v3/public/assets/img/demo/avatars/avatar-admin.png';
        
        
        $data = Model::query("SELECT TO_BASE64(BD_DOC) IMG, BD_MIME, LINK_DOC, LENGTH(BD_DOC)  ".
                             "FROM RH_IDENTIFICACOES ".
                             "WHERE RHID = ? ", [$this->RHID]);

        $imageData = '';
        if ($data[0]->IMG) {
            $image = APP_TMP_PATH.'/'.$data[0]->LINK_DOC;
            file_put_contents($image, base64_decode($data[0]->IMG));
            $imageData = base64_encode(file_get_contents($image));
        }
        elseif ($data[0]->BD_MIME && $data[0]->LINK_DOC) {
            $image = ASSETS_PATH.'/img/fotos/'.$data[0]->LINK_DOC;
            $imageData = base64_encode(file_get_contents($image));
        }
        else {
            #$image = ASSETS_PATH.'/img/fotos/user.png';
            $image = THUMB_USER_IMG;

            if (strtolower(pathinfo($image, PATHINFO_EXTENSION)) == 'svg') {
                # se for renderizar a imagem do tipo svg, deverá ser por referência e não inline...
                #$image = APP_URL.'/assets/img/fotos/user-alt.svg';
                $src = $image;
            } else {
                $imageData = base64_encode(file_get_contents($image));
            }
        }

        if ($src == '') {
            #$mime = mime_content_type($image);
            $mime = image_type_to_mime_type(exif_imagetype($image));
            // Format the image SRC:  data:{mime};base64,{data};
            $src = 'data:'.$mime.';base64,'.$imageData;
        }
        
        $thumbnail = '<img src="'.$src.'" class="profile-image rounded-circle" alt="'.$this->NOME.'" data-idx="'.sha1(time()).'">';
        
        return $thumbnail;
    }
            
}