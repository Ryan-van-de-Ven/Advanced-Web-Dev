<?php include '../view/header.php'; 

                                                                                                    // Query to get all tickets
$query = 'SELECT ticket_id, passenger_name, flight_id, seat_number FROM tickets';
$statement = $db->prepare($query);
$statement->execute();
$tickets = $statement->fetchAll();
$statement->closeCursor();
?>

<main>
    <h1>Update Ticket</h1>
   
    <?php foreach ($tickets as $ticket): ?>
        <form method="POST" action="index.php?action=update_ticket">
            <input type="hidden" name="ticket_id" value="<?php echo $ticket['ticket_id']; ?>">
            
            <label for="passenger_name_<?php echo $ticket['ticket_id']; ?>">Passenger Name:</label>
            <input type="text" name="passenger_name" id="passenger_name_<?php echo $ticket['ticket_id']; ?>" value="<?php echo $ticket['passenger_name']; ?>" required>
            
            <label for="flight_id_<?php echo $ticket['ticket_id']; ?>">Flight ID:</label>
            <input type="text" name="flight_id" id="flight_id_<?php echo $ticket['ticket_id']; ?>" value="<?php echo $ticket['flight_id']; ?>" required>
            
            <label for="seat_number_<?php echo $ticket['ticket_id']; ?>">Seat Number:</label>
            <input type="text" name="seat_number" id="seat_number_<?php echo $ticket['ticket_id']; ?>" value="<?php echo $ticket['seat_number']; ?>" required>
            
            <input type="submit" value="Update Ticket">
        </form>
        <br>
    <?php endforeach; ?>

    <p class="last_paragraph">
        <a href="index.php?action=list_flights">View Ticket List</a>
    </p>
</main>

<?php // include '../view/footer.php'; ?>
