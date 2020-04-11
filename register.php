<!DOCTYPE html>
<html>

<head lang="en">
   <meta charset="utf-8">
   <title>Scratch Post - Register</title>
   <link rel="icon" href="images/favicon.png" type="image/x-icon">
   <link rel="stylesheet" href="css/reset.css">
   <link rel="stylesheet" href="css/main.css">
   <link rel="stylesheet" href="css/header.css">
   <script type="text/javascript" src="js/reg_form_validation.js"></script>
</head>

<body>
   <header>
      <?php include 'includes/header.php'; ?>
   </header>
   <main>
      <div id="column1">
         <article id="signup">
            <div class="banner">
               <h1>Create Account</h1>
            </div>
            <form method="post" action="includes/db_register.php" id="form" enctype="multipart/form-data"><br>
               <section id="left_form_section">
                  <label>Email: </label><br>
                  <input type="email" name="email" class="required"><br><br>
                  <label>Username: </label><br>
                  <input type="text" name="username" class="required"><br><br>
                  <label>Password: </label><br>
                  <input type="password" name="password" id="password" class="required"><br><br>
                  <label>Confirm Password: </label><br>
                  <input type="password" name="password2" id="password2" class="required"><br><br>
               </section>
               <section id="right_form_section">
                  <label>First Name: </label><br>
                  <input type="text" name="first_name" class="required"><br><br>
                  <label>Last Name: </label><br>
                  <input type="text" name="last_name" class="required"><br><br>
                  <label>Birthdate: </label><br>
                  <input type="date" name="birth_date" class="required"><br><br>
                  <label>Profile Image: </label><br>
                  <input type="file" name="image" accept="image/*"><br><br>
               </section>
               <section id="bottom_form_section">
                  <p id="form_message"></p><br>
               </section>
               <div class="rectangle">
                  <input type="checkbox" name="accept" class="required">
                  <label>I agree to the Scratchpost <a href="data/user_agreement.pdf" target="_blank">User Agreement</a></label>
               </div><br>
               <input type="submit" value="Register">
               <a href="main.php" class="reglinks">Return to main</a>
            </form>
         </article>
   </main>
</body>

</html>