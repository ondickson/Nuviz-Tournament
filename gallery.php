<?php
include('db_connection.php');

$query = "SELECT * FROM gallery ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - NUVIZ WEEKEND TOURNAMENT</title>
    <link rel="icon" type="image/png" href="./images/logo.jpg">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .gallery-img {
            width: 100%;
            height: auto;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .gallery-img:hover {
            transform: scale(1.05);
        }
        .modal-dialog {
            max-width: 90%;
        }
        .modal-img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <h1 class="text-center my-4">Gallery</h1>
        <form action="delete_gallery.php" method="post">
            <div class="row">
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="col-md-2 mb-4">
                        <div class="card">
                            <input type="checkbox" name="delete[]" value="<?php echo $row['id']; ?>" class="form-check-input position-absolute" style="top: 0; right: 0;">
                            <img src="<?php echo $row['image_path']; ?>" class="gallery-img card-img-top" alt="Gallery Image" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-src="<?php echo $row['image_path']; ?>" data-bs-description="<?php echo $row['description']; ?>">
                            <div class="card-body">
                                <p class="card-text"><?php echo $row['description']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <button type="submit" class="btn btn-danger">Delete Selected Images</button>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" class="modal-img" alt="Modal Image">
                    <p class="mt-2" id="imageDescription"></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var imageModal = document.getElementById('imageModal');
            imageModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var src = button.getAttribute('data-bs-src');
                var description = button.getAttribute('data-bs-description');

                var modalImg = imageModal.querySelector('.modal-img');
                var modalDesc = imageModal.querySelector('#imageDescription');

                modalImg.src = src;
                modalDesc.textContent = description;
            });
        });
    </script>
</body>
</html>
