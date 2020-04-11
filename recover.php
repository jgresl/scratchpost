<!DOCTYPE html>
<html>

<head lang="en">
   <meta charset="utf-8">
   <title>Scratch Post - Recover</title>
   <link rel="icon" href="images/favicon.png" type="image/x-icon">
   <link rel="stylesheet" href="css/reset.css">
   <link rel="stylesheet" href="css/main.css">
   <link rel="stylesheet" href="css/header.css">
   <script type="text/javascript" src="js/recover_form_validation.js"></script>
</head>

<body>
   <header>
      <?php include 'includes/header.php'; ?>
   </header>
   <main>
      <div id="column1">
         <article id="signup">
            <div class="banner">
               <h1>Recover Account</h1>
            </div>
            <form method="post" action="includes/db_recover.php" id="form"><br>
               <label id = "email_label">Email:</label><br>
               <input type="email" name="email" id="email_field" class="required"><br><br>
               <section id="bottom_form_section">
                  <p id="form_message"><?php if(isset($_SESSION['message'])) echo $_SESSION['message']; ?></p><br>
               </section>
               <input type="submit" id="submit_button" value="Recover Password">
               <a href="main.php" class="reglinks">Return to main</a>
            </form>
         </article>
   </main>
</body>

</html>