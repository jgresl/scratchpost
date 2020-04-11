<?php
    // Get parameters from POST
    $userName = $_POST['username'];
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];
    $userFirstName = $_POST['first_name'];
    $userLastName = $_POST['last_name'];
    $userBirthdate = $_POST['birth_date'];
    
    // Use the provided image or grab the default profile image
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
        // Pull the image from the FILES superglobal
        $userImage = file_get_contents($_FILES['image']['tmp_name']);
    } else {
        $userImage = file_get_contents("../images/profile.png");
    }

    // SQL statement to insert new user
    $sql = "INSERT INTO User (userName, userEmail, userPassword, userFirstName, userLastName, userBirthdate, userImage) 
                VALUES (:userName, :userEmail, :userPassword, :userFirstName, :userLastName, :userBirthdate, :userImage)";
                
    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':userName', $userName);
    $statement->bindvalue(':userEmail', $userEmail);
    $statement->bindvalue(':userPassword', $userPassword);
    $statement->bindvalue(':userFirstName', $userFirstName);
    $statement->bindvalue(':userLastName', $userLastName);
    $statement->bindvalue(':userBirthdate', $userBirthdate);
    $statement->bindParam(':userImage', $userImage, PDO::PARAM_LOB);
?>