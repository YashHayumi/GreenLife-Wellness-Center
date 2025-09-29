<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
  $stmt->bind_param("s", $username);
  $stmt->execute();

  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    if ($row['password'] === $password) {
      header("Location: dashboard.php");
      exit();
    } else {
      echo "<script>alert('Incorrect password.'); window.history.back();</script>";
    }
  } else {
    echo "<script>alert('User not found.'); window.history.back();</script>";
  }

  $stmt->close();
}
$conn->close();
?>
