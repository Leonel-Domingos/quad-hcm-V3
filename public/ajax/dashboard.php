<?php
    require_once '../init.php';
    
var_dump($db);

    require_once INCLUDES_PATH."/lib/ad_lib.php";
    
    ## obtem array com processo de avaliação de desempenho ativos
    ##
    $processos_ = av_processos_ativos($msg);
    
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
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
    });
</script>
