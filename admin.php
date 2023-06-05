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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['house_id'])) {
        $houseId = $_POST['house_id'];
        
        if ($houseId === 'new') {
            // Add a new house
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
        } else {
            // Edit an existing house
            $houseName = $_POST['house_name'];
            $image = $_FILES['image']['name'];
            $description = $_POST['description'];
            
            // Update data in the houses table
            $sql = "UPDATE houses SET house_name = '$houseName', image = '$image', description = '$description' WHERE id = $houseId";
            if ($conn->query($sql) === TRUE) {
                echo "House updated successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

// Fetch houses from the database
$sql = "SELECT * FROM houses";
$result = $conn->query($sql);

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            background-color: #141414;
            color: #fff;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        
        h1, h2 {
            color: #fff;
            text-align: center;
        }
        
        form {
            display: flex;
            flex-direction: column;
            max-width: 500px;
            margin: 0 auto;
        }
        
        label {
            margin-bottom: 10px;
        }
        
        select, input[type="text"], input[type="file"], textarea {
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 4px;
            background-color: #2c2c2c;
            color: #fff;
        }
        
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        
        input[type="submit"]:hover {
            background-color: #0069d9;
        }
        
        .selected-house {
            margin-top: 40px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
        
        .selected-house h2 {
            margin-top: 0;
        }
        
        .selected-house img {
            max-width: 200px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Admin Panel</h1>';

// Display house form
echo '<form method="POST" enctype="multipart/form-data">';
echo '<h2>Add/Edit House</h2>';

echo '<label for="house_id">Select a House:</label><br>';
echo '<select name="house_id" id="house_id">';
echo '<option value="new">New House</option>';

// Display existing houses in the dropdown
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id'] . '">' . $row['house_name'] . '</option>';
    }
}

echo '</select><br>';

echo '<label for="house_name">House Name:</label><br>';
echo '<input type="text" name="house_name" required><br>';

echo '<label for="image">Image:</label><br>';
echo '<input type="file" name="image" required><br>';

echo '<label for="description">Description:</label><br>';
echo '<textarea name="description" rows="4" cols="50" required></textarea><br><br>';

echo '<input type="submit" value="Submit">';
echo '</form>';

// Display selected house details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['house_id']) && $_POST['house_id'] !== 'new') {
    $selectedHouseId = $_POST['house_id'];
    $selectedHouseSql = "SELECT * FROM houses WHERE id = $selectedHouseId";
    $selectedHouseResult = $conn->query($selectedHouseSql);
    
    if ($selectedHouseResult->num_rows > 0) {
        $selectedHouseRow = $selectedHouseResult->fetch_assoc();
        echo '<div class="selected-house">';
        echo '<h2>Selected House Details</h2>';
        echo 'House ID: ' . $selectedHouseRow['id'] . '<br>';
        echo 'House Name: ' . $selectedHouseRow['house_name'] . '<br>';
        echo 'Image: <img src="images/' . $selectedHouseRow['image'] . '" alt="House Image" width="200"><br>';
        echo 'Description: ' . $selectedHouseRow['description'] . '<br>';
        echo '</div>';
    }
}

echo '</body>
</html>';

$conn->close();
?>
