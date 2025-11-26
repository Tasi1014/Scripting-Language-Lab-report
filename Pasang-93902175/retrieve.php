<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    echo "Hello, $name";
}
?>

<form action="" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name">
    <button type="submit">Submit</button>
</form>
