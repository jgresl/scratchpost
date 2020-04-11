<?php
    // Go to main page if the user does not have admin privileges
    if(!isset($_SESSION['user_type']) || strcmp($_SESSION['user_type'], "Admin") != 0) {
        header("Location: /cosc360/scratchpost/main.php");
    }
    
    echo '<article>';
    echo '<h1>Entity Relationship Diagram</h1>';
    echo '<figure>';
    echo '<img src="images/er_diagram.jpg" alt="ER Diagram"></img>';
    echo '</figure>';
    echo '</article>';
?>