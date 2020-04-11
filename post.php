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
               <h1>Posted By</h1>
            </div><br>
               <?php
               include 'includes/db_connection.php';

               // Open the database connection
               try{
                  $pdo = openConnection();
               } catch (PDOException $e){
                  die($e->getMessage());
               }               

               // Query for user profile info
               include 'sql/select_post_profile.php';

               // Execute prepared SQL statement and store the result set
               $statement->execute();

               //Build class to store result set attributes
               class User {
                  public $user_ID;
                  public $userName;
                  public $userEmail;
                  public $userFirstName;
                  public $userLastName;
                  public $userBirthdate;
               }

               // Fetch user profile info in the result set and generate html
               $user = $statement->fetchObject('User');

               echo '<figure><img src="includes/db_get_user_image.php?user_id=' . $user->user_ID . '" alt="Profile Pic" class="profile_pic"></figure>';
               echo "<div class='name_tag'><p>$user->userName</p></div><br>";
               
               // Display the total number of comments and scratches
               echo "</article>";
               echo "<article id='tags'>";
                  echo "<div class='banner'>";
                     echo "<h1>User Counts</h1>";
                  echo "</div>";
                  include 'sql/count_user_posts.php';
                  echo "<h2>$posts->posts Posts</h2>";
                  include 'sql/count_user_comments.php';
                  echo "<h2>$comments->comments Comments</h2>";
                  include 'sql/count_user_scratches.php';
                  echo "<h2>$scratches->scratches Scratches</h2>";

               echo "</article>";

            echo "</div>";
            echo "<div id='column2'>";
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