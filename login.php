<?php
session_start();

// Include database connection
require_once "db_connect.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare SQL statement to check if user exists
    $sql = "SELECT email FROM users WHERE email = ? AND password = ?";
    
    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ss", $param_email, $param_password);
        
        // Set parameters
        $param_email = $email;
        $param_password = $password;
        
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Store result
            $stmt->store_result();
            
            // Check if email exists and password matches
            if ($stmt->num_rows == 1) {                    
                // Password is correct, start a new session
                session_start();
                
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["email"] = $email;                            
                
                // Redirect user to welcome page
                header("location: index.html");
            } else {
                // Display an error message if email doesn't exist or password is incorrect
                $login_err = "Invalid email or password.";
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>
