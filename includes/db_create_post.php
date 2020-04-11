<?php
   include 'db_connection.php';

   // Open the database connection
   try{
      $pdo = openConnection();
   } catch (PDOException $e){
      die($e->getMessage());
   }

   // Create new user in database
   include '../sql/insert_new_post.php';

   // Execute prepared SQL statement and store the result set
   $statement->execute();

   // Close the database connection
   closeConnection($pdo);
   
   // Redirect to new page
   header("Location: ../profile.php");
?>