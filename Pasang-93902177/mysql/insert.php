<?php
include 'connection.php';

$name = $email = $phone = "";
$error = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // Required fields
    if (empty($name) || empty($email) || empty($phone)) {
        $error['form'] = "All fields are required.";
    }

    // Name validation
    if (!preg_match('/^[a-zA-Z ]{3,30}$/', $name)) {
        $error['name'] = "Name must be 3–30 alphabetic characters.";
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Invalid email format.";
    }

    // Phone validation
    if (!preg_match('/^\d{10}$/', $phone)) {
        $error['phone'] = "Phone must be exactly 10 digits.";
    }

    // If no errors → insert
    if (empty($error)) {
        $sql = "INSERT INTO students (name, email, phone) VALUES ('$name', '$email', '$phone')";
        
        if ($conn->query($sql) === TRUE) {
            $success = "Record inserted successfully.";
        } else {
            $error['form'] = "Database Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Student</title>
</head>
<body>

<h2>Insert Student Record</h2>

<!-- Success Message -->
<?php if ($success): ?>
    <p style="color:green;"><?= $success ?></p>
<?php endif; ?>

<!-- Form -->
<form action="" method="POST">

    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">
    <p style="color:red;"><?= $error['name'] ?? '' ?></p>
    <br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($email) ?>">
    <p style="color:red;"><?= $error['email'] ?? '' ?></p>
    <br>

    <label>Phone:</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($phone) ?>">
    <p style="color:red;"><?= $error['phone'] ?? '' ?></p>
    <br>

    <button type="submit">Insert</button>
    <p style="color:red;"><?= $error['form'] ?? '' ?></p>

</form>

</body>
</html>

<?php $conn->close(); ?>
