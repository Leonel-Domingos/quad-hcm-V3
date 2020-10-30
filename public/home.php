<?php
require_once 'init.php';

$_title = 'QUAD AJAX NAVIGATION';
$_active_nav = 'datatables_basic';

$_head = '	<link rel="stylesheet" media="screen, print" href="'.ASSETS_URL.'/css/datagrid/datatables/datatables.bundle.css">'.
         '	<link rel="stylesheet" media="screen, print" href="'.ASSETS_URL.'/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css">'.
         '      <link rel="stylesheet" media="screen, print" href="'.ASSETS_URL.'/css/notifications/toastr/toastr.css">'.
         '      <link rel="stylesheet" media="screen, print" href="'.ASSETS_URL.'/css/chosen.css">'.
         '      <link rel="stylesheet" media="screen, print" href="'.ASSETS_URL.'/js/select2/select2.bundle.css">'.
         '      <link rel="stylesheet" media="screen, print" href="'.ASSETS_URL.'/css/novo_css.css">';



$_description = 'Create headache free searching, sorting and pagination tables without any complex configuration';

#$db = \Models\Model::get_db();
#var_dump($db->get_info());

?>
<!DOCTYPE html>
<!-- 
Template Name:: SmartAdmin PHP 7 Responsive WebApp - Template built with Bootstrap 4 and PHP 7
Version: 4.4.6
Author: Jovanni Lo
Website: https://smartadmin.lodev09.com
Purchase: https://wrapbootstrap.com/theme/smartadmin-php-7-responsive-webapp-WB05M9585
License: You must have a valid license purchased only from wrapbootstrap.com (link above) in order to legally use this theme for your project.
-->
<html lang="en">
    <?php include_once APP_PATH.'/includes/head.php'; ?>
    <body class="mod-bg-1 mod-nav-link ">
        <?php include_once APP_PATH.'/includes/theme.php'; ?>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">
                <?php include_once APP_PATH.'/includes/nav.php'; ?>
                <div class="page-content-wrapper">
                    <?php include_once APP_PATH.'/includes/header.php'; ?>
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                        
                    <?php include_once APP_PATH.'/includes/ribbon.php'; ?>
                        
                    <!-- MAIN CONTENT -->
                    <div id="content"></div>                        
                        
                    </main>
                    <!-- END Page Content -->
                    <?php include_once APP_PATH.'/includes/footer.php'; ?>
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <?php include_once APP_PATH.'/includes/extra.php'; ?>
        <?php include_once APP_PATH.'/includes/js.php'; ?>

        <script src="<?= ASSETS_URL ?>/js/notifications/toastr/toastr.js"></script>
        
        <script src="<?php echo ASSETS_URL; ?>/lib/utils/quad_lib.js"></script>
        <script src="<?= ASSETS_URL ?>/js/chosen.jquery.js"></script>

        <script src="<?= ASSETS_URL ?>/js/select2/select2.bundle.js"></script>
        <script src="<?= ASSETS_URL ?>/js/dependency/moment/moment.js"></script>
        
        <script src="<?php echo ASSETS_URL; ?>/lib/quad/quadConfig.js"></script>
        
        <!-- datatble responsive bundle contains: 
            + jquery.dataTables.js
            + dataTables.bootstrap4.js
            + dataTables.autofill.js                            
            + dataTables.buttons.js
            + buttons.bootstrap4.js
            + buttons.html5.js
            + buttons.print.js
            + buttons.colVis.js
            + dataTables.colreorder.js                          
            + dataTables.fixedcolumns.js                            
            + dataTables.fixedheader.js                     
            + dataTables.keytable.js                        
            + dataTables.responsive.js                          
            + dataTables.rowgroup.js                            
            + dataTables.rowreorder.js                          
            + dataTables.scroller.js                            
            + dataTables.select.js                          
            + datatables.styles.app.js
            + datatables.styles.buttons.app.js 
        Datatables: Foi desativado o bundle proposto pela plataforma e atualizado pela nova versão
        -->
