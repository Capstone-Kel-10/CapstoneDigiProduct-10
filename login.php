<?php
session_start();
require_once 'db_connect.php';

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if($password === $row['password']) { // Without hashing
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['birthday'] = $row['birthday'];
        $_SESSION['gender'] = $row['gender'];
        
        // Redirect to another page
        header("Location: index .php");
        exit();
    } else {
        echo "Incorrect email or password";
    }
}
?>
