<?php
    // Get parameters from POST
    session_start();
    $userName = $_SESSION['username'];
    $userFirstName = $_POST['first_name'];
    $userLastName = $_POST['last_name'];
    $userBirthdate = $_POST['birth_date'];
    
    // Check if an image has been uploaded
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {

        // Pull the image from the FILES superglobal
        $userImage = file_get_contents($_FILES['image']['tmp_name']);

        // SQL statement to update user profile with an image
        $sql = "UPDATE User SET userFirstName = :userFirstName, userLastName = :userLastName, userBirthdate = :userBirthdate, userImage = :userImage WHERE userName = :userName";
        $statement = $pdo->prepare($sql);
        $statement->bindvalue(':userFirstName', $userFirstName);
        $statement->bindvalue(':userLastName', $userLastName);
        $statement->bindvalue(':userBirthdate', $userBirthdate);
        $statement->bindParam(':userImage', $userImage, PDO::PARAM_LOB);
        $statement->bindvalue(':userName', $userName);
    } else {
        // SQL statement to update user profile without an image
        $sql = "UPDATE User SET userFirstName = :userFirstName, userLastName = :userLastName, userBirthdate = :userBirthdate WHERE userName = :userName";
        $statement = $pdo->prepare($sql);
        $statement->bindvalue(':userFirstName', $userFirstName);
        $statement->bindvalue(':userLastName', $userLastName);
        $statement->bindvalue(':userBirthdate', $userBirthdate);
        $statement->bindvalue(':userName', $userName);
    }
    unset($_FILES['image']);
?>