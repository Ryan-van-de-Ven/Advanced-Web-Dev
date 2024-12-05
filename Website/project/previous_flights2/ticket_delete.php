<?php include '../view/header.php'; 

// Query to get all tickets from the flights table
$query = 'SELECT flight_id, flight_code, flight_name, price, flight_date, is_upcoming FROM flights';
$statement = $db->prepare($query);
$statement->execute();
$tickets = $statement->fetchAll();
$statement->closeCursor();
?>


<main>
    <h1>Delete flight</h1>
   
    <?php foreach ($tickets as $ticket): ?>
        <form method="POST" action="index.php?action=delete_ticket">

            <label for="flight_id_<?php echo $ticket['flight_id']; ?>">Flight ID:</label>
            <input type="text" name="flight_id" id="flight_id_<?php echo $ticket['flight_id']; ?>" value="<?php echo $ticket['flight_id']; ?>" required>
            
            <label for="flight_code_<?php echo $ticket['flight_code']; ?>">Flight Code:</label>
            <input type="text" name="flight_code" id="flight_code_<?php echo $ticket['flight_code']; ?>" value="<?php echo $ticket['flight_code']; ?>" required>

            <label for="flight_name_<?php echo $ticket['flight_name']; ?>">Destination Name:</label>
            <input type="text" name="flight_name" id="flight_name_<?php echo $ticket['flight_name']; ?>" value="<?php echo $ticket['flight_name']; ?>" required>
            
            <label for="price_<?php echo $ticket['price']; ?>">Price:</label>
            <input type="text" name="price" id="price_<?php echo $ticket['price']; ?>" value="<?php echo $ticket['price']; ?>" required>

            <label for="flight_date_<?php echo $ticket['flight_date']; ?>">Flight Date:</label>
            <input type="text" name="flight_date" id="flight_date_<?php echo $ticket['flight_date']; ?>" value="<?php echo $ticket['flight_date']; ?>" required>

            <label for="is_upcoming_<?php echo $ticket['is_upcoming']; ?>">Is Upcoming:</label>
            <input type="text" name="is_upcoming" id="is_upcoming_<?php echo $ticket['is_upcoming']; ?>" value="<?php echo $ticket['is_upcoming']; ?>" required>
            
            <input type="submit" value="Delete Ticket">
        </form>
        <br>
    <?php endforeach; ?>

    <p class="last_paragraph">
        <a href="index.php?action=list_tickets&flight_type=previous">View Ticket List</a>
    </p>
</main>
