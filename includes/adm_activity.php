<?php
// Restart session if reloading page
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    // Open the database connection
    include 'admin.php';
} else {
    include 'sql/select_activity.php';
}

// Go to main page if the user does not have admin privileges
if(!isset($_SESSION['user_type']) || strcmp($_SESSION['user_type'], "Admin") != 0) {
    header("Location: /cosc360/scratchpost/main.php");
}

// Execute prepared SQL statement and store the result set
$statement->execute();

// Build class to store result set attributes
class Activity {
    public $activityDate;
    public $activityTime;
    public $userName;
    public $activityType;
    public $activity_ID;
    public $postTitle;
}

// Fetch each post in the result set and generate html
echo '<article class="admin_article">';
echo "<h1>Site Activity</h1><br>";
echo "<form method='get' action='admin.php'>";
echo "<div id='to_from_container'>";
echo "<input type='hidden' name='command' value='activity'>";
echo "<label class='to_from'>From:</label>";
echo "<input type='date' name='from' class='to_from' required>";
echo "<label class='to_from''>To:</label>";
echo "<input type='date' name='to' class='to_from' required>";
echo "<input type='submit' class='to_from' value='Filter'>";
echo "</div>";
echo "</form>";

while ($activity = $statement->fetchObject('Activity')) {
    echo "<p class='message_activity'>$activity->activityDate &nbsp&nbsp&nbsp&nbsp [$activity->activityTime] &nbsp&nbsp&nbsp&nbsp $activity->userName $activity->activityType &nbsp&nbsp&nbsp&nbsp <a href='post.php?post_id=$activity->activity_ID'>$activity->postTitle</a></p>";
}
echo '</article>';
// Close the database connection
closeConnection($pdo);
?>