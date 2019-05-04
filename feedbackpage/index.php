<?php
session_start();
if(!isset($_SESSION['USERNAME']))
  header("Location: ../index.php?access=denied");
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Feedback </title>
  <meta charset="UTF-8">
  <link href="css/feedback.css" rel="stylesheet" type="text/css">
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
    <div class = "feedback-box">

  <form class = "form" action = "feedbackSent.html">

  <!-- QUESTION1 -->
  <div id = "question1-class">
  How satisfied are you with the service received? <br>
  <input type = "radio" name = "rate" value = "VS"> Very Satisfied <br>
  <input type = "radio" name = "rate" value = "S"> Satisfied<br>
  <input type = "radio" name = "rate" value = "DS"> Dissatisfied<br>
  <input type = "radio" name = "rate" value = "VD"> Very Dissatisfied<br>
  </div>

  <!-- QUESTION2 -->
  <div id = "question2-class">
  How can we improve the service?  <br>
  <textarea id = "textBar"></textarea>
  </div>

  <!-- SIGNIN BUTTON -->
  <div id = "send-button">
    <input type = "submit" value = "Send Feedback" id = "submit">
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
