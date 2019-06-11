<?php
session_start();
if(!isset($_SESSION['USERNAME']))
{
  header("Location: ../index.php?access=denied");
  exit();
}
  $_SESSION['FID']=$_GET['fid'];
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
	  <link href="css/modifyfile.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<header> FOU </header>
    <div class="buttonsList">
			<a href="../myAccountpage/index.php">My Files </a>
		  <a href="../allFilespage/index.php">All Files</a>
		  <a href="../addfilepage/index.php">Add Files</a>
		  <a href="../logoutpage/index.php">Logout</a>
      <form class="" action = "../phpScripts/searchScript.php">
			  <input type="text" placeholder="Search..." name="searchString" >
        <input type="submit" name="search-button" id="search-button" value="Search">
      </form>
		</div>

    <h2> Modify Properties </h2>

    <div class = "buttonsList2">
      <a href = "../filepage/index.php"> Previous </a>
    </div>

  	<div class = "modifyproperties-box">
    <form class = "form" action = "../phpScripts/modifyFileScript.php">

      <div id = "nameId">
        Name: <br>
        <input type = "text" id = "nameText" name = "name" value = "Curs2">
      </div>

			<div id = "descriptionId">
				Description: <br>
				<input type = "text" id = "descriptionText" name = "description" value ="Course TW">
			</div>

			<div id = "tagId">
				Tags: <br>
				<input type = "text" id = "tagsText" name = "tags" value = "Course, School, TW">
			</div>

      <div id = "saveId">
        <input type = "submit" value = "Save" name="modify-button" id = "saveText">
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
