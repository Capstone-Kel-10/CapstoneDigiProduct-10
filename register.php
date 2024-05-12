<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "skillnest");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $account_status = "user"; // Default account status for user registration

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "Email already exists.";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO users (email, password, name, birthday, gender, account_status)
                VALUES ('$email', '$password', '$name', STR_TO_DATE($birthday,mm/dd/yyyy), '$gender', '$account_status')";
        if (mysqli_query($conn, $sql)) {
            echo "User registered successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>