<?php
function get_tickets($is_upcoming) {    //Returns all tickets in db
    global $db;

    $query = 'SELECT tickets.ticketID, tickets.flight_id, tickets.passengerName, tickets.seatNumber 
        FROM tickets LEFT JOIN flights ON tickets.flight_id = flights.flight_id WHERE flights.is_upcoming = :is_upcoming;';
    $statement = $db->prepare($query);
    $statement->bindValue(":is_upcoming", $is_upcoming);
    $statement->execute();
    $tickets = $statement->fetchAll();
    $statement->closeCursor();
    return $tickets;
}

function get_ticket($ticketID) {   //Returns a single ticket from the db
    global $db;
    $query = 'SELECT * FROM ticket WHERE ticketID = :ticketID';
    $statement = $db->prepare($query);
    $statement->bindValue(":ticketID", $ticketID);
    $statement->execute();
    $ticket = $statement->fetch();
    return $ticket;
}

function add_ticket($ticketID, $flight_id, $passengerName, $seatNumber) {
    global $db;
    $query = 'INSERT INTO tickets (ticketID, flight_id, passengerName, seatNumber)
        VALUES (:ticketID, :flight_id, :passengerName, :seatNumber)';    //May need to quote passName and seat#
    $statement = $db->prepare($query);
    $statement->bindValue(':ticketID', $ticketID);
    $statement->bindValue(':flight_id', $flight_id);
    $statement->bindValue(':passengerName', $passengerName);
    $statement->bindValue(':seatNumber', $seatNumber);
    $statement->execute();
    $statement->closeCursor();
}

function delete_ticket($ticketID) {
    global $db;
    $query = 'DELETE FROM tickets WHERE ticketID = :ticket_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':ticketID', $ticketID);
    $statement->execute();
    $statement->closeCursor();
}

function update_ticket($ticketID, $flight_id, $passengerName, $seatNumber) {
    global $db;
    $query = 'UPDATE tickets 
        SET ticketID = :ticketID, flight_id = :flight_id, passengerName = :passengerName, seatNumber = :seatNumber';    
    $statement = $db->prepare($query);
    $statement->bindValue(':ticketID', $ticketID);
    $statement->bindValue(':flight_id', $flight_id);
    $statement->bindValue(':passengerName', $passengerName);
    $statement->bindValue(':seatNumber', $seatNumber);
    $statement->execute();
    $statement->closeCursor();
}
?>