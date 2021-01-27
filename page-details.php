<?php
    // start session
    session_start();

    // get user information form get method
    $bookid = $_GET["bookid"];
   
    // Make connection
    include("./Function/connection.php");

    if((!isset($_SESSION["id"]) || empty($_SESSION["id"])) || (!isset($_SESSION["name"]) || empty($_SESSION["name"])) || (!isset($_SESSION["email"]) || empty($_SESSION["email"])) || (!isset($_SESSION["password"]) || empty($_SESSION["password"]))) {
        echo "<script>alert('Please login first!')</script>";
        die ("<script>window.location.href='page-login.html';</script>");
    }

    // error handler function
    function customError($errno, $errstr) {
        echo "<b>Error:</b> [$errno] $errstr <br>";
    }

    // set error handler
    set_error_handler("customError");

    // Collect book_name and book_image from database
    $sqlquery = "SELECT * FROM book WHERE book_id = $bookid" ;
    
    // Run query
    $result = mysqli_query($connection, $sqlquery); 
    
    // Error checking
    $errorStatus = "";

    if (mysqli_num_rows($result) <= 0) {
        echo"<script>alert('Data not found!')</script>";
    }

    while ($rows = mysqli_fetch_assoc($result)){
        $book_name = $rows["book_name"];
        $book_img = $rows["book_image"];
        $book_author = $rows["book_author"];
        $book_category = $rows["book_category"];
        $book_description = $rows["book_description"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style-global.css">
    <link rel="stylesheet" href="./style/style-bookdetails.css">
    <title>Bookplace</title>
</head>
<body>
    <!-- HEADER -->

    <header>
        <div class="header-container">
            <div class="img-container">
                <a href="./page-home.php"><img src="./images/Bookplace WDT logo.png" alt="Bookplace Logo"></a>
            </div>
            <div class="search-container">
                <form action="./page-search" method="POST">
                    <input type="text" placeholder="Search.." name="search" class="search-box">
                    <input type="submit" value="Search" class="search-btn">
                </form>
            </div>
            <div class="account-div">
                <form action="./Function/logout.php">
                    <input type="submit" value="Log Out" class="login-btn">
                </form>
                <a href="./page-profile.php" class="profile"><img src="./images/icon/profile.png" alt=""></a>
            </div>
        </div>
    </header>

    <section class="body">
        <div class="body-container">
            <h1>Book details</h1>


            <div class="main">
                <div class="book-cover-details">
                   
                    <div class="book-cover-main">
                    
                    <?php
                        echo "<div class=\"book-cover\"  style=\"background-image: url($book_img); background-position:center; background-size: cover;\"></div> ";
                        echo "<a style=\"text-decoration:none\" href=\"./page-read.php?bookid=$bookid\"><div class=\"readnow-btn\" >Read Now</div></a>";
                        echo "<a style=\"text-decoration:none\" href=\"./Function/addtofav.php?bookid=$bookid\"><div class=\"addtofav-btn\" >Add to Favourite</div></a>";
                        echo "<a style=\"text-decoration:none\" href=\"./page-review.php?bookid=$bookid\"><div class=\"ratethisbook-btn\" >Rate this Book</div></a>";
                    ?>
                       
                    </div>
                    <div class="book-details">

                    <?php
                        echo"
                        <h2>$book_name</h2>
                        <h5>By <b>$book_author</b></h5>
                        <p>BookID: $bookid</p>
                        <p>Category: $book_category</p>
                        <h6>$book_description</h6>
                        </br>"
                    ?>

                    <h3>Review</h3>
                    <div class="like-dislike">
                        
                        <?php

                        //good rating

                        $sqlquery1 = "SELECT count(case when book_rating=\"good\" then 1 end) as good_rating, count(case when book_rating=\"bad\" then 1 end) as bad_rating FROM review WHERE book_id = $bookid";

                        $result1 = mysqli_query($connection, $sqlquery1); 

                        $errorStatus = "";

                        if (mysqli_num_rows($result1) < 0) {
                            echo"<script>alert('Data not found!')</script>";
                        }

                        while ($rows = mysqli_fetch_assoc($result1)){
                            $good = $rows["good_rating"];
                            $bad = $rows["bad_rating"];
                        }

                            echo"
                                <p> 
                                    <img class=\"icon\" src= images/like.png> $good  &nbsp; &nbsp; &nbsp;
                                    <img class=\"icon\" src= images/dislike.png> $bad
                                </p>
                            "
                        ?>

            
                    </div>
                   
                    
                    </div>
                </div>
            </div>    
        </div>
    </section>

    <footer>
        Copyright&#169; by Bookplace
    </footer>
</body>
</html>