<!--        
        <script src="<?= ASSETS_URL ?>/js/datagrid/datatables/datatables.bundle.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/Editor-1.5.5/js/QuadDataTables.editor.js"></script>        
        <script src="<?php echo ASSETS_URL; ?>/js/Editor-1.5.5/js/editor.bootstrap.min.js"></script>            
        -->

        <!-- 
        
        Versão atualizada de dataTables v1.10.22 (https://datatables.net/):

            + Bootstrap         4The latest iteration of the ever popular Bootstrap framework.                  v4.1.1
            + DataTables        Enhance HTML tables with advanced interaction controls.                         v1.10.22
            + Editor            Add full editing controls to your DataTables.                                   v1.9.5
            + Buttons           A common framework for user interaction buttons.                                v1.6.4
            +    Column         visibilityEnd user buttons to control column visibility.                        v1.6.4
            +    HTML5 export   Copy to clipboard and create Excel, PDF and CSV files from the table's data.    v1.6.4
            +       JSZip       Required for the Excel HTML5 export button.                                     v2.5.0
            +       pdfmake     Required for the PDF HTML5 export button.                                       v0.1.36
            +    Print view     Button that will display a printable view of the table.                         v1.6.4
            + ColReorder        Click-and-drag column reordering.                                               v1.5.2
            + FixedColumns      Fix one or more columns to the left or right of a scrolling table.              v3.3.1        
            + FixedHeader       Sticky header and / or footer for the table.                                    v3.1.7
            + Responsive        Dynamically show and hide columns based on the browser size.                    v2.2.6
            + Scroller          Virtual rendering of a scrolling table for large data sets.                     v2.0.3
            + Select            Adds row, column and cell selection abilities to a table.                       v1.3.1
        
        -->
        <!-- versões de datatables.js e dataTables.editor.js customizada pela QUAD -->
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_v2/datatables_quad.js"></script>
        
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_v2/Editor-1.9.5/js/dataTables.editor_quad.js"></script>        
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_v2/Editor-1.9.5/js/editor.bootstrap4.min.js"></script>

        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_v2/Scroller-2.0.3/js/dataTables.scroller.min.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_v2/FixedHeader-3.1.7/js/dataTables.fixedHeader.min.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_v2/Select-1.3.1/js/dataTables.select.min.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_v2/Buttons-1.6.4/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_v2/Buttons-1.6.4/js/buttons.bootstrap4.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_v2/ColReorder-1.5.2/js/dataTables.colReorder.min.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_v2/ColReorder-1.5.2/js/colReorder.bootstrap4.min.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_v2/Responsive-2.2.6/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_v2/Responsive-2.2.6/js/responsive.bootstrap4.min.js"></script>

        <!-- versão antiga do datatables -->
<!--        
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_old/datatables.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_old/Editor-1.5.5/js/QuadDataTables.editor.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_old/Editor-1.5.5/js/editor.bootstrap.min.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_old/Scroller-1.4.1/js/dataTables.scroller.min.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_old/FixedHeader-3.1.1/js/dataTables.fixedHeader.min.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_old/Select-1.1.2/js/dataTables.select.min.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_old/dataTables.buttons.min.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_old/dataTables.bootstrap.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_old/dataTables.colReorder.min.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/js/datagrid/datatables_old/dataTables.responsive.min.js"></script>
-->        
        <?php 
            # Inicialização do ambiente JS da aplicação
            include_once APP_PATH.'/includes/quad_js_init.php'; 
        ?>

        <script src="<?php echo ASSETS_URL; ?>/lib/quad/QuadCore.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/lib/quad/QuadList.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/lib/quad/QuadWorkFlow.js"></script>

        <script src="<?php echo ASSETS_URL; ?>/lib/quad/QuadEditorEvents.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/lib/quad/QuadEvents.js"></script>

        <script src="<?php echo ASSETS_URL; ?>/lib/quad/QuadTable.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/lib/quad/QuadForm.js"></script>

        <!-- JUST FOR QUAD USE ONLY -->
        <!--<script src="<?php echo ASSETS_URL; ?>/lib/builder/quadBuilder.js"></script>-->

        <script src="<?php echo ASSETS_URL; ?>/lib/quad/quadHelper.js"></script>
        <script src="<?php echo ASSETS_URL; ?>/lib/lodash.3.10.1.min.js"></script>

        <script src="<?php echo ASSETS_URL; ?>/js/app_quad.js"></script>
        
        <!-- QUAD Processes manager -->
        <script src="<?php echo ASSETS_URL; ?>/lib/utils/Processo.js"></script>
        
        <!-- APENAS CARREGADO UMA VEZ NO ARRANQUE DA APP -->
        <script src="<?= ASSETS_URL ?>/js/quad_init_data.js"></script>

        <script>
            /* QUAD-SSE :: SERVER SIDE EVENTS */
            /* https://www.html5rocks.com/en/tutorials/eventsource/basics/ */
            if( typeof(EventSource) !== "undefined" && false ) {
               /*Yes! Server-sent events support!*/

                var sse_ = pn+"/data-source/quad_sse.php";
                if (quad_sse === undefined) {
                    var quad_sse = new EventSource(sse_);
                } 

                quad_sse.onopen = function() {
                    console.log("Quad-SSE connection opened!");
                };

                quad_sse.onmessage = function(event) {
                  var data = JSON.parse(event.data);
                  //console.log(data);
                  //console.log(data['NXT_RUN']);
                  //console.log(data['ETICKETS']);
                  document.getElementById("sse_etickets").innerHTML = data['ETICKETS'];
                  console.log('LAST_SEEN CONSIDERED: ' + data['LAST_SEEN'] + ' Unseen: ' + data['ETICKETS']);
                };

                quad_sse.onerror = function(err) {
                  console.error("QUAD EventSource failed:", err);
                };

            } else {
              /* Sorry! No server-sent events support.. */
              console.log("Sorry! No server-sent events support..");
            }


            /* SESSION TIMEOUT -> LOGOUT 
             * https://stackoverflow.com/questions/667555/how-to-detect-idle-time-in-javascript-elegantly
             * */
            var inactivityTime = function (mode) {
                var time, warn_logout, EXPIRATION_TIME = parseInt(60000) * parseInt(300000);  //60 seconds x Nr.Minutes -> Out

                // DOM Events
                document.onmousemove = resetTimer;
                document.onkeypress = resetTimer;
                document.onload = resetTimer;
                document.onmousemove = resetTimer;
                document.onmousedown = resetTimer; // touchscreen presses
                document.ontouchstart = resetTimer;
                document.onclick = resetTimer;     // touchpad clicks
                document.onkeypress = resetTimer;
                document.addEventListener('scroll', resetTimer, true); // improved; see comments
                window.onload = resetTimer;        

                function logout() {
                    $("[data-ref=logoutSession]").remove();
                    try {                
                        quad_sse.close();
                        console.log('Quad-SSE closed!');
                    } catch (e) {
                        null;
                    }
                    location.href = 'quad_lock.php'; //'quad_logout.php';
                    console.log("Session expired by User inactivity!!");
                }

                function logoutProximity () {
                    //console.log("Warning timer....");
                    //Remoção do Aviso caso esteja disponível, como consequência de um evento de "reset" aos timers de inativação
                    $("[data-ref=logoutSession]").remove();
                    //https://ux.stackexchange.com/questions/117972/where-to-show-session-has-expired
                    quad_notification_clear();     
                    quad_notification({
                            type: "info",
                            title: '<i class="fa fa-bell swing animated" style="color:#ffffffe6"></i>&nbsp;&nbsp;' + "<?php echo mb_strtoupper($msg_warning_expire_session_title, 'UTF-8'); ?>",
                            content: "<?php echo $msg_warning_expire_session_body; ?>", 
                    });                    
                }

                function resetTimer() {
                    //console.log("Timers (re)Set....");
                    //Expiration Timer
                    clearTimeout(time);
                    time = setTimeout(logout, EXPIRATION_TIME);

                    //Proximity Timer
                    clearTimeout(warn_logout);
                    $("[data-ref=logoutSession]").remove();
                    warn_logout = setTimeout(logoutProximity, (parseInt(EXPIRATION_TIME) - parseInt(20000)) ); //20 seconds before LOGOUT issues WARNING!!!
                }

                if (mode) {
                    //Start counting because after login NONE of the events might be triggered....
                    resetTimer();
                }
            };

            //Events
            window.onload = function() {
                inactivityTime("start");        
            }    

        </script>
    </body>
</html>