<?php

require_once('db_connect.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);


  $conn = connect();

  // Prepared statement to prevent SQL injection
  $stmt = $conn->prepare("SELECT email, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();

  $result = $stmt->get_result();
  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['email'] = $row['email'];  // Store user ID in session
      $_SESSION['logged_in'] = true;
      header("Location: index.html");  // Redirect to welcome page
      exit;
    } else {
      echo "Invalid email or password";
    }
  } else {
    echo "Invalid email or password";
  }

  $stmt->close();
  $conn->close();
}

?>
