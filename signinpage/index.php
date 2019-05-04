<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Sign In Page </title>
  <meta charset="UTF-8">
  <link href="css/signin.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

  <body>
    <header> FOU </header>
    <div class = "buttonsList">
      <a href ="../registerpage/index.php"> Register </a>
      <a href = "../signinpage/index.php"> Sign in </a>
    </div>

    <!-- HEADER -->
    <h2> Log in </h2>
    <!-- MAIN BOX -->
    <div class = "signin-box">

    <form class = "form" action = "../phpScripts/loginScript.php" method="post">

      <!-- USERNAME -->
      <div id = "usernameId">
        Username: <br>
        <input type = "text" id = "usernameText" name = "userLogin" required>
      </div>

      <!-- PASSWORD -->
      <div id = "passwordId">
        Password: <br>
        <input type = "password" id = "passwordText" name = "passLogin" required>
      </div>

      <!-- SIGNIN BUTTON -->
      <div id = "signinButtonId">
        <input type = "submit" name ="login-button" value = "Sign in" id = "submitText" >
      </div>

    </form>

  <!-- DONT HAVE AN ACCOUNT text -->
  <a href = "../registerpage/index.php" id = "dontHaveAccountId"> Don't have an account yet? </a>

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
