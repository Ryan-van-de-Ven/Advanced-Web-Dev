<?php
require('../model/Database.php');

                                                                            // Retrieve the action from the request (GET or POST)
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
}

if ($action == NULL) {
    $action = 'list_tickets'; // Default action
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'delete_ticket') {
    $ticket_id = $_POST['ticket_id'];

                                                            // Query to delete the ticket from the database
    $query = 'DELETE FROM tickets WHERE ticket_id = :ticket_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':ticket_id', $ticket_id);
    $statement->execute();
    $statement->closeCursor();

                                                     // Redirect to the ticket list page 
    header('Location: index.php?action=list_tickets');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'update_ticket') {
    $ticket_id = $_POST['ticket_id'];
    $passenger_name = $_POST['passenger_name'];
    $flight_id = $_POST['flight_id'];
    $seat_number = $_POST['seat_number'];

                                                                                     // Update the ticket in the database
    $query = 'UPDATE tickets SET passenger_name = :passenger_name, flight_id = :flight_id, seat_number = :seat_number WHERE ticket_id = :ticket_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':ticket_id', $ticket_id);
    $statement->bindValue(':passenger_name', $passenger_name);
    $statement->bindValue(':flight_id', $flight_id);
    $statement->bindValue(':seat_number', $seat_number);
    $statement->execute();
    $statement->closeCursor();

                                                                         // Redirect or show a success message
    header('Location: index.php?action=list_tickets');
}



if ($action === 'add_ticket') {
                                                                                            // Retrieve form data
    $ticket_id = filter_input(INPUT_POST, 'ticket_id', FILTER_SANITIZE_STRING);
    $flight_id = filter_input(INPUT_POST, 'flight_id', FILTER_VALIDATE_INT);

    $passenger_name = filter_input(INPUT_POST, 'passenger_name', FILTER_SANITIZE_STRING);
    $seat_number = filter_input(INPUT_POST, 'seat_number', FILTER_SANITIZE_STRING);

                                                                                                 // Validate inputs
    if ($ticket_id && $flight_id && $passenger_name && $seat_number) {
        try {
                                                                                                         // Database query to insert the ticket into the database
            $query = 'INSERT INTO tickets (flight_id, passenger_name, seat_number) 
            VALUES (:flight_id, :passenger_name, :seat_number)';    
            $statement = $db->prepare($query);
            $statement->bindValue(':flight_id', $flight_id);
            $statement->bindValue(':passenger_name', $passenger_name);
            $statement->bindValue(':seat_number', $seat_number);
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
    
        <li><a href="?action=add_ticket">Add Ticket Flights</a></li>
        <li><a href="?action=list_tickets">Show Ticket Flights</a></li>
        <li><a href="?action=update_ticket">Update Ticket Flights</a></li>
        <li><a href="?action=delete_ticket">Delete Ticket Flights</a></li>
    </ul>

    <?php
   
    if ($action === 'add_ticket') {
        require('../upcoming_flights/ticket_add.php'); 
    } elseif ($action === 'list_tickets') {
    
        echo "<p>Display the list of tickets here.</p>";
    } elseif ($action === 'update_ticket') {
   
        require('../upcoming_flights/ticket_update.php');
    } elseif ($action === 'delete_ticket') {
        require('../upcoming_flights/ticket_delete.php');
       
    }
    ?>
</main>
