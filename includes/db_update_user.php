<?php
   // Get parameters from POST
   $user_ID = $_POST['user_id'];
   $userName = $_POST['user_name'];
   $userStatus = $_POST['user_status'];
   $userType = $_POST['user_type'];
   
   include 'db_connection.php';

   // Open the database connection
   try{
      $pdo = openConnection();
   } catch (PDOException $e){
      die($e->getMessage());
   }

   // Modify user in database
   session_start();
   if($userStatus == "" && $userType != "") {
      include '../sql/update_user_type.php';
      $_SESSION['message'] = "User type for $userName has been changed to $userType";
   }

   if($userStatus != "" && $userType == "") {
      include '../sql/update_user_status.php';
      $_SESSION['message'] = "User status for $userName has been changed to $userStatus";
   }

   // Execute prepared SQL statement and store the result set
   $statement->execute();

   // Close the database connection
   closeConnection($pdo);
   
   // Redirect to new page
   header("Location: ../admin.php?command=users");
?>