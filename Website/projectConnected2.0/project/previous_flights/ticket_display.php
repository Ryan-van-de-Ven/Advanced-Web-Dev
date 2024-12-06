<?php include '../view/header.php'; ?>

<style>
    .ticket {
        width: 500px;
        margin: 20px auto;
        padding: 20px;
        border: 2px solid #333;
        border-radius: 10px;
        background-color: #FFA500; /* Orange background color */
        font-family: Arial, sans-serif;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add slight shadow for a nice effect */
    }

    .ticket h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #fff; /* White text for better contrast */
    }

    .ticket p {
        margin: 10px 0;
        font-size: 16px;
        color: #fff; /* White text for better readability */
    }

    .ticket strong {
        color: #222;
    }

    .ticket-footer {
        text-align: center;
        margin-top: 20px;
    }

    .ticket-footer a {
        text-decoration: none;
        color: #fff;
        background-color: #333;
        padding: 8px 12px;
        border-radius: 5px;
        font-size: 16px;
    }

    .ticket-footer a:hover {
        background-color: #555;
    }
</style>

<main>
    <div class="ticket">
        <h2>TICKET TO TRAVEL</h2>

        <?php
        require_once '../model/database.php';

        $ticketID = filter_input(INPUT_POST, 'ticketID', FILTER_SANITIZE_NUMBER_INT);

        if ($ticketID) {
            $query = "
                SELECT t.ticketID, t.flight_id, t.passengerName, t.seatNumber, f.flight_name
                FROM tickets t
                INNER JOIN flights f ON t.flight_id = f.flight_id
                WHERE t.ticketID = :ticketID";
            $statement = $db->prepare($query);
            $statement->bindValue(':ticketID', $ticketID, PDO::PARAM_INT);

            try {
                $statement->execute();
                $ticket = $statement->fetch(PDO::FETCH_ASSOC);
                $statement->closeCursor();

                if ($ticket) {
                    // Display the ticket details
                    echo "<p><strong>Ticket ID:</strong> " . htmlspecialchars($ticket['ticketID']) . "</p>";
                    echo "<p><strong>Flight ID:</strong> " . htmlspecialchars($ticket['flight_id']) . "</p>";
                    echo "<p><strong>Passenger Name:</strong> " . htmlspecialchars($ticket['passengerName']) . "</p>";
                    echo "<p><strong>Seat Number:</strong> " . htmlspecialchars($ticket['seatNumber']) . "</p>";
                    echo "<p><strong>Flight:</strong> " . htmlspecialchars($ticket['flight_name']) . "</p>";
                } else {
                    echo "<p>Ticket not found.</p>";
                }
            } catch (PDOException $e) {
                echo "<p>Error fetching ticket details: " . $e->getMessage() . "</p>";
            }
        } else {
            echo "<p>Invalid ticket ID.</p>";
        }
        ?>
    </div>

    <div class="ticket-footer">
        <a href="ticket_list.php">Back to Ticket List</a>
    </div>
</main>

<?php include '../view/footer.php'; ?>
