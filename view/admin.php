<?php
// Check if the username and password are provided
if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] !== 'admin' || $_SERVER['PHP_AUTH_PW'] !== 'a') {
    header('WWW-Authenticate: Basic realm="Admin Panel"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Unauthorized';
    exit;
}

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


include_once './header.php';



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
            $targetDir = "../images/";
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
    <link rel="stylesheet" href="../styles.css">
    
    <style>
        body {
            background-color: #13171b;
            color: #fff;
            font-family: Arial, sans-serif;
          
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
            background-color: #1d252c;
            color: #fff;
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

        .customform{
        margin-top: 3rem;
        border: solid  1px rgb(214, 157, 1);
        padding: 1.5rem;
        border-radius: 15px;
        }
    </style>
</head>
<body>
    <h1 style="margin-top: 6rem;">Admin Panel</h1>';

// Display house form
echo '<form class="customform" method="POST" enctype="multipart/form-data">';
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
?>
<div style="display: flex; justify-content: center;">
<button  style="max-width: fit-content; border-radius: 5px;" type="submit">Submit</button>
</div>
<?php 
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
        echo 'Image: <img src="../images/' . $selectedHouseRow['image'] . '" alt="House Image" width="200"><br>';
        echo 'Description: ' . $selectedHouseRow['description'] . '<br>';
        echo '</div>';
    }
}


    include_once './footer.php';



    ?>
<h1 style="margin: 3rem;"> Status des chalets</h1>

<section class="house-section">
    <div class="house-container">
        <!-- House cards will be dynamically generated by the PHP code -->
        <?php include '../includes/displayadmin_houses.php'; ?>
    </div>
    <div id="calendar"></div>
</section>

<?php 
echo '</body>
</html>';

?>