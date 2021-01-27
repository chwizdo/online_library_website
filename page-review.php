<?php
    // start session
    session_start();

    // collect book id from get method
    $bookid = $_GET["bookid"];

    // Romance category
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
    <link rel="stylesheet" href="./style/style-bookreview.css">
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
            <h1>Rate this book</h1>


            <div class="main">
                <div class="book-cover-details">
                    <div class="book-cover-main">
                        <?php
                        echo "<div class=\"book-cover\"  style=\"background-image: url($book_img); background-position:center; background-size: cover;\"></div> ";
                        echo "<a style=\"text-decoration:none\" href=\"./page-details.php?bookid=$bookid\"><div class=\"bookdetails-btn\" >Book details</div></a>";
                        ?>
                    </div>
                    <div class="book-details">
                            <?php
                                echo"
                                <h2>$book_name</h2>
                                <h5>By <b>$book_author</b></h5>
                                <p>BookID: $bookid</p>
                                <p>Category: $book_category</p>
                                </br>"
                            ?> 
                        <h3>Review</h3>
                        <p>Do you like this book?</p>

                        
                        <form method="POST" action="./Function/rating.php">

                            <div class="like-dislike">
                            
                            <?php
                                echo"<input type=\"hidden\" name=\"bookid\" value=\"$bookid\">"
                            ?>

                            <label>
                            <input id="radio" type="radio" name="book_rating" value="good" required>
                            <img src="images/like.png"> 
                            <div style="color:#24c960"class="reveal-if-active"> I like this book. </div>
                            </label>
                                                   
                            <label>
                            <input id="radio" type="radio" name="book_rating" value="bad" required>
                            <img src="images/dislike.png"> 
                            <div style="color:#ff3c78"class="reveal-if-active"> I don't like this book. </div>
                            </label>

                           
                               
                            </div>
                            <textarea name="book_review" placeholder="Write your feedback here."></textarea>
                            <input style="  border: none;    outline:none;"type="submit" class="submitreview-btn" name="submit" value="Submit Review" id="submit" >
                            
                        </form>

                      
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