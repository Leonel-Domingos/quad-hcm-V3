<?php

require_once 'init.utils.php';


$users = ['9000','andre.antunes','antonia.freitas','antonio.pereira','armindo.gomez','carlos.goncalves','carlos.ribeiro','carolina.loureiro',
          'clotilde.pereira','contabilidade','fernando.silva','francisco.oliveira','inacio.couto ','ines.trigueiros','ines.trindade','joana.pereira',
          'joao.pereira','joaquim.bastos','jose.delgado','jose.infante','jose.valente','leonor.ribeiro','mjose.pinto','nestor.nobre','pedro.dias',
          'pedro.silva','pfaria','ricardo.romeira','rosa.castanho','rosario.abrantes','rute.burmester','teste'];
foreach ($users as $rec) {
    plog("username:$rec");
    $user = \Models\User::with_username($rec);
    $pwd = 'teste';
    $result = $user->set_password($pwd);
    if ($result) plog('OK');
            else plog('FAIL');
    
}





?>