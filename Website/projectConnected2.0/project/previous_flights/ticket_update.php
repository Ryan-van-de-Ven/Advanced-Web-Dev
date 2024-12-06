<?php include '../view/header.php'; 
require('../model/database.php');
                                                                                                    // Query to get all tickets
$query = 'SELECT ticketID, passengerName, flight_id, seatNumber FROM tickets';
$statement = $db->prepare($query);
$statement->execute();
$tickets = $statement->fetchAll();
$statement->closeCursor();
?>

<main>
    <h1>Update Ticket</h1>
   
    <?php foreach ($tickets as $ticket): ?>
        <form method="POST" action="index.php?action=update_ticket">
            <input type="hidden" name="ticketID" value="<?php echo $ticket['ticketID']; ?>">
            
            <label for="passengerName_<?php echo $ticket['ticketID']; ?>">Passenger Name:</label>
            <input type="text" name="passengerName" id="passengerName_<?php echo $ticket['ticketID']; ?>" value="<?php echo $ticket['passengerName']; ?>" required>
            <br>
            <label for="flight_id_<?php echo $ticket['ticketID']; ?>">Flight ID:</label>
            <input type="text" name="flight_id" id="flight_id_<?php echo $ticket['ticketID']; ?>" value="<?php echo $ticket['flight_id']; ?>" required>
            <br>
            <label for="seatNumber_<?php echo $ticket['ticketID']; ?>">Seat Number:</label>
            <input type="text" name="seatNumber" id="seatNumber_<?php echo $ticket['ticketID']; ?>" value="<?php echo $ticket['seatNumber']; ?>" required>
            
            <input type="submit" value="Update Ticket">
        </form>
        <br> <br>
    <?php endforeach; ?>

    <p class="last_paragraph">
        <a href=".">View Ticket List</a>
    </p>
</main>

<?php // include '../view/footer.php'; ?>
