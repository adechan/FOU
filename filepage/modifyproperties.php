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
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
		<meta name="author" content="Cosmin Sescu & Andreea Rindasu">
		<title>My File</title>
	  <link href="css/modifyfile.css" rel="stylesheet" type="text/css">
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

    <h2> Modify Properties </h2>

    <div class = "buttonsList2">
      <a href = "../filepage/index.html"> Previous </a>
    </div>

  	<div class = "modifyproperties-box">
    <form class = "form" action = "#">


      <div id = "nameId">
        Name: <br>
        <input type = "text" id = "nameTexT" name = "name" value = "Curs2">
      </div>

      <div id = "authorId">
        Author: <br>
        <input type = "text" id = "authorText" name = "author" value = "Buraga S">
      </div>

      <div id = "typefileId">
        Type of file: <br>
        <input type = "text" id = "typefileText" name = "typeFile" value ="PowerPoint">
      </div>

			<div id = "descriptionId">
				Description: <br>
				<input type = "text" id = "descriptionText" name = "description" value ="Course TW">
			</div>

			<div id = "uploadedonId">
				Uploaded on: <br>
				<input type = "text" id = "uploadedonText" name = "uploadedOn" value ="23 March 2019">
			</div>

			<div id = "versionId">
				Version: <br>
				<input type = "text" id = "versionText" name = "version" value = "1.0">
			</div>

			<div id = "tagId">
				Tags: <br>
				<input type = "text" id = "tagText" name = "tag" value = "Course, School, TW">
			</div>

      <div id = "saveId">
        <input type = "submit" value = "Save" id = "saveText">
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
