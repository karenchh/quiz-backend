<?php
include 'connection.php';

if (isset($_GET["title"],$_GET["description"])){
    //Retriving title and description from url by get statment
    $title = $_GET["title"];
    $description = $_GET["description"];
}
