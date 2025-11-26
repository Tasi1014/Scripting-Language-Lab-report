<?php
include 'connection.php';

// Initialize variables
$name = $email = $password = "";
$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Get and sanitize inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Basic validation
    if (empty($name) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Enter a valid email address.";
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]).{8,}$/', $password)) {
        $error = "Password must be at least 8 characters, include 1 uppercase & 1 special character.";
    } else {
        // Insert query
        $sql = "INSERT INTO students (name, email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            $success = "Record inserted successfully";
            // Do NOT clear variables if you want them to remain in the form
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Insert Student</title>
</head>
<body>

<h2>Insert Student Record</h2>

<?php if($success) echo "<p style='color:green'>$success</p>"; ?>
<?php if($error) echo "<p style='color:red'>$error</p>"; ?>

<form action="" method="POST">
    <label for="name">Name: </label>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>"><br><br>

    <label for="email">Email: </label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>"><br><br>

    <label for="password">Password: </label>
    <input type="password" id="password" name="password" value="<?= htmlspecialchars($password) ?>"><br><br>

    <button type="submit">Insert</button>
</form>

</body>
</html>

<?php $conn->close(); ?>
