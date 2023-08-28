<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image'])) {
        $targetDirectory = 'uploads/';
        $targetFile = $targetDirectory . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            echo 'File uploaded successfully.';
            echo $targetFile;
        } else {
            echo 'Error uploading file.';
        }
    } else {
        echo 'No file received.';
    }
} else {
    echo 'Invalid request.';
}
