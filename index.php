<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Upload</title>
</head>
<body>
    <h2>Upload Photo</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="photo">Choose Photo:</label>
        <input type="file" name="photo" id="photo" required>
        <button type="submit" name="upload">Upload</button>
    </form>

    <h2>Photos</h2>
    <table border="1px">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php include 'show_photos.php'; ?>
    </table>
</body>
</html>
