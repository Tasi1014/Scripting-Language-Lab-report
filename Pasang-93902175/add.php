<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $a = $_POST['n1'];
        $b = $_POST['n2'];
        $sum = $a + $b;
        echo "Sum = $sum";
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form action="" method="POST">
        Number 1: <input type="number" name="n1" value="<?= $_POST['n1'] ?? '' ?>"><br>
        Number 2: <input type="number" name="n2" value="<?= $_POST['n2'] ?? '' ?>"><br>
        <button type="submit">Calculate</button>
    </form>

    
</body>
</html>
