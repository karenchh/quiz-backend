<?php
// use try and catch error block to prevent crashing and stopping the execution
try{
    $host = "localhost";   // type of the host
    $port = 3306; // port number of mysql
    $dbname = "quizdb"; //db name
    $user = "root";// from the priviledges in xampp
    $pass = "";

    $connection = new PDO ("mysql:host=$host;port=$port;dbname=$dbname" , $user , $pass);

}catch(\Throwable $e){
    echo $e;
}