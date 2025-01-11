<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("location: login.php");
    exit;
}
?>

<h1>Welcome, <?php echo $_SESSION['userid']; ?>!</h1>
<a href="logout.php">Log Out</a>