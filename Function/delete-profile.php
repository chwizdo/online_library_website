<?php
    // start session
    session_start();

    // Make connection
    include("./connection.php");

    // get new user information from session
    $id = $_SESSION["id"];

    // delete user in database
    $sqlquery = "DELETE FROM member WHERE member_id = $id";
    $sqlquery2 = "DELETE FROM favourite_book WHERE member_id = $id";
    $sqlquery3 = "DELETE FROM review WHERE member_id = $id";

    // Run query
    mysqli_query($connection, $sqlquery);
    mysqli_query($connection, $sqlquery2);
    mysqli_query($connection, $sqlquery3);

    // delete session
    session_unset();
    session_destroy();

    echo "<script>alert(\"Account successfully deactivated!\");</script>";
    echo "<script>window.location.href=\"../index.php\";</script>";
?>