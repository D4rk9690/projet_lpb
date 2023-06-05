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
    }
}

// Fetch houses from the database
$sql = "SELECT * FROM houses";
$result = $conn->query($sql);
?>
<style>
.house-section{
    background-color: black !important;
}

</style>

<?php
// Display houses
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $houseId = $row['id'];
        $houseName = $row['house_name'];
        $image = $row['image'];
        $description = $row['description'];
        $status = $row['status'];
        $status = $row['reserved'];
        // Display house box
        echo '<div class="house-box">';
        echo '<img src="../images/' . $image . '" alt="' . $houseName . '">';
        echo '<h3>' . $houseName . '</h3>';
        if ($row['status'] !== null && $row['status'] !== '') {
            echo '<div class="btn-container"><span> Status: ' . $row['status']. '</span></div>';
        }else{
            echo '';
        }
       
       if ($row['reserved'] !== null && $row['reserved'] !== '') {
            echo '<div class="btn-container"><span> Date: ' . $row['reserved'] . '</span></div>';
        }else{
            echo '<div class="btn-container"><span> Aucune réservation </span></div>';
        }
        echo '</div>';
    }
} else {
    echo "No houses found.";
}

$conn->close();

function getReservedDatesForHouse($houseId, $conn) {
    $reservedDates = array();
    $stmt = $conn->prepare("SELECT reserved FROM houses WHERE id = ?");
    $stmt->bind_param("i", $houseId);
    $stmt->execute();
    $stmt->bind_result($reservedDate);
    while ($stmt->fetch()) {
        $reservedDates[] = $reservedDate;
    }
    $stmt->close();
    return $reservedDates;
}

function updateReservedDate($houseId, $reservationDate, $conn) {
    $stmt = $conn->prepare("UPDATE houses SET reserved = ? WHERE id = ?");
    $stmt->bind_param("si", $reservationDate, $houseId);
    $stmt->execute();
    $stmt->close();
}


?>