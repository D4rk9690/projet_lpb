<?php

// Include the database configuration file
include 'db_config.php';

// Handle reservation form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['house_id']) && isset($_POST['reservation_date'])) {
        $houseId = $_POST['house_id'];
        $reservationDate = $_POST['reservation_date'];

        // Update the reserved date for the house in the database
        updateReservedDate($houseId, $reservationDate, $conn);

        // Send a response back to the client
        echo "Reservation saved successfully!";
    } else {
        // Send an error response back to the client
        http_response_code(400);
        echo "Invalid request";
    }
} else {
    // Send an error response back to the client
    http_response_code(400);
    echo "Invalid request";
}

$conn->close();

function updateReservedDate($houseId, $reservationDate, $conn) {
    $stmt = $conn->prepare("UPDATE houses SET reserved = ? WHERE id = ?");
    $stmt->bind_param("si", $reservationDate, $houseId);
    $stmt->execute();
    $stmt->close();
}
?>
