<?php include '../view/header.php'; ?>
<style>
    form {
        display: inline-block;
    }
</style>
<script>
    
    function confirmRefund(ticketID) {
        return confirm(`Are you sure you want to refund ticket ${ticketID}?`);
    }
</script>
<main>
    <h1>Flight List</h1>

    <section>
        <table>
            <tr>
                <th>Ticket ID</th>
                <th>Flight ID</th>
                <th class="right">Passenger Name</th>
                <th>Seat Number</th>
                <th>Display</th>
                <th>Refund</th>
               
            </tr>

            <?php foreach ($tickets as $ticket) : ?>
            <tr>
                <td><?php echo $ticket['ticketID']; ?></td>
                <td><?php echo $ticket['flight_id']; ?></td>
                <td class="right"><?php echo $ticket['passengerName']; ?></td>
                <td><?php echo $ticket['seatNumber']; ?></td>
                <td>
                   <form action="ticket_display.php" method="post">
                       <input type="hidden" name="ticketID" value="<?php echo $ticket['ticketID']; ?>">
                       <input type="submit" value="Display">
                   </form>
                </td>
                <td>
                    <form action="" method="post" onsubmit="return confirmRefund(<?php echo $ticket['ticketID']; ?>);">
                        <input type="hidden" name="ticketID" value="<?php echo $ticket['ticketID']; ?>">
                        <input type="submit" value="Refund">
                    </form>
                </td>
               
            </tr>
            <?php endforeach; ?>
        </table>

        <p class="last_paragraph">
            <form action="ticket_add.php" method="post">
                <input type="submit" name="add_ticket_button" value="Add Ticket">
            </form> &nbsp;
            <form action="ticket_update.php" method="post">
                <input type="submit" name="update_ticket_button" value="Update Tickets">
            </form> &nbsp;
            <form action="ticket_delete.php" method="post">
                <input type="submit" name="delete_ticket_button" value="Delete Tickets">
            </form>
            <br><br>
            <a href="..">Flight Select</a>
        </p>
    </section>
</main>
<?php include '../view/footer.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ticketID'])) {
    $ticketID = filter_input(INPUT_POST, 'ticketID', FILTER_SANITIZE_NUMBER_INT);

   
    $query = "UPDATE flights 
              SET price = 0 
              WHERE flight_id = (
                  SELECT flight_id 
                  FROM tickets 
                  WHERE ticketID = :ticketID
              )";
    $statement = $db->prepare($query);
    $statement->bindValue(':ticketID', $ticketID, PDO::PARAM_INT);

    try {
        $statement->execute();
        echo "<script>alert('Ticket $ticketID has been refunded successfully.');</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Error refunding ticket $ticketID: " . $e->getMessage() . "');</script>";
    }
}
?>
