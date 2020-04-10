<?php
    // Get parameters from POST
    session_start();
    $user_ID = $_SESSION['user_id'];
    $postTitle = $_POST['title'];

    // Check if an image has been uploaded
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {

        // Pull the image from the FILES superglobal
        $postImage = file_get_contents($_FILES['image']['tmp_name']);

    // SQL statement to insert new post
    $sql = "INSERT INTO Post (postTitle, postImage, user_ID) 
                VALUES (:postTitle, :postImage, :user_ID)";

    $statement = $pdo->prepare($sql);
    $statement->bindvalue(':postTitle', $postTitle);
    $statement->bindParam(':postImage', $postImage, PDO::PARAM_LOB);
    $statement->bindvalue(':user_ID', $user_ID);
    }
    unset($_FILES['image']);
?>