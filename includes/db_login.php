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
      include '../sql/select_user_data.php';
      
      // Execute prepared SQL statement and store the result set
      $statement->execute();

      // Close the database connection
      closeConnection($pdo);

      // Build class to store result set attributes
      class CurrentUser {
         public $user_ID;
         public $userName;
         public $userPassword;
         public $userStatus;
         public $userType;
      }

      // Compare passwords to validate login
      $suppliedPassword = $_POST['password'];
      $current_user = $statement->fetchObject('CurrentUser');
      if (strcmp($suppliedPassword, $current_user->userPassword) == 0) {
         session_start();

         // Check if user is disabled
         if (strcmp($current_user->userStatus, "Disabled") == 0) {
            $_SESSION['message'] = "This user account is currently disabled.";
            header("Location: ../login.php");
         } else {
            // Continue with login. Proceed to main page
            $_SESSION['user_id'] = $current_user->user_ID;
            $_SESSION['username'] = $current_user->userName;
            $_SESSION['user_type'] = $current_user->userType;
            header("Location: ../main.php");
         }

      } else {
         // Password is invalid. Return to login
         $_SESSION['message'] = "Invalid credentials";
         header("Location: ../login.php");
      }
   }
?>