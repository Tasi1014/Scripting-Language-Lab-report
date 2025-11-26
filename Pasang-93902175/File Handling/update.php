<?php
include '../mysql/connection.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

// Fetch current record
$sql = "SELECT * FROM image WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Record not found.");
}

$row = mysqli_fetch_assoc($result);
$currentFile = $row['name'];

$success = $error = "";

// Handle POST
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['myfile'])) {

    $fileName = $_FILES['myfile']['name'];
    $fileTmp = $_FILES['myfile']['tmp_name'];
    $fileSize = $_FILES['myfile']['size'];
    $fileType = $_FILES['myfile']['type'];

    $allowedTypes = ['image/jpeg','image/jpg','image/png','application/pdf'];
    $maxSize = 2 * 1024 * 1024;

    if (!in_array($fileType, $allowedTypes)) {
        $error = "Invalid file type! Only JPG, PNG, PDF allowed.";
    } elseif ($fileSize > $maxSize) {
        $error = "File too large! Max 2MB.";
    } else {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($fileName);

        // Upload new file
        if (move_uploaded_file($fileTmp, $targetFile)) {
            // Delete old file
            if (file_exists($targetDir . $currentFile)) {
                unlink($targetDir . $currentFile);
            }

            // Update database
            $update_sql = "UPDATE image SET name='$fileName' WHERE id='$id'";
            if (mysqli_query($conn, $update_sql)) {
                $success = "File updated successfully.";
                $currentFile = $fileName; // update currentFile for display
            } else {
                $error = "Error updating database: " . mysqli_error($conn);
            }
        } else {
            $error = "Error uploading file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update File</title>
</head>
<body>

<h2>Update File</h2>

<?php if($success) echo "<p style='color:green'>$success</p>"; ?>
<?php if($error) echo "<p style='color:red'>$error</p>"; ?>

<p>Current File:</p>
<img src="uploads/<?= htmlspecialchars($currentFile) ?>" width="150" height="150">

<form method="POST" enctype="multipart/form-data">
    <br>
    <label>Select New File:</label>
    <input type="file" name="myfile" required><br><br>
    <button type="submit">Update</button>
</form>

</body>
</html>
