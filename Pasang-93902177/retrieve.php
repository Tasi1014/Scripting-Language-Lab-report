<?php
$name = "";
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['name'])) {  
        $name = $_GET['name'];
        echo "Hello, $name";
    }
}
?>

<form action="" method="GET">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?= $name ?>">
    <button type="submit">Submit</button>
</form>
