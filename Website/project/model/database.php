<?php
    //$dsn = 'mysql:host=localhost;dbname=my_guitar_shop1';     Change so the database is for Upcoming Flights
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