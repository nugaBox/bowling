<?php

//====================== INFO ===========================
// Description :  인턴평가 DB 접속
// Path : /bowling/pj/dbConnect.php
//========================================================

    /**  DB 연결 정보  */
    // 기존 : dbuser / DBuser001!
    $dbHost = "localhost:6306";            // DB 주소
    $dbUserID = "ngjang";             // 사용자 ID
    $dbUserPW = "Mdbwkck001!";             // 사용자 PW
    $dbName = "bowlingdb";                  // DB명

    #$dbConn = mssql_connect($dbHost, $dbUserID, $dbUserPW) or DIE("DB서버 연결 오류");
    #mssql_select_db($dbName,$dbConn) or DIE("데이터베이스 연결 오류");
    $dbConn = mysqli_connect($dbHost, $dbUserID, $dbUserPW) or DIE("DB서버 연결 오류");
    mysqli_select_db($dbConn,$dbName) or DIE("데이터베이스 연결 오류");
?>
