<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
</head>
<body>
<h1>Add House</h1>
    <form action="add_house.php" method="POST" enctype="multipart/form-data">
        <label for="house_name">House Name:</label>
        <input type="text" name="house_name" required><br><br>
        
        <label for="image">Image:</label>
        <input type="file" name="image" required><br><br>
        
        <label for="description">Description:</label><br>
        <textarea name="description" rows="4" cols="50" required></textarea><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>