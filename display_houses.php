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

// Fetch houses from the database
$sql = "SELECT * FROM houses";
$result = $conn->query($sql);

// Display houses
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $houseName = $row['house_name'];
        $image = $row['image'];
        $description = $row['description'];

        // Display house box
        echo '<div class="house-box">';
        echo '<img src="images/' . $image . '" alt="' . $houseName . '">';
        echo '<h3>' . $houseName . '</h3>';
        echo '<p class="description">' . $description . '</p>';
        echo '<button class="btn-show-description">Show Description</button>';
        echo '<div class="description-box">' . $description . '</div>';
        echo '</div>';
    }
} else {
    echo "No houses found.";
}

$conn->close();
?>
