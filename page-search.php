<?php
    // start session
    session_start();

    // collect search keywords from get method
    $search = $_POST["search"];

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

    // store session variable into variable
    $id = $_SESSION["id"];
    $name = $_SESSION["name"];
    $email = $_SESSION["email"];
    $password = $_SESSION["password"];

    // Collect book_name and book_image from database
    $sqlquery = "SELECT book_id, book_name, book_image FROM book WHERE book_name LIKE '%$search%';";

    // Run query
    $result = mysqli_query($connection, $sqlquery);

    // Error checking
    $errorStatus = "";

    if (mysqli_num_rows($result) <= 0) {
        $errorStatus = "fail";
    } else {
        $errorStatus = "pass";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style-global.css">
    <link rel="stylesheet" href="./style/style-category.css">
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

            <!-- SIDE BAR -->

            <nav class="main-nav">
                <h2>Category</h2>
                <a href="./page-category.php?category=Fantasy" class="category cat-fantasy"><h3>Fantasy</h3></a>
                <a href="./page-category.php?category=Horror" class="category cat-horror"><h3>Horror</h3></a>
                <a href="./page-category.php?category=Mystery" class="category cat-mystery"><h3>Mystery</h3></a>
                <a href="./page-category.php?category=Romance" class="category cat-romance"><h3>Romance</h3></a>
                <a href="./page-category.php?category=Scifi" class="category cat-sci-fi"><h3>Sci-Fi</h3></a>
                <a href="./page-category.php?category=Textbook" class="category cat-textbook"><h3>Textbook</h3></a>
            </nav>

            <!-- MAIN SECTION -->
            <div class="main-section">
                
                <?php
                    // Display search result
                    if($errorStatus == "pass") {
                        echo "
                            <h3 class=\"fav-books\">Search Result for: \"$search\"</h3>
                            <div class=\"book-section\">
                        ";

                        while ($rows = mysqli_fetch_assoc($result)) {
                            $image = $rows["book_image"];
                            $name = $rows["book_name"];
                            $bookid = $rows["book_id"];
                            echo "
                            <div class=\"book-container\">
                                <a href=\"./page-details.php?bookid=$bookid\"><div class=\"book-img\" style=\"background-image: url($image); background-position:center; background-size: cover;\"></div></a>
                                <h4><a href=\"./page-details.php?bookid=$bookid\">$name</a></h4>
                            </div>
                            ";
                        }
                    } else {
                        echo "<p>No search result!</p>";
                    }
                    
                ?>
            </div>
        </div>
    </section>

    <footer>
        Copyright&#169; by Bookplace
    </footer>
</body>
</html>