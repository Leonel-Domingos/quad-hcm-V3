<?php
    require_once '../init.php';
?>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                <h2><?php echo 'TITULO'; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
<?php
    var_dump($_user);

    echo "<br/>";
    echo "<br/>";
    
    echo "<b>SESSION VARIABLES:</B><br/>";
    
    echo "<table class='table table-bordered'>";
    echo "<thead class='thead-dark'>";
    echo "<tr><th>SESSION VARIAVEL</th><th>SESSION value</th>";
    echo "<th>OBJECT VARIAVEL</th><th>OBJ.VALUE</th></tr>";
    echo "</thead></tbody>";
    
    echo "<tr><td>\$_SESSION[''database'']</td><td>".@$_SESSION['database']."</td>";
    echo "<td></td><td></td></tr>";

    echo "<tr><td>\$_SESSION[''id'']</td><td>".@$_SESSION['id']."</td>";
    echo "<td>\$_user->ID</td><td>".$_user->ID."</td></tr>";
    
    echo "<tr><td>\$_SESSION[''utilizador'']</td><td>".@$_SESSION['utilizador']."</td>";
    echo "<td>\$_user->UTILIZADOR<td>".$_user->UTILIZADOR."</td></tr>";

    echo "<tr><td>\$_SESSION[''reset_pw'']</td><td>".@$_SESSION['reset_pw']."</td>";
    echo "<td>\$_user->PEDE_PWD</td><td>".$_user->PEDE_PWD."</td></tr>";
    
    echo "<tr><td>\$_SESSION[''rhid'']</td><td>".@$_SESSION['rhid']."</td>";
    echo "<td>\$_user->RHID</td><td>".$_user->RHID."</td></tr>";

    echo "<tr><td>\$_SESSION[''nome'']</td><td>".@$_SESSION['nome']."</td>";
    echo "<td>\$_user->NOME</td><td>".$_user->NOME."</td></tr>";

    echo "<tr><td>\$_SESSION[''avatar'']</td><td>".@$_SESSION['avatar']."</td>";
    echo "<td>\$_user->get_user_thumbnail()</td><td>".$_user->get_user_thumbnail()."</td></tr>";
    
    echo "<tr><td>\$_SESSION[''avatar_lock'']</td><td>".@$_SESSION['avatar_lock']."</td>";
    echo "<td></td><td></td></tr>";

    echo "<tr><td>\$_SESSION[''perfil'']</td><td>".@$_SESSION['perfil']."</td>";
    echo "<td>\$_user->get_current_profile()->TIPO_PERFIL</td><td>".$_user->get_current_profile()->TIPO_PERFIL."</td></tr>";
    
    echo "<tr><td>\$_SESSION[''id_perfil'']</td><td>".@$_SESSION['id_perfil']."</td>";
    echo "<td>\$_user->get_current_profile()->ID_PERFIL</td><td>".$_user->get_current_profile()->ID_PERFIL."</td></tr>";

    echo "<tr><td>\$_SESSION[''dsp_perfil'']</td><td>".@$_SESSION['dsp_perfil']."</td>";
    echo "<td>\$_user->get_current_profile()->DS_PERFIL</td><td>".$_user->get_current_profile()->DS_PERFIL."</td></tr>";

    echo "<tr><td>\$_SESSION[''lang'']</td><td>".@$_SESSION['lang']."</td>";
    echo "<td></td><td></td></tr>";

    echo "<tr><td>\$_SESSION[''lang_db'']</td><td>".@$_SESSION['lang_db']."</td>";
    echo "<td></td><td></td></tr>";
    
    echo "<tr><td>\$_SESSION[''URL'']</td><td>".@$_SESSION['URL']."</td>";
    echo "<td></td><td></td></tr>";

    echo "</tbody></table>";


/*
# VARIÁVEIS DE SESSÃO 
@$_SESSION['database'] = 'MYSQL';
@$_SESSION['id']
@$_SESSION['utilizador']
@$_SESSION['reset_pw']
@$_SESSION['rhid']
@$_SESSION['nome']
@$_SESSION['reset_pw']
@$_SESSION['avatar']
@$_SESSION['avatar_lock']

@$_SESSION['perfil']
@$_SESSION['id_perfil']
@$_SESSION['dsp_perfil']

@$_SESSION['lang'] = '';
@$_SESSION['lang_db'] = '';     
@$_SESSION['URL'] = '';    


*/
    
?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
    });
</script>
