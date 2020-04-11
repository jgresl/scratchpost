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
      <?php
         // Go to main page if user is not logged on
         if(!isset($_SESSION['username'])) {
            header("Location: main.php");
         }
      ?>
   </header>
   <main>
      <div id="column1">
         <article id="profile">
            <div class="banner">
               <h1>My Profile</h1>
            </div>
            
            <form method="post" action="includes/db_update_profile.php" id="form" enctype="multipart/form-data"><br>
               <?php
                  include 'includes/db_connection.php';

                  // Open the database connection
                  try{
                     $pdo = openConnection();
                  } catch (PDOException $e){
                     die($e->getMessage());
                  }               

                  // Query for user profile info
                  include 'sql/select_user_profile.php';

                  // Execute prepared SQL statement and store the result set
                  $statement->execute();

                  //Build class to store result set attributes
                  class CurrentUser {
                     public $user_ID;
                     public $userName;
                     public $userEmail;
                     public $userFirstName;
                     public $userLastName;
                     public $userBirthdate;
                  }

                  // Fetch user profile info in the result set and generate html
                  $current_user = $statement->fetchObject('CurrentUser');

                  echo '<figure><img src="includes/db_get_user_image.php?user_id=' . $current_user->user_ID . '" alt="Profile Pic" class="profile_pic"></figure><br>';
                  echo '<label>First Name: </label><br>';
                  echo '<input type="text" name="first_name" value="' . $current_user->userFirstName . '" required><br><br>';
                  echo '<label>Last Name: </label><br>';
                  echo '<input type="text" name="last_name" value="' . $current_user->userLastName . '" required><br><br>';
                  echo '<label>Birthdate: </label><br>';
                  echo '<input type="date" name="birth_date" value="' . $current_user->userBirthdate . '" required><br><br>';

                  // Close the database connection
                  closeConnection($pdo);
               ?>

               <label>Profile Image: </label><br>
               <input type="file" name="image" accept="image/*"><br><br>

               <p id="form_message">
                  <?php
                     if(isset($_SESSION['profile_message'])) 
                        echo $_SESSION['profile_message'];
                        unset($_SESSION['profile_message']);
                  ?>
               </p><br>

               <input type="submit" class="update_profile" value="Update Profile">
            </form>
         </article>
         <article id="profile">
            <div class="banner">
               <h1>Password</h1>
            </div>
            <form method="post" action="includes/db_update_password.php" id="form"><br>
               <label>Password: </label><br>
               <input type="password" name="password" id="password" autocomplete="off" required><br><br>
               <label>New Password: </label><br>
               <input type="password" name="password2" id="password2" autocomplete="off" required><br><br>
               <label>Confirm Password: </label><br>
               <input type="password" name="password3" id="password3" autocomplete="off" required><br><br>

               <p id="form_message">
                  <?php
                     if(isset($_SESSION['password_message'])) 
                        echo $_SESSION['password_message'];
                        unset($_SESSION['password_message']);
                  ?>
               </p><br>

               <input type="submit" class="update_profile" value="Update Password">
            </form>
         </article>
      </div>
      <div id="column2">

         <article id="mediapost">
            <div class="banner">
               <h1>Create Post</h1>
            </div>
            <form method="post" action="includes/db_create_post.php" enctype="multipart/form-data"><br>
               <input type="text" name="title" placeholder="Post Title" class="long_text_input" required><br><br>
               <label for="img">Select image:</label>
               <input type="file" name="image" accept="image/*" required><br><br>
               <input type="submit" value="Post">
               <a href="main.php" class="reglinks">Return to main</a>
            </form>
         </article>

        <?php
            // Open the database connection
            try{
               $pdo = openConnection();
            } catch (PDOException $e){
               die($e->getMessage());
            }

            // Sort by newest
            include 'sql/select_user_posts.php';

            // Execute prepared SQL statement and store the result set
            $statement->execute();

            // Build class to store result set attributes
            class Post {
               public $post_ID;
               public $userName;
               public $postDate;
               public $postTitle;
               public $scratches;
               public $comments;
            }

            // Fetch each post in the result set and generate html
            $user_posts = 0;
            while ($post = $statement->fetchObject('Post')) {
               echo '<article class="post">';
               echo '<p class="message_heading">Posted by ' . $post->userName . ' on ' . $post->postDate . '</P>';
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

               // Include option to delete post if the post belongs to the user
               echo '<form method="post" action="includes/db_delete_post.php" style="display: inline;">';
               echo '<input type="hidden" name="post_id" value='.$post->post_ID.'>';
               echo '<input type="submit" value="Delete Post" class="disable_button">';
               echo '</form>';

               echo '</div>';
               echo '</article>';
               $user_posts++;
            }

            if ($user_posts == 0) {
               echo '<article>';
               echo '<p>You have not posted anything yet</p>';
               echo '</article>';
            }

            // Close the database connection
            closeConnection($pdo);
         ?>

      </div>
   </main>
</body>

</html>