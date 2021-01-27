<?php
    // start session
    session_start();

    // Make Connection
    include("./connection.php");

    // Collect user information from html form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Insert user information into database
    $sqlquery = "INSERT INTO member (member_name, member_email, member_password) VALUES ('$name','$email','$password');";

    // Run query
    mysqli_query($connection, $sqlquery);

    // Error checking
    if (mysqli_affected_rows($connection) <= 0) {
        echo "<script>confirm ('This email had been registerred! Please login instead!');</script>";
        echo "<script>window.location.href='page-login.html';</script>";
    } else {
        // Collect the newly created id from database
        $sqlquery2 = "SELECT member_id FROM member WHERE member_email = '$email';";

        // Run query
        $result = mysqli_query($connection, $sqlquery2);

        while ($rows = mysqli_fetch_assoc($result)) {
            $_SESSION["id"] = $rows["member_id"];
        }

        // Store the rest of the information in session
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;

        echo "<script>window.location.href='../page-home.php';</script>";
    }
?>