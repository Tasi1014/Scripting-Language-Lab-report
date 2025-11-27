<?php
include 'connection.php';

$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Display Records</title>
</head>
<body>

<?php if(mysqli_num_rows($result) > 0): ?>
    <table border="1" style="border-collapse: collapse">
        <caption>Student Records</caption>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php $count = 1; while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $count++ ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><a href="delete.php?sid=<?= $row['id'] ?>">Delete</a></td>
                <td><a href="update.php?sid=<?= $row['id'] ?>">Update</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No records found</p>
<?php endif; ?>

</body>
</html>
