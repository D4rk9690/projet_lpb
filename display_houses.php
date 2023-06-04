<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "examfin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

// Display houses
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $houseId = $row['id'];
        $houseName = $row['house_name'];
        $image = $row['image'];
        $description = $row['description'];

        // Display house box
        echo '<div class="house-box">';
        echo '<img src="images/' . $image . '" alt="' . $houseName . '">';
        echo '<h3>' . $houseName . '</h3>';
        echo '<p class="description">' . $description . '</p>';
        echo '<button class="btn-show-description" data-house="' . $houseId . '">Show Description</button>';

        // Display house agenda
        echo '<div class="agenda" data-house="' . $houseId . '">';
        echo '<div class="calendar">';
        // Get reserved dates for this house from the database
        $reservedDates = getReservedDatesForHouse($houseId, $conn);
        // Generate the calendar dynamically
        $currentDate = new DateTime();
        $currentDate->setTime(0, 0, 0);
        $daysInMonth = intval($currentDate->format('t'));
        for ($j = 1; $j <= $daysInMonth; $j++) {
            $date = new DateTime($currentDate->format('Y-m-') . $j);
            $calendarDay = '<div class="calendar-day';
            if (in_array($date->format('Y-m-d'), $reservedDates)) {
                $calendarDay .= ' reserved';
            }
            $calendarDay .= '">';
            $calendarDay .= $j;
            $calendarDay .= '</div>';
            echo $calendarDay;
        }
        echo '</div>';
        echo '<form class="reservation-form" method="POST" action="">';
        echo '<input type="hidden" name="house_id" value="' . $houseId . '">';
        echo '<input type="date" name="reservation_date">';
        echo '<button type="submit">Reserve</button>';
        echo '</form>';
        echo '</div>';

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
