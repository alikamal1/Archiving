<?php

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "demo";
foreach($db as $key => $value){
    
    define(strtoupper($key),$value);
}

$connection=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if($connection){
    mysqli_set_charset($connection, "utf8");
    mysqli_query($connection, "SET NAMES utf8");
    //echo "We Are Connected!";
}
?>