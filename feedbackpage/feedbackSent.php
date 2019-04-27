<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Feedback </title>
  <meta charset="UTF-8">
  <link href="css/feedbacksent.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Gothic+A1" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Gothic+A1" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

  <body>
    <header> FOU </header>

    <div class = "buttonsList">
      <a href="../myAccountpage/index.php">My Files </a>
		  <a href="../myAccountpage/index.php">All Files</a>
		  <a href="../addfilepage/index.php">Add Files</a>
		  <a href="../logoutpage/index.php">Logout</a>
			<input type="text" placeholder="Search...">
    </div>

    <h2> Feedback </h2>
    <!-- MAIN BOX -->
    <div class = "feedback-sent-box">

        <div class = "minibox">
        <p id = "feedbackSent"> Your Feedback has been sent </p>
        <p id = "thankYou"> Thank you for your time! </p>

        </div>

        <a href = "../myAccountpage/myAccount.html" id = "backToMain"> Click here to go to main page </a>
    </div>
    <br>
  	<br>
  	<br>
  	<br>

  <footer>
    <nav>
      <a href="../contactpage/index.html">Contact</a>
      <a href="../feedbackpage/index.html">Feedback</a>
    </nav>
  </footer>

  </body>
</html>
