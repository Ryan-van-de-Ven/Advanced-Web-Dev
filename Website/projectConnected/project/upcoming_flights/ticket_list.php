<?php include '../view/header.php'; ?>
<main>
    <h1>Flight List</h1>

    <section>
        <table>     <!-- Change this so it works with the database -->
            <tr>
                <th>Ticket ID</th>
                <th>Flight ID</th>
                <th class="right">Passenger Name</th>
                <th>Seat Number</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <!-- The commented code should create a good looking table once its changed to work with the database -->
             
            <?php foreach ($tickets as $ticket) :?>
            <tr>
                <td><?php echo $ticket['ticketID']; ?></td>
                <td><?php echo $ticket['flight_id']; ?></td>
                <td class="right"><?php echo $ticket['passengerName']; ?></td>
                <td><?php echo $ticket['seatNumber']; ?></td>
                <td><form action = "ticket_update.php" method = "post">
                    <!-- <input type = "hidden" name = "action" value = "update_ticket">    Do this after going to the page--> 
                    <input type = "hidden" name = "ticketID" value = "<?php echo $ticket['ticketID']; ?>">
                    <input type = "hidden" name = "flight_id" value = "<?php echo $ticket['flight_id']; ?>">
                    <input type = "hidden" name = "passengerName" value = "<?php echo $ticket['passengerName']; ?>">
                    <input type = "hidden" name = "seatNumber" value = "<?php echo $ticket['seatNumber']; ?>">
                    <input type = "submit" value = "Update">
                </form> </td>
                <td><form action = "ticket_display.php" method="post">
                    <input type = "submit" value="Display">
                </form> </td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="delete_ticket">
                    <input type="hidden" name="ticketID"
                           value="<?php echo $ticket['ticketID']; ?>">
                   <!-- <input type="hidden" name="ticketID"
                           value="<?php echo $ticket['ticketID']; ?>"> -->
                    <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
                </form></td>
            </tr>
            <?php endforeach; ?>
            

        </table>
        
        <p class="last_paragraph">
            <a href="?action=show_add_form">Add ticket</a>
        </p> 
    </section>
</main>
<?php include '../view/footer.php';?>