<?php  
    // start session
    session_start();

    // Make connection
    include("./connection.php");

    if((!isset($_SESSION["id"]) || empty($_SESSION["id"])) || (!isset($_SESSION["name"]) || empty($_SESSION["name"])) || (!isset($_SESSION["email"]) || empty($_SESSION["email"])) || (!isset($_SESSION["password"]) || empty($_SESSION["password"]))) {
        echo "<script>alert('Please login first!')</script>";
        die ("<script>window.location.href='../page-login.html';</script>");
    }

    // error handler function
    function customError($errno, $errstr) {
        echo "<b>Error:</b> [$errno] $errstr <br>";
    }

    // set error handler
    set_error_handler("customError");

    $bookid = $_GET["bookid"];
    $id = $_SESSION["id"];

    $sqlquery = "INSERT INTO favourite_book (member_id, book_id) VALUES ('$id','$bookid');";

    mysqli_query( $connection, $sqlquery);

    // validation
    if (mysqli_affected_rows($connection) <= 0) {
        echo ("<script>alert ('This book is already in your favourite list!');</script>");
        die ("<script>window.history.go(-1)</script>"); // go back tothe previous page
    }

    echo "<script>alert('This book is now added to your favourite list!');</script>";
    echo "<script>window.history.go(-1)</script>";
?>
