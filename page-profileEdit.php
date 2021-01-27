<?php
    // start session
    session_start();

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

    // store session variable into variable
    $id = $_SESSION["id"];
    $name = $_SESSION["name"];
    $email = $_SESSION["email"];
    $password = $_SESSION["password"];

    // Collect book_name and book_image from database
    $sqlquery = "SELECT book.book_id, book.book_name, book.book_image FROM book INNER JOIN favourite_book ON favourite_book.book_id = book.book_id WHERE favourite_book.member_id = $id";

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
    <link rel="stylesheet" href="./style/style-profile.css">
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

            <!-- MAIN SECTION -->
            
            <div class="main-section">

                <?php
                    echo "
                        <form class=\"edit-form\" method=\"POST\" action=\"./Function/update-profile.php\">
                            <div class=\"info-container\">
                                <table>
                                    <tr>
                                        <th>Name:</th>
                                        <td><input type=\"text\" name=\"name\" value=\"$name\" id=\"edit-mode\"></td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td><input type=\"text\" name=\"email\" value=\"$email\" id=\"edit-mode\"></td>
                                    </tr>
                                    <tr>
                                        <th>password:</th>
                                        <td><input type=\"password\" name=\"password\" value=\"$password\" id=\"edit-mode\"></td>
                                    </tr>
                                </table>
                                <input type=\"submit\" name=\"submit\" value=\"Save\" class=\"edit-btn\">
                            </div>
                        </form>
                    "
                ?>

                <h3 class="fav-books">Your Favourite Books</h3>
                
                <?php
                    // Display data for Romance
                    echo "
                    <div class=\"book-section\">";

                    if($errorStatus == "pass") {
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
                    } else if($errorStatus == "fail") { 
                        echo "<p>You don't have any favourite books added</p>";
                    }
                ?>
            </div>
        </div>
    </section>

    <!-- Footer -->

    <footer>
        Copyright&#169; by Bookplace
    </footer>
</body>
</html>