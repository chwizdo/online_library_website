<?php
    // Make connection to database
    $connection = mysqli_connect("localhost","root","","wdt_assignment");

    // Show error messsage if connection is not established
    if (mysqli_connect_errno())
        die ("<script>alert('Unable to connect DB!')</script>");
?>