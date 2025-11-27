<?php
include '../mysql/connection.php';

// Fetch all images
$sql = "SELECT * FROM image";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Image Gallery</title>
<style>
    .image-card {
        display: inline-block;
        margin: 10px;
        text-align: center;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
    }
    .image-card img {
        width: 150px;
        height: 150px;
        display: block;
        margin-bottom: 5px;
    }
    .image-card button {
        margin: 2px;
        padding: 5px 10px;
        cursor: pointer;
    }
</style>
</head>
<body>
<h2>Image Gallery</h2>

<?php if(mysqli_num_rows($result) > 0): ?>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="image-card">
            <img src="uploads/<?= htmlspecialchars($row['name']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
            <div>
                <form action="update.php" method="GET" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit">Update</button>
                </form>
                <form action="delete.php" method="GET" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this image?');">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit">Delete</button>
                </form>
            </div>
            <span><?= htmlspecialchars($row['name']) ?></span>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No images found.</p>
<?php endif; ?>

</body>
</html>
