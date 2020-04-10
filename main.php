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

         <article id="sort_filter">
            <a href="#" class="sortlinks">Hot</a><a href="#" class="sortlinks">New</a><a href="#" class="sortlinks">Top</a>
         </article>

         <?php
            include 'includes/db_connection.php';

            // Open the database connection
            try{
               $pdo = openConnection();
            } catch (PDOException $e){
               die($e->getMessage());
            }

            if (isset($_GET['search'])) {
               // Search by post title
               include 'sql/search_posts_newest.php';
            } else {
               // Sort by newest
               include 'sql/select_posts_newest.php';
            }

            // Execute prepared SQL statement and store the result set
            $statement->execute();

            // Build class to store result set attributes
            class Post {
               public $userName;
               public $post_ID;
               public $postDate;
               public $postStatus;
               public $postTitle;
            }

            // Fetch each post in the result set and generate html
            $enabled_posts = 0;
            while ($post = $statement->fetchObject('Post')) {
               echo '<article class="post">';
               echo '<p class = "message_heading">Posted by ' . $post->userName . ' on ' . $post->postDate . '</P>';
               echo '<h1>' . $post->postTitle . '</h1>';
               echo "<a href='post.php?post_id=$post->post_ID' class='post_links'>";
               echo "<figure><img src='includes/db_get_post_image.php?post_id=$post->post_ID'></figure>";
               echo "</a>";
               echo '<div>';
               echo '<a href="#" class="post_links"><img src="images/paw.png" style="height:1.25em;">0 Scratches</a>';

               // Go to post page to view comments
               echo "<a href='post.php?post_id=$post->post_ID' class='post_links'>0 Comments</a>";

               // Include option to disable post if the user has admin privileges
               if (isset($_SESSION['user_type']) && strcmp($_SESSION['user_type'], "Admin") == 0) {
                  echo '<form method="post" action="includes/db_disable_post.php" style="display: inline;">';
                  echo '<input type="hidden" name="post_id" value='.$post->post_ID.'>';
                  echo '<input type="hidden" name="post_status" value="Disabled">';
                  echo '<input type="submit" value="Disable Post" class="disable_button">';
                  echo '</form>';
               }

               echo '</div>';
               echo '</article>';
               $enabled_posts++;
            }

            if ($enabled_posts == 0) {
               echo '<article>';
               echo '<p>There are no enabled posts</p>';
               echo '</article>';
            }

            // Close the database connection
            closeConnection($pdo);
         ?>

      </div>
   </main>
</body>

</html>