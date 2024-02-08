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

if (isset($_GET['id'])) {
    $photo_id = $_GET['id'];

    // Implement your delete logic here
    $sql = "SELECT * FROM photos where id = $photo_id";
    $result = $conn->query($sql); 
    $row = $result->fetch_assoc();
    $image_path = $row['image_path'];
    if (unlink($image_path)) {
        echo "File deleted successfully.";

    
    // Example delete query:
     $sql = "DELETE FROM photos WHERE id = $photo_id";
    
     if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
     } else {
        echo "Error deleting record: " . $conn->error;
     }
}}

$conn->close();
?>
