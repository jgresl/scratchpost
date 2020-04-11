<?php
   // Get parameters from POST
   $post_ID = $_POST['post_id'];
   include 'db_connection.php';

   // Open the database connection
   try{
      $pdo = openConnection();
   } catch (PDOException $e){
      die($e->getMessage());
   }

   // Create new user in database
   include '../sql/insert_new_comment.php';

   // Execute prepared SQL statement and store the result set
   $statement->execute();

   // Close the database connection
   closeConnection($pdo);

   // Redirect to referring page
   header("Location: ../post.php?post_id=$post_ID");
?>