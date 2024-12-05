<?php
require('../model/Database.php');


                                                                                    // Retrieve the action from the request 
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
}

if ($action == NULL) {
    $action = 'list_tickets';
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'delete_ticket') {
    $flight_id = $_POST['flight_id'];

                                                                                // Query to delete the ticket from the database
    $query = 'DELETE FROM flights WHERE flight_id = :flight_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':flight_id', $flight_id);
    $statement->execute();
    $statement->closeCursor();

                                                                                 // Redirect to the ticket list page 
    header('Location: index.php?action=list_tickets&flight_type=previous');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'update_ticket') {
    $flight_id = filter_input(INPUT_POST, 'flight_id', FILTER_VALIDATE_INT);
    $flight_code = filter_input(INPUT_POST, 'flight_code', FILTER_SANITIZE_STRING);
    $flight_name = filter_input(INPUT_POST, 'flight_name', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $flight_date = filter_input(INPUT_POST, 'flight_date', FILTER_SANITIZE_STRING);
    $is_upcoming = filter_input(INPUT_POST, 'is_upcoming', FILTER_VALIDATE_BOOLEAN);

                                                                                                  // Validate inputs
    if ($flight_id && $flight_code && $flight_name && $price && $flight_date && $is_upcoming !== null) {
        try {
                                                                                                               // Update the ticket in the previous flights database
            $query = 'UPDATE flights 
                      SET flight_code = :flight_code, flight_name = :flight_name, price = :price, 
                          flight_date = :flight_date, is_upcoming = :is_upcoming
                      WHERE flight_id = :flight_id';    
            $statement = $db->prepare($query);
            $statement->bindValue(':flight_id', $flight_id);
            $statement->bindValue(':flight_code', $flight_code);
            $statement->bindValue(':flight_name', $flight_name);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':flight_date', $flight_date);
            $statement->bindValue(':is_upcoming', $is_upcoming);
            $statement->execute();
            $statement->closeCursor();

                                                                                                       // Redirect to the list of tickets or show a success message
            header('Location: index.php?action=list_tickets&flight_type=previous');
            exit();
        } catch (PDOException $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>Please fill out all fields correctly.</p>";
    }
}
if ($action === 'add_ticket') {
                                                                                     // Retrieve form data
    $flight_id = filter_input(INPUT_POST, 'flight_id', FILTER_VALIDATE_INT);
    $flight_code = filter_input(INPUT_POST, 'flight_code', FILTER_SANITIZE_STRING);
    $flight_name = filter_input(INPUT_POST, 'flight_name', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $flight_date = filter_input(INPUT_POST, 'flight_date', FILTER_SANITIZE_STRING);
    $is_upcoming = filter_input(INPUT_POST, 'is_upcoming', FILTER_VALIDATE_BOOLEAN);

                                                                                             // Validate inputs
    if ($flight_id && $flight_code && $flight_name && $price && $flight_date && isset($is_upcoming)) {
        try {
                                                                                                              // Insert ticket into the database
            $query = 'INSERT INTO flights (flight_id, flight_code, flight_name, price, flight_date, is_upcoming) 
                      VALUES (:flight_id, :flight_code, :flight_name, :price, :flight_date, :is_upcoming)';
            $statement = $db->prepare($query);
            $statement->bindValue(':flight_id', $flight_id);
            $statement->bindValue(':flight_code', $flight_code);
            $statement->bindValue(':flight_name', $flight_name);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':flight_date', $flight_date);
            $statement->bindValue(':is_upcoming', $is_upcoming);
            $statement->execute();
            $statement->closeCursor();

                                                                             // Redirect to the list of tickets or show a success message
            header('Location: index.php?action=list_tickets');
            exit();
        } catch (PDOException $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>Please fill out all fields correctly.</p>";
    }
}

?>
<main>
    <h1>Menu</h1>
    <ul>
         <li><a href="/model/index.php">Main Menu</a></li>
        <li><a href="?action=add_ticket">Add Ticket Flights</a></li>
        <li><a href="?action=list_tickets">Show Ticket Flights</a></li>
        <li><a href="?action=update_ticket">Update Ticket Flights</a></li>
        <li><a href="?action=delete_ticket">Delete Ticket Flights</a></li>
    </ul>

    <?php
    if ($action === 'add_ticket') {
        require('../previous_flights/ticket_add.php');   
    } elseif ($action === 'list_tickets') {
        echo "<p>Display the list of tickets here.</p>";
    } elseif ($action === 'update_ticket') {
       
        require('../previous_flights/ticket_update.php');
       
    } elseif ($action === 'delete_ticket') {
        require('../previous_flights/ticket_delete.php');
      
    }
    ?>
</main>
