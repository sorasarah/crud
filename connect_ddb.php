<?php
    $host = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "crud";

    //Create connection
    $conn = null;
    try {
        $conn = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
        echo "Connected successfully";
    } catch (PDOException $e) {
        throw $e;
    }

?>

