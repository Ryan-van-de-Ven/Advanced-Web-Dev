<?php
// Database connection
$username = ""; //Change to proper name
$password = ""; //Change to proper name
$dbname = ""; //Change to proper name


$conn = new mysqli( $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$ticket_id = $_GET['ticket_id'] ?? 'N/A';


$sql = "SELECT t.ticket_id, t.flight_id, t.passengerName, t.seatNumber, f.flight_name AS destination
        FROM tickets t
        INNER JOIN flights f ON t.flight_id = f.flight_id
        WHERE t.ticket_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ticket_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $ticket = $result->fetch_assoc();
    $ticket_id = $ticket['ticket_id'];
    $flight_id = $ticket['flight_id'];
    $passenger_name = $ticket['passengerName'];
    $seat_number = $ticket['seatNumber'];
    $destination = $ticket['destination'];
} else {
    $ticket_id = "N/A";
    $flight_id = "N/A";
    $passenger_name = "N/A";
    $seat_number = "N/A";
    $destination = "N/A";
}


$stmt->close();
$conn->close();

echo "<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            flex-direction: column;
        }
        .ticket {
            width: 600px;
            background: linear-gradient(135deg, #f7d9a0, #e9b078);
            border: 2px solid #d89e5c;
            border-radius: 12px;
            padding: 20px;
            text-align: left;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .ticket-header {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #5b3927;
        }
        .ticket-row {
            margin-bottom: 12px;
            font-size: 16px;
            line-height: 1.5;
            color: #3b3b3b;
        }
        .ticket-row span {
            font-weight: bold;
            color: #5b3927;
        }
        .back-button {
            margin-top: 20px;
            text-align: center;
        }
        .back-button button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .back-button button:hover {
            background-color: #444444;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='ticket'>
            <h1>Ticket to Travel</h1>
            <p><strong>Ticket ID:</strong> $ticket_id</p>
            <p><strong>Flight ID:</strong> $flight_id</p>
            <div class='section'>
                <div><strong>Passenger:</strong> $passenger_name</div>
                <div><strong>Seat Number:</strong> $seat_number</div>
            </div>
            <div class='section'>
                <div><strong>Destination:</strong> $destination</div>
            </div>
        </div>
        <div class='back-button'>
            <a href='tickets.php'> 
                <button>Back</button>
            </a>
        </div>
    </div>
</body>
</html>";
?>
