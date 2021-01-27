<?php
    // start session
    session_start();

    if((isset($_SESSION["id"]) && !empty($_SESSION["id"])) && (isset($_SESSION["name"]) && !empty($_SESSION["name"])) && (isset($_SESSION["email"]) && !empty($_SESSION["email"])) && (isset($_SESSION["password"]) && !empty($_SESSION["password"]))) {
        die ("<script>window.location.href='page-home.php';</script>");
    }

    // error handler function
    function customError($errno, $errstr) {
        echo "<b>Error:</b> [$errno] $errstr <br>";
    }

    // set error handler
    set_error_handler("customError");

    // Romance category
    // Make connection
    include("./Function/connection.php");

    // Collect book_name and book_image from database
    $sqlqueryRomance = "SELECT * FROM book WHERE book_category = 'Romance' LIMIT 4;";

    // Run query
    $resultRomance = mysqli_query($connection, $sqlqueryRomance);

    // Error checking
    if (mysqli_num_rows($resultRomance) <= 0) {
        echo "<script>alert('data not found!')</script>";
    } else {
        // echo "<script>alert('successfully retrieved data!')</script>";
    }

    // Sci-Fi category
    // Collect book_name and book_image from database
    $sqlqueryScifi = "SELECT * FROM book WHERE book_category = 'Scifi' LIMIT 4;";

    // Run query
    $resultScifi = mysqli_query($connection, $sqlqueryScifi);

    // Error checking
    if (mysqli_num_rows($resultScifi) <= 0) {
        echo "<script>alert('data not found!')</script>";
    } else {
        // echo "<script>alert('successfully retrieved data!')</script>";
    }

    // Horror category
    // Collect book_name and book_image from database
    $sqlqueryHorror = "SELECT * FROM book WHERE book_category = 'Horror' LIMIT 4;";

    // Run query
    $resultHorror = mysqli_query($connection, $sqlqueryHorror);

    // Error checking
    if (mysqli_num_rows($resultHorror) <= 0) {
        echo "<script>alert('data not found!')</script>";
    } else {
        // echo "<script>alert('successfully retrieved data!')</script>";
    }

    // Mystery category
    // Collect book_name and book_image from database
    $sqlqueryMystery = "SELECT * FROM book WHERE book_category = 'Mystery' LIMIT 4;";

    // Run query
    $resultMystery = mysqli_query($connection, $sqlqueryMystery);

    // Error checking
    if (mysqli_num_rows($resultMystery) <= 0) {
        echo "<script>alert('data not found!')</script>";
    } else {
        // echo "<script>alert('successfully retrieved data!')</script>";
    }

    // Textbook category
    // Collect book_name and book_image from database
    $sqlqueryTextbook = "SELECT * FROM book WHERE book_category = 'Textbook' LIMIT 4;";

    // Run query
    $resultTextbook = mysqli_query($connection, $sqlqueryTextbook);

    // Error checking
    if (mysqli_num_rows($resultTextbook) <= 0) {
        echo "<script>alert('data not found!')</script>";
    } else {
        // echo "<script>alert('successfully retrieved data!')</script>";
    }

    // Fantasy category
    // Collect book_name and book_image from database
    $sqlqueryFantasy = "SELECT * FROM book WHERE book_category = 'Fantasy' LIMIT 4;";

    // Run query
    $resultFantasy = mysqli_query($connection, $sqlqueryFantasy);

    // Error checking
    if (mysqli_num_rows($resultFantasy) <= 0) {
        echo "<script>alert('data not found!')</script>";
    } else {
        // echo "<script>alert('successfully retrieved data!')</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style-global.css">
    <link rel="stylesheet" href="./style/style-homepage.css">
    <title>Bookplace</title>
</head>
<body>
    <!-- HEADER -->

    <header>
        <div class="header-container">
            <div class="img-container">
                <a href="./index.php"><img src="./images/Bookplace WDT logo.png" alt="Bookplace Logo"></a>
            </div>
            <div class="search-container">
                <form action="./page-search.php" method="POST">
                    <input type="text" placeholder="Search.." name="search" class="search-box">
                    <input type="submit" value="Search" class="search-btn">
                </form>
            </div>
            <div class="account-div">
                <a href="./page-login.html" class="login-btn"><div>Log In</div></a>
                <a href="./page-signup.html" class="signup-btn"><div>Sign Up</div></a>
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
                <div class="recomendation">
                    <h2>June's Recomendation</h2>
                </div>
                <div class="black-overlay"></div>
                 
                <?php
                    // Display data for Romance
                    echo "
                    <h3 class=\"cat-title\">Romance</h3>
                    <div class=\"book-section\">";

                    while ($rows = mysqli_fetch_assoc($resultRomance)) {
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
                        
                    echo "
                    </div>";

                    // Display data for Sci-fi
                    echo "
                    <h3 class=\"cat-title\">Sci-Fi</h3>
                    <div class=\"book-section\">";

                    while ($rows = mysqli_fetch_assoc($resultScifi)) {
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
                        
                    echo "
                    </div>";

                    // Display data for horror
                    echo "
                    <h3 class=\"cat-title\">Horror</h3>
                    <div class=\"book-section\">";

                    while ($rows = mysqli_fetch_assoc($resultHorror)) {
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
                        
                    echo "
                    </div>";

                    // Display data for Mystery
                    echo "
                    <h3 class=\"cat-title\">Mystery</h3>
                    <div class=\"book-section\">";

                    while ($rows = mysqli_fetch_assoc($resultMystery)) {
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
                        
                    echo "
                    </div>";

                    // Display data for Textbook
                    echo "
                    <h3 class=\"cat-title\">Textbook</h3>
                    <div class=\"book-section\">";

                    while ($rows = mysqli_fetch_assoc($resultTextbook)) {
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
                        
                    echo "
                    </div>";

                    // Display data for Fantasy
                    echo "
                    <h3 class=\"cat-title\">Fantasy</h3>
                    <div class=\"book-section\">";

                    while ($rows = mysqli_fetch_assoc($resultFantasy)) {
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
                        
                    echo "
                    </div>";
                ?>
            </div>
        </div>
    </section>

    <footer>
        Copyright&#169; by Bookplace
    </footer>
</body>
</html>