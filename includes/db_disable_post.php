<?php
   include 'db_connection.php';

   // Open the database connection
   try{
      $pdo = openConnection();
   } catch (PDOException $e){
      die($e->getMessage());
   }

   // Create new user in database
   include '../sql/update_post_status.php';

   // Execute prepared SQL statement and store the result set
   $statement->execute();

   // Close the database connection
   closeConnection($pdo);
   
   // Redirect to previous page
   header("Location: " . $_SERVER['HTTP_REFERER']);
?>