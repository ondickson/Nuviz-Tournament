<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $ids = $_POST['delete'];

    // Prepare the statement to delete images
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $conn->prepare("DELETE FROM gallery WHERE id IN ($placeholders)");

    // Bind parameters
    $stmt->bind_param(str_repeat('i', count($ids)), ...$ids);

    // Execute the statement
    if ($stmt->execute()) {
        // Delete files from server
        foreach ($ids as $id) {
            $result = $conn->query("SELECT image_path FROM gallery WHERE id = $id");
            $row = $result->fetch_assoc();
            if (file_exists($row['image_path'])) {
                unlink($row['image_path']);
            }
        }

        echo "<div class='alert alert-success'>Images deleted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Failed to delete images. Please try again.</div>";
    }

    $stmt->close();
}
?>
