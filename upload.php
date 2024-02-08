<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photos";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['upload'])) {
    $target_dir = "images/";
    
    // Generate a unique ID for the file
    $unique_id = uniqid();
    
    // Get the file extension
    $imageFileType = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION));
    
    // Create a new filename with the unique ID and original file extension
    $target_file = $target_dir . $unique_id . "." . $imageFileType;
    
    $uploadOk = 1;

    // Check if the file is an actual image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists (unlikely due to unique ID)
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowed_extensions)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "The file has been uploaded as " . basename($target_file);

            // Insert image path into the database
            $image_path = $target_file;
            $sql = "INSERT INTO photos (image_path) VALUES ('$image_path')";
            if ($conn->query($sql) === TRUE) {
                echo "Record inserted successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$conn->close();
?>
