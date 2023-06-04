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

// Get form data
$houseName = $_POST['house_name'];
$image = $_FILES['image']['name'];
$description = $_POST['description'];

// Upload image file
$targetDir = "images/";
$targetFile = $targetDir . basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

// Insert data into the houses table
$sql = "INSERT INTO houses (house_name, image, description) VALUES ('$houseName', '$image', '$description')";
if ($conn->query($sql) === TRUE) {
    echo "New house added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

sleep(1);
header("Location: admin.php");
exit;
?>
