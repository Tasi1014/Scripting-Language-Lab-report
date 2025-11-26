<?php
include '../mysql/connection.php';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

// Get filename to delete the file from server
$sql = "SELECT name FROM image WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Record not found.");
}

$row = mysqli_fetch_assoc($result);
$file = 'uploads/' . $row['name'];

// Delete file from server
if (file_exists($file)) {
    unlink($file);
}

// Delete record from database
$delete_sql = "DELETE FROM image WHERE id='$id'";
if (mysqli_query($conn, $delete_sql)) {
    header("Location: display_image.php"); // redirect to the page showing all images
    exit;
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>
