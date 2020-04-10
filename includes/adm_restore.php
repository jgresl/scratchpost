<?php
    // Go to main page if the user does not have admin privileges
    if(!isset($_SESSION['user_type']) || strcmp($_SESSION['user_type'], "Admin") != 0) {
        header("Location: /cosc360/scratchpost/main.php");
    }
    
    echo '<article>';
    echo '<h1>Database Restore</h1><br>';
    echo '<img src="images/ddl.png" alt="DDL Image"></img>';
    echo '</article>';
?>