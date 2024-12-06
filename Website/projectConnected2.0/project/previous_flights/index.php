<?php
require('../model/database.php'); 
require('../model/ticket_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_tickets';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'delete_ticket') {
    $ticketID = $_POST['ticketID'];

                                                            // Query to delete the ticket from the database
    $query = 'DELETE FROM tickets WHERE ticketID = :ticketID';
    $statement = $db->prepare($query);
    $statement->bindValue(':ticketID', $ticketID);
    $statement->execute();
    $statement->closeCursor();

                                                     // Redirect to the ticket list page 
    header('Location: index.php?action=list_tickets');
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'update_ticket') {
    $ticketID = $_POST['ticketID'];
    $passengerName = $_POST['passengerName'];
    $flight_id = $_POST['flight_id'];
    $seatNumber = $_POST['seatNumber'];

                                                                                     // Update the ticket in the database
    $query = 'UPDATE tickets SET passengerName = :passengerName, flight_id = :flight_id, seatNumber = :seatNumber 
    WHERE ticketID = :ticketID';
    $statement = $db->prepare($query);
    $statement->bindValue(':ticketID', $ticketID);
    $statement->bindValue(':passengerName', $passengerName);
    $statement->bindValue(':flight_id', $flight_id);
    $statement->bindValue(':seatNumber', $seatNumber);
    $statement->execute();
    $statement->closeCursor();

                                                                         // Redirect or show a success message
    header('Location: index.php?action=list_tickets');
}

else if ($action == 'list_tickets') {
    $ticketID = filter_input(INPUT_GET, 'ticketID', FILTER_VALIDATE_INT);
    if ($ticketID == NULL || $ticketID == FALSE) {
        $ticketID = 1;
    }
    $is_upcoming = 0;
    $tickets = get_tickets($is_upcoming);
    include('ticket_list.php');
} else if ($action == 'add_ticket') {
    $ticketID = filter_input(INPUT_POST, 'ticketID', FILTER_VALIDATE_INT);
    $flight_id = filter_input(INPUT_POST, 'flight_id', FILTER_VALIDATE_INT);
    $passengerName = filter_input(INPUT_POST, 'passengerName');
    $seatNumber = filter_input(INPUT_POST, 'seatNumber');
    /*if ($category_id == NULL || $category_id == FALSE || $code == NULL || 
        $name == NULL || $price == NULL || $price == FALSE) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php'); 
    } else {*/                                  //Think on adding an error page

    add_ticket($ticketID, $flight_id, $passengerName, $seatNumber);
    header('Location: .');
} /*else if ($action == 'delete_ticket') {
    $ticketID = filter_input(INPUT_GET, 'ticketID', FILTER_VALIDATE_INT);
    $tickets = delete_ticket($ticketID);
    //include('ticket_list.php');
} */ /*else if ($action == 'update_ticket') {
    $ticketID = filter_input(INPUT_POST, 'ticketID', FILTER_VALIDATE_INT);
    $flight_id = filter_input(INPUT_POST, 'flight_id', FILTER_VALIDATE_INT);
    $passengerName = filter_input(INPUT_POST, 'passengerName');
    $seatNumber = filter_input(INPUT_POST, 'seatNumber');
    update_ticket($ticketID, $flight_id, $passengerName, $seatNumber); 
} */     /* else if ($action == 'delete_ticket') {

// Query to delete the ticket from the database
$query = 'DELETE FROM tickets WHERE ticketID = :ticketID';
$statement = $db->prepare($query);
$statement->bindValue(':ticketID', $ticketID);
$statement->execute();
$statement->closeCursor();

// Redirect to the ticket list page 
header('Location: index.php?action=list_tickets'); 
} */



?>