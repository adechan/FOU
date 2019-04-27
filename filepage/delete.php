<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<meta name="description" content="Easy File Transfer">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
		<meta name="author" content="Cosmin Sescu & Andreea Rindasu">
		<title>My File</title>
	  <link href="css/delete.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<header> FOU </header>
		<div class="buttonsList">
			<a href="../myAccountpage/index.php">My Files </a>
		  <a href="../myAccountpage/index.php">All Files</a>
		  <a href="../addfilepage/index.php">Add Files</a>
		  <a href="../logoutpage/index.php">Logout</a>
			<input type="text" placeholder="Search...">
		</div>

    <h2> Delete file </h2>

    <div class = "buttonsList2">
      <a href = "../filepage/index.php"> Previous </a>
    </div>

    <div class = "delete-box">

      <div class = "minibox">
        <p id = "deleteItem"> Are you sure you want to delete this file? </p>
      </div>

      <div class = "buttonsList3">
        <a href = "#" id = "yes"> Yes </a>
        <a href = "../filepage/index.php" id = "no"> No </a>
      </div>

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
