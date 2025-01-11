<?php
require_once "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = $db->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param('s', $email);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['userid'] = $user['id'];
        header("location: welcome.php");
        exit;
    } else {
        echo 'Invalid email or password!';
    }
    $query->close();
    mysqli_close($db);
}
?>

<form method="POST">
    Email Address: <input type="email" name="email" required>
    Password: <input type="password" name="password" required>
    <button type="submit" name="submit">Login</button>
</form>