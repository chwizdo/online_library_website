<?php
    // start session
    session_start();

    // Make connection
    include("./connection.php");

    // Collect user information in html form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Sellect user email and password based on user input
    $sqlquery = "SELECT member_id, member_name, member_email, member_password FROM  member WHERE member_email = '$email' AND member_password = '$password';";

    // Run query
    $result = mysqli_query($connection, $sqlquery);

    // check if user input is correct
    if (mysqli_num_rows($result) <= 0) {
        echo "<script>alert('Incorrect email or password!')</script>";
        echo "<script>window.history.go(-1);</script>";
    }

    while ($rows = mysqli_fetch_assoc($result)) {
        $_SESSION["id"] = $rows["member_id"];
        $_SESSION["name"] = $rows["member_name"];
        $_SESSION["email"] = $rows["member_email"];
        $_SESSION["password"] = $rows["member_password"];
    }

    echo "<script>window.location.href='../page-home.php';</script>";
?>