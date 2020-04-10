<?php
    // Go to main page if the user does not have admin privileges
    if(!isset($_SESSION['user_type']) || strcmp($_SESSION['user_type'], "Admin") != 0) {
        header("Location: /cosc360/scratchpost/main.php");
    }

    include 'sql/select_posts_disabled.php';

    // Execute prepared SQL statement and store the result set
    $statement->execute();

    // Build class to store result set attributes
    class Post {
        public $userName;
        public $post_ID;
        public $postDate;
        public $postStatus;
        public $postTitle;
        public $postImage;
    }

    // Fetch each post in the result set and generate html
    $disabled_posts = 0;
    while ($post = $statement->fetchObject('Post')) {
        echo '<article class="post">';
        echo '<p class="message_heading">Posted by ' . $post->userName . ' on ' . $post->postDate . '</P>';
        echo '<h1>' . $post->postTitle . '</h1>';
        echo "<a href='post.php?post_id=$post->post_ID' class='post_links'>";
        echo "<figure><img src='includes/db_get_post_image.php?post_id=$post->post_ID'></figure>";
        echo "</a>";
        echo '<div>';
        echo '<a href="#" class="post_links"><img src="images/paw.png" style="height:1.25em;">0 Scratches</a>';
        echo '<a href="#" class="post_links">0 Comments</a>';

        // Include option to disable post if the user has admin privileges
        if (isset($_SESSION['user_type']) && strcmp($_SESSION['user_type'], "Admin") == 0) {
            echo '<form method="post" action="includes/db_disable_post.php" style="display: inline;">';
            echo '<input type="hidden" name="post_id" value='.$post->post_ID.'>';
            echo '<input type="hidden" name="post_status" value="Enabled">';
            echo '<input type="submit" value="Enable Post" class="disable_button">';
            echo '</form>';
        }

        echo '</div>';
        echo '</article>';
        $disabled_posts++;
    }

    if ($disabled_posts == 0) {
        echo '<article>';
        echo '<p>There are no disabled posts</p>';
        echo '</article>';
     }

    // Close the database connection
    closeConnection($pdo);
?>