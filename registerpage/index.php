<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Register Page </title>
  <meta charset="UTF-8">
  <link href="css/register.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

  <body>

    <header> FOU </header>
    <div class = "buttonsList">
      <a href = "../registerpage/index.php"> Register </a>
      <a href = "../signinpage/index.php"> Sign in </a>
    </div>

    <!-- HEADER -->
    <h2> Registration </h2>
    <!-- MAIN BOX -->
    <div class = "register-box">

    <form class = "form" action = "../phpScripts/registerScript.php" method="post">

      <!-- USERNAME -->
      <div id = "usernameId">
        Username: <br>
        <input type = "text" id = "usernameText" name ="user" required>
      </div>

      <!-- PASSWORD -->
      <div id = "passwordId">
        Password: <br>
        <input type = "password" id = "passwordText" name = "pass" required>
      </div>

      <!-- CONFIRM PASSWORD -->
      <div id = "confirmPasswordId">
        Confirm password: <br>
        <input type = "password" id = "confirmPasswordText" name = "passConfirm" required>
      </div>

      <!-- REGISTER BUTTON -->
      <div id = "registerButtonId">
        <input type = "submit" name="register-button" value = "Create account" id = "submitText" >
      </div>

    </form>

  <!-- ALREADY HAVE AN ACCOUNT text -->
  <a href = "../signinpage/index.php" id = "alreadyAccountId"> Already have an account? </a>

</div>
<br>
<br>
<br>
<br>

<footer>
  <nav>
    <a href="../contactpage/index.php">Contact</a>
    <a href="../feedbackpage/index.php">Feedback</a>
  </nav>
</footer>

  </body>
</html>
