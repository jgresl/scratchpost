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
            <?php
               include 'includes/db_connection.php';

               // Open the database connection
               try{
                  $pdo = openConnection();
               } catch (PDOException $e){
                  die($e->getMessage());
               }

               // Display the number of members and how many are online.
               include 'sql/count_members.php';
               echo "<h2>$members->members Members</h2>";
               if(isset($_SESSION['username'])) {
                  echo "<h2>1 Online</h2><br>";
                  echo '<a href="profile.php" id="newpost">NEW POST</a>';
               } else {
                  echo "<h2>0 Online</h2><br>";
                  echo '<a href="login.php" id="newpost">NEW POST</a>';
               }
               
               // Display the total number of comments and scratches
               echo "</article>";
               echo "<article id='tags'>";
                  echo "<div class='banner'>";
                     echo "<h1>Global Counts</h1>";
                  echo "</div>";
                  include 'sql/count_posts.php';
                  echo "<h2>$posts->posts Posts</h2>";
                  include 'sql/count_comments.php';
                  echo "<h2>$comments->comments Comments</h2>";
                  include 'sql/count_scratches.php';
                  echo "<h2>$scratches->scratches Scratches</h2>";

               echo "</article>";

            echo "</div>";
            echo "<div id='column2'>";

            echo '<article id="sort_filter">';
               echo '<a href="main.php?sort=new" class="sortlinks">New</a><a href="main.php?sort=hot" class="sortlinks">Hot</a><a href="main.php?sort=top" class="sortlinks">Top</a>';
            echo '</article>';

            if (isset($_GET['search'])) {
               // Search by post title
               include 'sql/search_posts_newest.php';
            } else if (isset($_GET['sort'])) {
               // Order based on sort buttons
               $sort = $_GET['sort'];
               switch($sort) {
                  case 'new' :
                     include 'sql/select_posts_new.php';
                     break;
                  case 'hot' :
                     include 'sql/select_posts_hot.php';
                     break;
                  case 'top' :
                     include 'sql/select_posts_top.php';
                     break;
                  default:
                     include 'sql/select_posts_new.php';
               }               
            } else {
               // Default sort order
               include 'sql/select_posts_new.php';
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
               public $comments;
               public $scratches;
            }

            // Fetch each post in the result set and generate html
            $enabled_posts = 0;
            while ($post = $statement->fetchObject('Post')) {
               echo '<article class="post">';
               echo '<p class = "message_heading">Posted by ' . $post->userName . ' on ' . $post->postDate . '</P>';
               echo '<h1>' . $post->postTitle . '</h1>';
               // Go to post page to view comments if the user clicks on the image or comments link
               echo "<a href='post.php?post_id=$post->post_ID' class='post_links'>";
               echo "<figure><img src='includes/db_get_post_image.php?post_id=$post->post_ID'></figure>";
               echo "</a>";
               echo '<div>';
               // Scratch/unscratch post if user is logged in, else goto login page
               if(isset($_SESSION['username'])) {
                  echo "<a href='includes/db_scratch.php?post_id=$post->post_ID' class='post_links'><img src='images/paw.png' style='height:1.25em;'>$post->scratches Scratches</a>";
               } else {
                  echo "<a href='login.php' class='post_links'><img src='images/paw.png' style='height:1.25em;'>$post->scratches Scratches</a>";           
               }
               echo "<a href='post.php?post_id=$post->post_ID' class='post_links'>$post->comments Comments</a>";

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