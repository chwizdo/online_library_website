<?php  
    // start session
    session_start();

    // Make connection
    include("./connection.php");

    $id = $_SESSION["id"];
    $bookid = $_POST["bookid"];
    $book_rating=$_POST['book_rating'];  
    $book_review=$_POST['book_review'];

    // validate
    $sqlquery1 = "SELECT member_id, book_id FROM review WHERE member_id = $id AND book_id = $bookid;";

    $result = mysqli_query($connection, $sqlquery1);

    if (mysqli_num_rows($result) <= 0) {

        // If database no record
        $sqlquery2 = "INSERT INTO review (member_id, book_id, book_rating, book_review, review_date) VALUES ('$id','$bookid','$book_rating','$book_review', NOW());";

        mysqli_query($connection, $sqlquery2);
    
        // validation
        if (mysqli_affected_rows($connection) <= 0) {
            echo ("<script>alert ('Error: data unable to insert!');</script>");
            die ("<script>window.history.go(-1)</script>"); // go back tothe previous page
        }
    
        echo "<script>alert('Review submitted');</script>";
        echo "<script>window.location.href=\"../page-review.php?bookid=$bookid\"</script>";
    } else {

        // If record exist
        echo "<script>alert ('You already rated this book!');</script>";
        echo "<script>window.location.href=\"../page-review.php?bookid=$bookid\"</script>";
    }
?>
