<?php
// Database connection
$username = "root";
$password = "";
$dbname = "your_database_name";

$conn = new mysqli( $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$flight_id = $_GET['flight_id'] ?? null;

if ($flight_id) {
    // Update the flight price to 0
    $stmt = $conn->prepare("UPDATE flights SET price = 0 WHERE flight_id = ?");
    $stmt->bind_param("i", $flight_id);

    if ($stmt->execute()) {
        echo "Refund processed. Flight price has been set to 0.";
    } else {
        echo "Error processing refund: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "Invalid flight ID.";
}

$conn->close();

// Redirect back to the tickets page
header("Location: tickets.php"); 
exit;
?>
