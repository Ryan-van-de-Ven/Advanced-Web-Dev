<?php include '../view/header.php'; ?>
<main>
    <h1>Add Ticket</h1>
    <form action="index.php" method="post" id="add_ticket">
        <input type="hidden" name="action" value="add_ticket">

        <!--Remember to change the values here to correspond with the database's -->

        <label>Flight ID:</label>
        <input type="text" name="flight_id" />
        <br> <br>

        <label>Passenger Name:</label>
        <input type="text" name="passengerName" />
        <br> <br>

        <label>Seat Number:</label>
        <input type="text" name="seatNumber" />
        <br> <br>

        <label>&nbsp;</label>
        <input type="submit" value="Add Ticket" />
        <br>
    </form>
    <p class="last_paragraph">
        <a href=".">View Ticket List</a>
    </p>

</main>
<?php include '../view/footer.php'; ?>