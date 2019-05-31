<?php
session_start();
if(!isset($_SESSION['USERNAME']))
  header("Location: ../index.php?access=denied");
 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<meta name="description" content="Easy File Transfer">
		<meta name="author" content="Cosmin Sescu & Andreea Rindasu">
		<title>My Account</title>
		<link rel="stylesheet" href="pageStyle.css">
	</head>
	<body>
		<header> FOU </header>
		<div class="buttonsList">
			<a href="../myAccountpage/index.php">My Files </a>
		  <a href="../allFilespage/index.php">All Files</a>
		  <a href="../addfilepage/index.php">Add Files</a>
		  <a href="../logoutpage/index.php">Logout</a>
			<input type="text" placeholder="Search...">
		</div>

    <?php require '../phpScripts/allFilesScript.php'; ?>


			<!-- container for the dropup Group By button-->
			<div class="buttonContainer">
			  <button class="dropButton">Group By</button>
			  <div class="buttonContent">
			    <a href="#">Author</a>
			    <a href="#">Program</a>
			  </div>
			</div>

			<footer>
				<nav>
					<a href="../contactpage/index.php">Contact</a>
					<a href="../feedbackpage/index.php"> Feedback</a>
				</nav>
			</footer>
	</body>
</html>
