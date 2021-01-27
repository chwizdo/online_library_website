<?php
    // start session
    session_start();

    // collect book id from get method
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
        $book_content = $rows["book_content"];
    }

   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style-global.css">
    <link rel="stylesheet" href="./style/style-readnow.css">
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

            <?php
                echo"<h1>$book_name</h1>
                <div class=\"main\">
                    <h2>chapter 1</h2>
                    <p>$book_content</p>
                </div>";
            ?>
        </div>
    </section>

    <footer>
        Copyright&#169; by Bookplace
    </footer>
</body>
</html>