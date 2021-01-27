<?php  
    // start session
    session_start();

    // delete session
    session_unset();
    session_destroy();

    echo "<script>window.location.href=\"../index.php\";</script>";
?>

