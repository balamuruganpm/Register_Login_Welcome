<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "process_registration";

    $conn = new mysqli($servername, $db_username, $db_password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM members WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {    
       header( "refresh:1; url=../home/home.html" );
    } else {
       echo '<script>';
        echo 'var message = "Login failed. Please check your email and password.";';
        echo 'alert(message);'; // Display an alert message box
        echo '</script>';
        header( "refresh:1; url=login.html" );
    }
    $conn->close();
}
?>
