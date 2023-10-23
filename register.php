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
    $check_sql = "SELECT * FROM members WHERE email = '$email'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        echo '<script>';
        echo 'var message = "Email already exists. Please use a different email address.";';
        echo 'alert(message);';
        echo 'window.location.href = "index.html";';
        echo '</script>';
    } else {
        $insert_sql = "INSERT INTO members (name ,email, password) VALUES ('$name','$email', '$password')";
        if ($conn->query($insert_sql) === TRUE) {
            echo '<script>';
            echo 'var message = "Registration successful!";';
            echo 'alert(message);';
            echo 'window.location.href = "./login/login.html";';
            echo '</script>';
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}
?>
