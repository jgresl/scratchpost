<article class>
    <form method="get" action="admin.php?command=users">
        <div class="basic_search">
            <input type="text" name="command" value="users" style="visibility:hidden; width:0">
            <input class="basic_searchField" name="search" type="text" placeholder="Search for username, email, status, type, name, or post title">
            <input type="submit" value="Search">
        </div>
   </form>
</article>



<?php
    // Go to main page if the user does not have admin privileges
    if(!isset($_SESSION['user_type']) || strcmp($_SESSION['user_type'], "Admin") != 0) {
    header("Location: /cosc360/scratchpost/main.php");
    }

    if(isset($_GET['search'])) {
        include "sql/search_users.php";
    } else {
        include "sql/select_all_users.php";
    }


    // Execute prepared SQL statement and store the result set
    $statement->execute();

    // Build class to store result set attributes
    class User {
        public $userID;
        public $userName;
        public $UserEmail;
        public $userStatus;
        public $userType;
        public $userFirstName;
        public $userLastName;
        public $userBirthdate;
        public $userFirstLogin;
        public $userLastLogin;
    }

    echo '<article class="admin_article">';
    if (isset($_SESSION['message'])) {
        echo '<section id="bottom_form_section">';
        echo '<p id="form_message">'.$_SESSION['message'].'</p>';
        echo '</section><br>';
    }
    echo '<table>';
    echo '<tr><th>ID</th><th>Username</th><th>Email</th><th>Status</th><th>Type</th><th>Name</th><th>Last Login</th></tr>';

    // Generate a table row for each user
    while ($user = $statement->fetchObject('User')) {
        echo "<tr><form method='post' action='includes/db_update_user.php' class='user_form'>
                <td>$user->user_ID<input type='hidden' name='user_id' value='$user->user_ID'></td>
                <td>$user->userName<input type='hidden' name='user_name' value='$user->userName'></td>
                <td>$user->userEmail</td>
                <td><select class='edit_select' name='user_status'>
                    <option value='' selected='selected' hidden='hidden'>$user->userStatus</option>
                    <option value='Enabled'>Enabled</option>
                    <option value='Disabled'>Disabled</option>
                </select></td>
                <td><select class='edit_select' name='user_type'>
                    <option value='' selected='selected' hidden='hidden'>$user->userType</option>
                    <option value='Basic'>Basic</option>
                    <option value='Admin'>Admin</option>
                </select></td>
                <td>$user->userFirstName $user->userLastName</td>
                <td>$user->userLastLogin</td>
        </form></tr>";
    }
    echo '</table>';
    echo '</article>';

    // Clear the message
    unset($_SESSION['message']);
?>