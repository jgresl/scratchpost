<!DOCTYPE html>
<html>

<head lang="en">
   <meta charset="utf-8">
   <title>Scratch Post</title>
   <link rel="icon" href="images/favicon.png" type="image/x-icon">
   <link rel="stylesheet" href="css/reset.css">
   <link rel="stylesheet" href="css/main.css">
   <link rel="stylesheet" href="css/header.css">
</head>

<body>
   <header>
      <?php include 'includes/header.php'; ?>
   </header>
   <main>
      <div id="column1">
         <article id="community">
            <div class="banner">
               <h1>Community</h1>
            </div>
            <h2>2 Members</h2>
            <h2>1 Online</h2>
            <br>
            <?php
               if(isset($_SESSION['username'])) {
                  echo '<a href="profile.php" id="newpost">NEW POST</a>';
               }
            ?>  
         </article>

         <article id="tags">
            <div class="banner">
               <h1>Tags</h1>
            </div>

         </article>
      </div>
      <div id="column2">
         <?php
            include 'includes/db_connection.php';

            // Open the database connection
            try{
               $pdo = openConnection();
            } catch (PDOException $e){
               die($e->getMessage());
            }


            // SQL query to return the post information for the main article
            include 'sql/select_post_image.php';

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
               public $scratches;
               public $comments;
            }

            // Fetch the post in the result set and generate html
            $post = $statement->fetchObject('Post');

            echo '<article>';
            echo '<p class = "message_heading">Posted by ' . $post->userName . ' on ' . $post->postDate . '</P>';
            echo '<h1>' . $post->postTitle . '</h1>';
            echo "<figure><img src='includes/db_get_post_image.php?post_id=$post->post_ID'></figure>";
            echo '<div>';
            // Scratch/unscratch post if user is logged in, else goto login page
            if(isset($_SESSION['username'])) {
               echo "<a href='includes/db_scratch.php?post_id=$post->post_ID' class='post_links'><img src='images/paw.png' style='height:1.25em;'>$post->scratches Scratches</a>";
            } else {
               echo "<a href='login.php' class='post_links'><img src='images/paw.png' style='height:1.25em;'>$post->scratches Scratches</a>";           
            }
            echo "<a href='#' class='post_links'>$post->comments Comments</a>";

            // Text area to comment on post
            if(isset($_SESSION['username'])) {
               echo "<section class='comment_section'>";
               echo "<form method='post' action='includes/db_comment.php'>";
               echo "<input type='hidden' name='post_id' value=$post->post_ID>";
               echo "<textarea id='comment_area' name='comment' rows='4' autofocus required></textarea>";
               echo "<input type='submit' value='Comment' class='comment_button'>";
               echo "</form>";
               echo "</section>";
            }

            // SQL query to return the post information for the main article
            include 'sql/select_post_comments.php';

            // Execute prepared SQL statement and store the result set
            $statement->execute();

            // Build class to store result set attributes
            class Comment {
               public $userName;
               public $commentText;
               public $commentDate;
               public $commentStatus;
            }

            // Fetch each comment in the result set and generate html
            echo "<section class='comment_section'>";
            while ($comment = $statement->fetchObject('Comment')) {
               echo "<br><p class = 'message_heading'>Comment by $comment->userName on $comment->commentDate</p>";
               echo "<p class='comment'>$comment->commentText</p>";
            }


            echo "</section>";
            echo '</article>';
            
            // Close the database connection
            closeConnection($pdo);
         ?>

      </div>
   </main>
</body>

</html>