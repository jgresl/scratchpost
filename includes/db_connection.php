<?php

 function openConnection(){
    $connString = "mysql:host=localhost; dbname=scratchpost";
    $user="web_user";
    $pass="web_pass";
    $pdo=new PDO($connString, $user, $pass);
    return $pdo;
}

function closeConnection($pdo){
    $pdo=null;
}    

?>