<?php

namespace Models;

class Profile extends Model {

    # obtêm a lista de perfis disponíveis na plataforma
    public static function get_avail_profiles($lang_files_loc) {
        $profiles = Profile::query("SELECT * FROM WEB_ADM_PERFIS WHERE ESTADO = 'A' ");
        
        return $profiles;
    }
    
    # obtêm a lista de perfis disponíveis para um utilizador
    public static function get_user_profiles($user_id) {
        $profiles = Profile::query("SELECT p.DSP_PERFIL DS_PERFIL, p.TIPO_PERFIL, p.ID ID_PERFIL, p.HIERARQUIA ".
                                   "FROM WEB_ADM_PERFIS_UTILIZADORES w, WEB_ADM_PERFIS p ".
                                   "WHERE w.ID_UTILIZADOR = ? ".
                                   "  AND p.ID = w.ID_PERFIL ".
                                   "  AND w.ESTADO = 'A' ".
                                   "  AND p.ESTADO = 'A' ".
                                   "  AND p.TIPO_PERFIL NOT IN ('W','Y','G') ".
                                   "ORDER BY w.ID_PERFIL ", [$user_id]);
        
        return $profiles;
    }
}
?>