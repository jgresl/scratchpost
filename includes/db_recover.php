<?php
   if(isset($_POST['email'])) {
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
         public $userName;
         public $userPassword;
      }

      // Check if email is registered
      $current_user = $statement->fetchObject('CurrentUser');
      if ($current_user->userName) {
         // Send email
         $to = $current_user->userEmail;
         $subject = 'Scratch Post password recovery';
         $text = "Hello $current_user->userName,

We recieved a request to recover your Scratch Post password through your email address.

Your password is:   $current_user->userPassword


If you did not request your password, it is possible that someone else is trying to access your Scratch Post account.


Sincerly,

Scratch Post";

         $headers = 'From: mail.scratchpost@gmail.com';
         $x = mail($to, $subject, $text, $headers);

         // Redirect to login page and prompt user to check their email
         session_start();
         $_SESSION['message'] = "Please check your email for password recovery";
         header("Location: ../login.php");
      } else {
         session_start();
         $_SESSION['message'] = "We cannot find an account associated with that email address";
         header("Location: ../recover.php"); 
      }
   }
?>
