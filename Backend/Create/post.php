<?php
include '../connection.php';
$email = mysqli_real_escape_string($Connection, $_POST['email']);
$title = mysqli_real_escape_string($Connection, $_POST['title']);
$description = mysqli_real_escape_string($Connection, $_POST['description']);

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $image = $_FILES['image'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 5 * 1024 * 1024;

    if (in_array($image['type'], $allowedTypes) && $image['size'] <= $maxFileSize) {
        $uploadDir = '../../Frontend/Images/';
        $imagePath = $uploadDir . basename($image['name']);

        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            $imagePath = mysqli_real_escape_string($Connection, $imagePath);
            $query = 'INSERT INTO post (email, img, title, description) VALUES (?, ?, ?, ?)';
            $stmt = mysqli_prepare($Connection, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'ssss', $email, $imagePath, $title, $description);

                if (mysqli_stmt_execute($stmt)) {
                    header('Location: ../../Frontend/Home.php');
                    exit();
                } else {
                    echo 'Error executing query: ' . mysqli_error($Connection);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo 'Error preparing query: ' . mysqli_error($Connection);
            }
        } else {
            echo 'Error uploading the image.';
        }
    } else {
        echo 'Invalid file type or file size exceeded.';
    }
} else {
    echo 'No image uploaded or error with the file upload.';
}

mysqli_close($Connection);
?>