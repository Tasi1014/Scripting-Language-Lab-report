<?php
include 'connection.php';

$errors = array();

// Get student ID from GET
if (isset($_GET['sid'])) {
    $id = $_GET['sid'];
} else {
    die("ID not provided");
}

// Fetch existing student record
$sql = "SELECT * FROM students WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("No student record found");
} else {
    $records = mysqli_fetch_assoc($result);
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Validate Name (3-15 alphabetic characters)
    if (!empty($_POST['name']) && preg_match('/^[a-zA-Z ]{3,15}$/', trim($_POST['name']))) {
        $name = trim($_POST['name']);
    } else {
        $errors['name'] = "Name must be 3-15 alphabetic characters.";
    }

    // Validate Email
    if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = trim($_POST['email']);
    } else {
        $errors['email'] = "Enter a valid email address.";
    }
    // Validate Password (min 8 chars, at least 1 uppercase, 1 special character)
    if (!empty($_POST['password']) && preg_match('/^(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]).{8,}$/', $_POST['password'])) {
        $password = trim($_POST['password']);
    } else {
        $errors['password'] = "Password must be at least 8 characters, include 1 uppercase & 1 special character.";
    }

    // If no errors, update the record
    if (empty($errors)) {
        $update_sql = "UPDATE students 
                       SET name='$name', email='$email', password='$password'
                       WHERE id='$id'";
        if (mysqli_query($conn, $update_sql)) {
            header("Location: read.php"); // Redirect after successful update
            exit;
        } else {
            $errors['result'] = "<p style='color:red'>Error updating record: " . mysqli_error($conn) . "</p>";
        }
    } else {
        $errors['result'] = "<p style='color:red'>Please fix the errors above.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Student Record</title>
<style>
    input { display:block; margin-bottom:10px; width: 300px; padding:5px; }
    .error { color:red; font-size: 0.9em; }
    label { margin-top: 10px; display:block; }
    button { padding:5px 15px; }
</style>
</head>
<body>
<h2>Update Student Record</h2>

<form method="POST">
    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? $records['name']) ?>">
    <span class="error"><?= $errors['name'] ?? '' ?></span>

    <label>Email:</label>
    <input type="text" name="email" value="<?= htmlspecialchars($_POST['email'] ?? $records['email']) ?>">
    <span class="error"><?= $errors['email'] ?? '' ?></span>

    <label>Password:</label>
    <input type="password" name="password" value="<?= htmlspecialchars($_POST['password'] ?? $records['password']) ?>">
    <span class="error"><?= $errors['password'] ?? '' ?></span>

    <button type="submit">Update</button>

    <p class="error"><?= $errors['result'] ?? '' ?></p>
</form>
</body>
</html>

<?php mysqli_close($conn); ?>
