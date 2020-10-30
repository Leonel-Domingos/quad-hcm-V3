<?php
/*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @versão     2.0
 *  @revisão    2018.07.06
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome     	quad_controlller_muda_perfil.php
 *  @descrição  Controlador associado à mudança de perfil na plataforma
 *
 */

# cabeçaho do controlador
require_once '../init.php';

$perfil = @$_REQUEST['perfil'];
if ($perfil != '') {

    @$_SESSION['perfil'] = '';
    
    //Get user profiles
    $query = "SELECT p.id, p.dsp_perfil ds_perfil, p.tipo_perfil, p.hierarquia ".
             "FROM WEB_ADM_PERFIS_UTILIZADORES w, WEB_ADM_PERFIS p ".
             "WHERE w.id_utilizador = :usr_id ".
             "  AND p.id = :id_perfil ".
             "  AND p.id = w.id_perfil ".
             "  AND w.estado = 'A' ".
             "  AND p.estado = 'A' ";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':usr_id', @$_SESSION['id'], PDO::PARAM_INT);
    $stmt->bindValue(':id_perfil', $perfil, PDO::PARAM_STR);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        @$_SESSION['perfil'] = $row['tipo_perfil'];
        @$_SESSION['id_perfil'] = $row['id'];
        $_user->change_current_profile($perfil);
    };
}
echo @$_SESSION['perfil']; #$perfil;
?>
