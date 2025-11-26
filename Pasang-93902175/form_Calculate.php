<form action="" method="POST">
    Number 1: <input type="number" name="n1" value="<?= $_POST['n1'] ?? '' ?>"><br>
    Number 2: <input type="number" name="n2" value="<?= $_POST['n2'] ?? '' ?>"><br>
    <button type="submit">Calculate</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $a = $_POST['n1'];
    $b = $_POST['n2'];

    echo "Addition: " . ($a + $b) . "<br>";
    echo "Subtraction: " . ($a - $b) . "<br>";
    echo "Multiplication: " . ($a * $b) . "<br>";
    echo "Division: " . ($b != 0 ? $a / $b : "Cannot divide by zero");
}
?>
