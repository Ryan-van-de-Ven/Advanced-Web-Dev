<?php
    $dsn = 'mysql:host=localhost;dbname=flight_management';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
    //    include('../errors/database_error.php');  If we're making an error page, uncomment and fix
        exit();
    }
?>