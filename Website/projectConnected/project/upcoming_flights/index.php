<?php
require('../model/database.php');     //Commented so it doesn't throw an error. Uncomment after database.php is finished
require('../model/ticket_db.php');   //Commented for reference. If you want a primary key, you need to make a php file for it (Assignment 1)


//Consider using a similar structure as Assignment 1 by using $action variables to control site functions. Index functions as a hub for
//the actions. 'list_flights' is the default page instead of index.

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_tickets';
    }
}

//Kept for reference. This is how you do actions. Go to Assignment 1's Project Manager for further references.

if ($action == 'list_tickets') {
    $ticketID = filter_input(INPUT_GET, 'ticketID', FILTER_VALIDATE_INT);
    if ($ticketID == NULL || $ticketID == FALSE) {
        $ticketID = 1;
    }
    $is_upcoming = 1;
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
} else if ($action == 'delete_ticket') {
    $ticketID = filter_input(INPUT_GET, 'ticketID', FILTER_VALIDATE_INT);
    $tickets = delete_ticket($ticketID);
    //include('ticket_list.php');
} else if ($action == 'update_ticket') {
    $ticketID = filter_input(INPUT_POST, 'ticketID', FILTER_VALIDATE_INT);
    $flight_id = filter_input(INPUT_POST, 'flight_id', FILTER_VALIDATE_INT);
    $passengerName = filter_input(INPUT_POST, 'passengerName');
    $seatNumber = filter_input(INPUT_POST, 'seatNumber');
    update_ticket($ticketID, $flight_id, $passengerName, $seatNumber);
}


?>