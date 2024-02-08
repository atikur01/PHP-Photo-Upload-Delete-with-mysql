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

$sql = "SELECT * FROM photos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td><img src='" . $row["image_path"] . "' alt='Photo' style='width:100px;height:100px;'></td>";
        echo "<td><a href='update_photo.php?id=" . $row["id"] . "'>Update</a> | <a href='delete_photo.php?id=" . $row["id"] . "'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
