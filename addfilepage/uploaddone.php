<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Feedback </title>
  <meta charset="UTF-8">
  <link href="css/uploaddone.css" rel="stylesheet" type="text/css">
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

    <h2> Add a file </h2>
    <!-- MAIN BOX -->
    <div class = "upload-done-box">

        <div class = "minibox">
        <p id = "uploadDone"> Your file has been uploaded </p>

        </div>

        <a href = "../addfilepage/index.php" id = "uploadMore"> Upload more? </a>
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
