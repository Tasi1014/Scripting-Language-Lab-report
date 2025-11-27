<?php
include 'connection.php';
if($_GET['sid']){
$id = $_GET['sid'];
}

$sql = "DELETE FROM students WHERE id = $id";

$result = mysqli_query($conn, $sql);

 if($result){
        echo "Deleted Record Successfully";
        header('location: read.php');
    }else{
        echo "Failed to delete!";
    }

?>