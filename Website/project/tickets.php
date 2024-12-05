<?php
// Database connection
$username = ""; //Change to proper name
$password = ""; //Change to proper name
$dbname = ""; //Change to proper name


$conn = new mysqli( $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT t.ticket_id, t.flight_id, t.passengerName, t.seatNumber, f.flight_name 
        FROM tickets t
        INNER JOIN flights f ON t.flight_id = f.flight_id";
$result = $conn->query($sql);


echo "<h1 style='text-align: center;'>Tickets</h1>";

echo "<style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #6c757d;
            color: white;
        }
        .refund-button {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            border: none;
        }
        .refund-button:hover {
            background-color: #c82333;
        }
        .display-button {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }
        .display-button:hover {
            background-color: #0056b3;
        }
      </style>";

echo "<table>
        <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Flight ID</th>
                <th>Passenger Name</th>
                <th>Seat Number</th>
                <th>Refund Ticket</th>
                <th>Display Ticket</th>
            </tr>
        </thead>
        <tbody>";

if ($result->num_rows > 0) {
    while ($ticket = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$ticket['ticket_id']}</td>
                <td>{$ticket['flight_id']}</td>
                <td>{$ticket['passengerName']}</td>
                <td>{$ticket['seatNumber']}</td>
                <td>
                    <a href='refund.php?flight_id={$ticket['flight_id']}' class='refund-button'>Refund</a>
                </td>
                <td>
                    <a href='display_ticket.php?ticket_id={$ticket['ticket_id']}&flight_id={$ticket['flight_id']}&passenger_name={$ticket['passengerName']}&seat_number={$ticket['seatNumber']}&destination={$ticket['flight_name']}' class='display-button'>Display Ticket</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No tickets found.</td></tr>";
}

echo "</tbody></table>";
$conn->close();
?>
