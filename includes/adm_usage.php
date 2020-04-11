<?php
    // Go to main page if the user does not have admin privileges
    if(!isset($_SESSION['user_type']) || strcmp($_SESSION['user_type'], "Admin") != 0) {
        header("Location: /cosc360/scratchpost/main.php");
    }
    
    echo '<article>';
    echo '<h1>Site Usage</h1><br>';
    echo '<figure>';
    echo '<img src="images/construction.png" alt="Construction Image" height="150px"></img>';
    echo '</figure>';
    echo '</article>';
?>