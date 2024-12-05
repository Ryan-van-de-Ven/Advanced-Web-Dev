<?php include '../view/header.php'; ?>
<main>
    <h1>Add Ticket</h1>
   
    <form method="POST" action="index.php?action=add_ticket">
        <label for="flight_id">Flight ID:</label>
        <input type="text" name="flight_id" id="flight_id" required>
        
        <label for="flight_code">Flight Code:</label>
        <input type="text" name="flight_code" id="flight_code" required>
        
        <label for="flight_name">Destination Name:</label>
        <input type="text" name="flight_name" id="flight_name" required>
        
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required>
        
        <label for="flight_date">Flight Date:</label>
        <input type="date" name="flight_date" id="flight_date" required>
        
        <label for="is_upcoming">Is Upcoming:</label>
        <input type="checkbox" name="is_upcoming" id="is_upcoming" value="1">
        
        <input type="submit" value="Add Ticket">
    </form>

    <p class="last_paragraph">
        <a href="index.php?action=list_tickets">View Ticket List</a>
    </p>

</main>
<?php // include '../view/footer.php'; ?>
