<?php
    /* QUADSYSTEMS -> Server Side Event, initialized by home.php after authentication. 
     * Maximum 6 per browser (session)!
     * 
     * Created by PMA, 2019-11-25
     */
    require_once 'quad_head_controller.php';
    /*
     * Initialization
     */
    $timer_frequency_seconds = 60; // seconds
//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);
//
//    if (session_id() == '') {
//        session_start();
//    }
    
    # Línguas
    // setting language variable. PORTUGUESE as default
//    if (!isset($_SESSION['lang']) || @$_SESSION['lang'] == '') {
//        $_SESSION['lang'] = 'pt';
//        session_write_close();
//    }
//    require_once INCLUDES_PATH."/lang/quad_labels_" . $_SESSION['lang'] . ".php";
//
//    require_once INCLUDES_PATH."/lib/quad_db_lib.php";
//    
//    include "../lib/db.php";
//    
//    $db = connect_db();
//    date_default_timezone_set('Europe/Lisbon');
//    error_reporting(0);    
    
    $user = @$_SESSION['utilizador'];
    
    /*
     * https://developer.mozilla.org/en-US/docs/Web/API/Server-sent_events/Using_server-sent_events
     */
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');

    ## PTE 2020.09.24: desativei esta funcionalidade pq estava a gerar muitas coneções em aberto.
    while (false) {

        /* GET LAST_SEEN */
        $sql = "SELECT TO_CHAR(x.DATA,'YYYY-MM-DD HH24:MI:SS') as LAST_SEEN FROM E_TICKET_LAST_SEEN x WHERE x.USER = :U1";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':U1', $user, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $number_of_rows = $stmt->rowCount();
            if ($row['LAST_SEEN'] == '') {
                $time = '1900-01-01 00:00:00';
            } else {
                $time = $row['LAST_SEEN'];
            }
        } catch(PDOException $ex) {
            //Something went wrong rollback!
            echo $ex->getMessage();
        }
        
        //Every second, send a "ping" event.
        //echo "event: ping\n";          
        $sql = "SELECT COUNT(A.ID_ETICKET) CNT FROM WEB_ETICKETS A " .
                "WHERE (A.TO_ LIKE :V1 OR A.CC LIKE :V2" .
               "  AND A.DT_INSERTED >= TO_DATE(:V3, 'YYYY-MM-DD HH24:MI:SS') OR A.DT_UPDATED >= TO_DATE(:V4, 'YYYY-MM-DD HH24:MI:SS') )".
               "  OR (A.FROM_ LIKE :V5 AND A.DT_UPDATED >= TO_DATE(:V6, 'YYYY-MM-DD HH24:MI:SS') )";
        //$sql = "SELECT COUNT(ID_ETICKET) CNT FROM WEB_ETICKETS A WHERE (A.TO_ LIKE '%alvaro.freitas%' OR A.CC LIKE '%alvaro.freitas%') ";
        
        //Last time seen
        //$time = @$_SESSION['ETICKET_LAST_SEEN']; //date('Y-m-d H:i:s');
/*
    TABLE: E_TICKET_LAST_SEEN   
*/     
        $res = '';
        try {
            $usr_others = "%".$user."%";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':V1', $usr_others, PDO::PARAM_STR);
            $stmt->bindParam(':V2', $usr_others, PDO::PARAM_STR);
            $stmt->bindParam(':V3', $time, PDO::PARAM_STR);
            $stmt->bindParam(':V4', $time, PDO::PARAM_STR);
            $stmt->bindParam(':V5', $user, PDO::PARAM_STR);
            $stmt->bindParam(':V6', $time, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $dados = json_encode($row['CNT']);       
        } catch (Exception $e) {
            $res = "data: Error {$sql} on {$usr}  {$time}\n";
        }
        
        //Next Run time
        $next_run = date("Y-m-d H:i:s", time() + $timer_frequency_seconds);
        $res = "data: {\"NXT_RUN\": \"{$next_run}\", \"ETICKETS\": \"{$row['CNT']}\", \"LAST_SEEN\": \"{$time}\", \"NR_ROWS\": \"{$number_of_rows}\"}\n\n";

        if ($res == '') {
            echo "data: {$dados}";
        } else {
            echo $res;
        }
        
        ob_end_flush();
        flush();
        session_write_close();
        
        //break the loop if the client aborted the connection (closed the page)
        if ( connection_aborted() ) break;
        
        //Sleep during 30 seconds, before sending other message
        sleep($timer_frequency_seconds);
        
    }
    
?>

