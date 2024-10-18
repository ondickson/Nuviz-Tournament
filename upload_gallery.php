<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $description = $_POST['description'];
    $image_count = count($_FILES['image']['name']); // Count the number of images uploaded
    $target_dir = "uploads/gallery/";

    for ($i = 0; $i < $image_count; $i++) {
        $image = $_FILES['image']['name'][$i];
        $target_file = $target_dir . basename($image);

        // Move each uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $target_file)) {
            // Insert the image path and description into the database
            $stmt = $conn->prepare("INSERT INTO gallery (image_path, description) VALUES (?, ?)");
            $stmt->bind_param("ss", $target_file, $description);
            $stmt->execute();
            $stmt->close();

            echo "<div class='alert alert-success'>Image " . ($i + 1) . " uploaded successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Failed to upload image " . ($i + 1) . ". Please try again.</div>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload to Gallery</title>
    <link rel="icon" type="image/png" href="./images/logo.jpg">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<?php include('adminpanel.php'); ?>

    <div class="container">
        <h1 class="text-center my-4">Upload to Gallery</h1>
        <form action="upload_gallery.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="image" class="form-label">Choose Images</label>
                <input type="file" class="form-control" id="image" name="image[]" multiple required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</body>
</html>

