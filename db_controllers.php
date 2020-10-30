<?php

function connect_db() {
    /* MY SQL - REMOTE */
    $sql_details = array(
        'host' => 'bd.wips.com.pt',
        'db' => 'quad_hcm',
        'user' => 'quadhcm',
        'pass' => 'manager1'
    );

    /* MY SQL - LOCAL
      $sql_details = array(
      'host' => 'localhost',
      'db' => 'quad_hcm',
      'user' => 'quadhcm',
      'pass' => 'manager1'
      );
     */


    /* ORACLE
      $sql_details = array(
      'host' => '80.172.253.30',
      'db' => 'demo',
      'user' => 'quad',
      'pass' => 'quad'
      );
     */
    try {
        //$lk = new PDO("mysql:host=wips.com.pt;dbname=portal_demo;charset=utf8mb4", 'portaldemo', 'manager1');

        $lk = new PDO("mysql:host={$sql_details['host']};dbname={$sql_details['db']};charset=utf8mb4", $sql_details['user'], $sql_details['pass'], array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'"
                )
        );
        $lk->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $lk->setAttribute(PDO::ATTR_PERSISTENT, false);


        // PTE 2017.05.04: identificar o utilizador aplicacional para a base de dados
#      if (@$_SESSION['database'] == 'MYSQL') {
        $stmt = $lk->prepare("SET @UTILIZADOR='" . @$_SESSION['utilizador'] . "'");
#      } else {
#            //ORACLE Database
#            $stmt = $lk->prepare(
#                "BEGIN DBMS_SESSION.SET_IDENTIFIER('" .
#                    @$_SESSION['utilizador'] . "') END;"
#            );
#      }
        $stmt->execute();

        return $lk;
    } catch (PDOException $e) {
        // Proccess error
        echo 'Cannot connect to database: ' . $e->getMessage();
    }

    /* Database connection information */
    //$gaSql['user']     = "DEMO";
    //$gaSql['password'] = "DEMO";


    /* PRS
      $gaSql['user'] = "cmip_demo";
      $gaSql['password'] = "cmip_demo";
      $gaSql['sid'] = "DEMO";
      $gaSql['port'] = "1521";
      $gaSql['server'] = "DSV.QUAD-SYSTEMS.COM";
      $gaSql['charset'] = "AL32UTF8";
     */
    /* LEO
      $gaSql['user'] = "teste";
      $gaSql['password'] = "teste";
      $gaSql['sid'] = "demo";
      $gaSql['port'] = "1521";
      $gaSql['server'] = "80.172.253.30";
      $gaSql['charset'] = "AL32UTF8";
     */

    /* QUAD
      $gaSql['user'] = "quad";
      $gaSql['password'] = "quad";
      $gaSql['sid'] = "demo";
      $gaSql['port'] = "1521";
      $gaSql['server'] = "80.172.253.30";
      $gaSql['charset'] = "AL32UTF8";


      $connection_string = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)
      (HOST = {$gaSql['server'] })(PORT = {$gaSql['port'] })))(CONNECT_DATA=(SID={$gaSql['sid']})))";

      $conn = oci_connect($gaSql['user'], $gaSql['password'], $connection_string, $gaSql['charset']);
      if (!$conn) {
      $e = oci_error();
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
      }
      //$stid = oci_parse($link, "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI'");
      //oci_execute($stid);
      $ling = @$_SESSION['lang'];
      if ($ling == 'pt')
      $stid = oci_parse($conn, 'ALTER SESSION SET NLS_LANGUAGE = "PORTUGUESE"');
      else if ($ling == 'us')
      $stid = oci_parse($conn, 'ALTER SESSION SET NLS_LANGUAGE = "AMERICAN"');
      else if ($ling == 'de')
      $stid = oci_parse($conn, 'ALTER SESSION SET NLS_LANGUAGE = "GERMAN"');
      else if ($ling == 'es')
      $stid = oci_parse($conn, 'ALTER SESSION SET NLS_LANGUAGE = "SPANISH"');
      else
      $stid = oci_parse($conn, 'ALTER SESSION SET NLS_LANGUAGE = "PORTUGUESE"');

      oci_execute($stid);

      return $conn;
     */
}
