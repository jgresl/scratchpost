<?php
   if (isset($_POST['email'])) {
      include 'db_connection.php';

      // Open the database connection
      try{
         $pdo = openConnection();
      } catch (PDOException $e){
         die($e->getMessage());
      }

      // Create new user in database
      include '../sql/insert_new_user.php';

      // Execute prepared SQL statement and store the result set
      $statement->execute();

      // Close the database connection
      closeConnection($pdo);

      // Redirect to new page
      session_start();
      $_SESSION['message'] = "Thank you for registering. Please login to continue.";
      header("Location: ../login.php");
   }
?>