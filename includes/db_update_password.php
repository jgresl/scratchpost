<?php
   include 'db_connection.php';

   // Open the database connection
   try{
      $pdo = openConnection();
   } catch (PDOException $e){
      die($e->getMessage());
   }

   // Query for user password
   include '../sql/select_user_data.php';
   
   // Execute prepared SQL statement and store the result set
   $statement->execute();

   // Build class to store result set attributes
   class CurrentUser {
      public $userName;
      public $userPassword;
   }

   // Compare passwords to validate
   $suppliedPassword = $_POST['password'];
   $current_user = $statement->fetchObject('CurrentUser');
   if (strcmp($suppliedPassword, $current_user->userPassword) == 0) {

      // Query to updaye password
      include '../sql/update_password.php';
      
      // Execute prepared SQL statement and store the result set
      $statement->execute();

      $_SESSION['password_message'] = "Password updated";
      header("Location: ../profile.php");

   } else {
      $_SESSION['password_message'] = "Invalid password";
      header("Location: ../profile.php");
   }

   // Close the database connection
   closeConnection($pdo);
?>