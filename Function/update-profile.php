<?php
    // start session
    session_start();

    // make connection
    include("./connection.php");

    // get new user information from post method
    $id = $_SESSION["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // update old record in database
    $sqlquery = "UPDATE member SET member_name = '$name', member_email = '$email', member_password = '$password' WHERE member_id = $id;";

    // run query
    mysqli_query($connection, $sqlquery);
    
    // update sessions
    $_SESSION["id"] = $id;
    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;
    $_SESSION["password"] = $password;

    echo "<script>window.location.href=\"../page-profile.php\";</script>";
?>

