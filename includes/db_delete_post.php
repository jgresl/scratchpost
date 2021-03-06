<?php
   include 'db_connection.php';

   // Open the database connection
   try{
      $pdo = openConnection();
   } catch (PDOException $e){
      die($e->getMessage());
   }

   // Create new user in database
   include '../sql/delete_post.php';

   // Execute prepared SQL statement
   $statement->execute();

   // Close the database connection
   closeConnection($pdo);
   
   // Redirect to new page
   header("Location: " . $_SERVER['HTTP_REFERER']);
?>