<?php
//something
    $db = mysql_connect('localhost', 'phpriot_demo', 'phpriot123');
 
    if (!$db) {
        echo "Unable to establish connection to database server";
        exit;
    }
 
    if (!mysql_select_db('phpriot_demo', $db)) {
        echo "Unable to connect to database";
        exit;
    }
?>