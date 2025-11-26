<?php
include '../mysql/connection.php';

// Destination Folder
$targetDir = "uploads/";

// Create folder if it doesn't exist
if(!is_dir($targetDir)){
    mkdir($targetDir, 0777, true);
}

if(isset($_FILES['myfile'])){
    $fileName = $_FILES['myfile']['name'];
    $fileTmp = $_FILES['myfile']['tmp_name'];
    $fileSize = $_FILES['myfile']['size'];
    $fileType = $_FILES['myfile']['type'];

    // Allowed file Types
    $allowedTypes = ['image/jpeg','image/jpg','image/png','application/pdf'];

    // Maximum size(2MB)
    $maxSize = 2 * 1024 * 1024;

    // Validate Type
    if(!in_array($fileType, $allowedTypes)){
        die("Invalid file type! Only JPG, PNG, and PDF allowed.");
    }

    // Validate Size
    if($fileSize > $maxSize){
        die("File size too large! Must be less than 2MB");
    }

    // Target file path
    $targetFile = $targetDir . basename($fileName);

    // Upload file
    if(move_uploaded_file($fileTmp, $targetFile)){
        echo "File uploaded successfully: " . $fileName;
    } else {
        echo "Error: Could not upload file.";
    }
} else {
    echo "No file selected";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <h2>Upload a file</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="myfile" required>
        <br><br>
        <input type="submit" value="Upload">
    </form>
</body>
</html>
