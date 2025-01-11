<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $fullname = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $query = $db->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param('s', $email);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) {
        echo 'The email address is already registered!';
    } else {
        $insertQuery = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $insertQuery->bind_param("sss", $fullname, $email, $password_hash);
        if ($insertQuery->execute()) {
            echo 'Your registration was successful!';
        } else {
            echo 'Something went wrong!';
        }
    }
    $query->close();
    $insertQuery->close();
    mysqli_close($db);
}
?>

<form method="POST">
    Full Name: <input type="text" name="name" required>
    Email Address: <input type="email" name="email" required>
    Password: <input type="password" name="password" required>
    <button type="submit" name="submit">Register</button>
</form>