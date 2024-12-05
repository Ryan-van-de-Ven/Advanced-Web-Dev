<?php include '../view/header.php'; ?>
<main>
    <h1>Add Ticket</h1>
   
    <form method="POST" action="index.php?action=add_ticket">


    <label for="ticket_id">ticket_id:</label>
    <input type="text" name="ticket_id" id="ticket_id" required>
    
    <label for="flight_id">flight_id :</label>
    <input type="text" name="flight_id" id="flight_id" required>
    
    <label for="passenger_name">passenger Name:</label>
    <input type="text" name="passenger_name" id="passenger_name" required>
    
    <label for="seat_number">seat_number:</label>
    <input type="text" name="seat_number" id="seat_number" required>

    
    <input type="submit" value="Add Ticket">
</form>


    <p class="last_paragraph">
        <a href="index.php?action=list_flights">View Ticket List</a>
    </p>

</main>
<?php // include '../view/footer.php'; ?>