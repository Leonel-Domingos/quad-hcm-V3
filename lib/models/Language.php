<?php

namespace Models;

class Language extends Model {

    # obtêm a lista de línguas disponíveis
    public static function get_avail_langs($lang_files_loc) {
        $langs = Language::query("SELECT * FROM DG_LINGUAS_ESTRANGEIRAS WHERE ATIVO = 'S' ");

        # verifica se o correspondente ficheiro está disponível na aplicação, senão inibe a língua.
        $idx = -1;
        foreach ($langs as $rec) {
            $idx += 1;
            $existe_ficheiro = file_exists($lang_files_loc . "/quad_labels_" . $rec->CODIGO . ".php");
            # inativa a língua se não existir ficheiro de línguas disponível
            if (!$existe_ficheiro) {
                $langs[$idx]->ATIVO = 'N';
            }
        }
        
        return $langs;
    }
    
     # renderiza a lista com as línguas disponíveis 
    public static function show_list_langs($langs) {
        
        $opcoes = '';
        foreach ($langs as $rec) {
            if ($rec->ATIVA == 'S'){
                $opcoes .= '<a href="#?lang=fr" class="dropdown-item" data-action="lang" data-lang="fr">Français</a>';
            }
            else {
                $opcoes .= '<a href="#?lang=fr" class="dropdown-item" data-action="lang" data-lang="fr">Français</a>';
            }
        }
        
        
    }
}
?>