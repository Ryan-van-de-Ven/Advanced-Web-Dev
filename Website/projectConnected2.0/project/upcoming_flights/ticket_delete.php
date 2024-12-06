<?php include '../view/header.php'; 
require('../model/database.php');
                                                                                    // Query to get all tickets
$query = 'SELECT * FROM tickets';
$statement = $db->prepare($query);
$statement->execute();
$tickets = $statement->fetchAll();
$statement->closeCursor();
?>

<main>
    <h1>Delete Ticket</h1>
                                                                        
    <?php foreach ($tickets as $ticket): ?>
        <form method="POST" action="index.php?action=delete_ticket">
            <input type="hidden" name="ticketID" value="<?php echo $ticket['ticketID']; ?>">

            <label for="passengerName_<?php echo $ticket['ticketID']; ?>">Passenger Name:</label>
            <input type="text" name="passengerName" id="passengerName_<?php echo $ticket['ticketID']; ?>" value="<?php echo $ticket['passengerName']; ?>" readonly>
            <br>
            <label for="flight_id_<?php echo $ticket['ticketID']; ?>">Flight ID:</label>
            <input type="text" name="flight_id" id="flight_id_<?php echo $ticket['ticketID']; ?>" value="<?php echo $ticket['flight_id']; ?>" readonly>
            <br>
            <label for="seatNumber_<?php echo $ticket['ticketID']; ?>">Seat Number:</label>
            <input type="text" name="seatNumber" id="seatNumber_<?php echo $ticket['ticketID']; ?>" value="<?php echo $ticket['seatNumber']; ?>" readonly>

            <input type="submit" value="Delete Ticket" onclick="return confirm('Are you sure you want to delete this ticket?');">
        </form>
        <br> <br>
    <?php endforeach; ?>

    <p class="last_paragraph">
        <a href=".">View Ticket List</a>
    </p>
</main>

<?php // include '../view/footer.php'; ?>
