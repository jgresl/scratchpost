<!DOCTYPE html>
<html>

<head lang="en">
   <meta charset="utf-8">
   <title>Scratch Post - Login</title>
   <link rel="icon" href="images/favicon.png" type="image/x-icon">
   <link rel="stylesheet" href="css/reset.css">
   <link rel="stylesheet" href="css/main.css">
   <link rel="stylesheet" href="css/header.css">
   <script type="text/javascript" src="js/login_form_validation.js"></script>
</head>

<body>
   <header>
      <?php include 'includes/header.php'; ?>
   </header>
   <main>
      <div id="column1">
         <article id="login">
            <div class="banner">
               <h1>User Login</h1>
            </div>
            <form method="post" action="includes/db_login.php" id="form"><br>
               <label>Email: </label><br>
               <input type="email" name="email" class="required"><br><br>
               <label>Password: </label><br>
               <input type="password" name="password" class="required"><br><br>
               <section id="bottom_form_section">
                  <p id="form_message">
                     <?php
                        if(isset($_SESSION['message'])) 
                           echo $_SESSION['message'];
                           unset($_SESSION['message']);
                     ?>
                  </p><br>
               </section>
               <input type="submit" value="Login">
               <a href="recover.php" class="reglinks">Forgot password?</a>
            </form>
         </article>
   </main>
</body>

</html>