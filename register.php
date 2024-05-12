session_start();
require_once 'db_connect.php';

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Without hashing
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    
    $sql = "INSERT INTO users (username, password, name, birthday, gender) VALUES ('$username', '$password', '$name', '$birthday', '$gender')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;
        $_SESSION['birthday'] = $birthday;
        $_SESSION['gender'] = $gender;
        
        echo "Registration successful. Welcome, ".$_SESSION['name']."!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>