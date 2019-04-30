<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Contact Us </title>
  <meta charset="UTF-8">
  <link href="css/contact.css" rel="stylesheet" type="text/css">
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
    <h2> Contact us </h2>
    <!-- MAIN BOX -->
    <div class = "signin-box">

    <form class = "form" action = "mainpage.html">

      <!-- USERNAME -->
      <div id = "usernameId">
        Username: <br>
        <input type = "text" id = "usernameTexT" name = "username" required>
      </div>

      <!-- PASSWORD -->
      <div id = "passwordId">
        Password: <br>
        <input type = "password" id = "passwordText" name = "password" required>
      </div>

      <div id = "questionId">
        How can we help you? <br>
        <textarea id = "textBar"></textarea>
      </div>

      <!-- SIGNIN BUTTON -->
      <div id = "contactId">
        <input type = "submit" value = "Send" id = "submitText" >
      </div>

    </form>
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
