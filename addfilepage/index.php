<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<meta name="description" content="Easy File Transfer">
    <link href="css/addfile.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
		<meta name="author" content="Cosmin Sescu & Andreea Rindasu">
		<title> Add files </title>

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

    <h2> Add a file </h2>

    <div class = "addfile-box">
		<form action = "../phpScripts/uploadScript.php" method = "post" enctype = "multipart/form-data">

		<div class = "selectFile">
		  <p id = "select-text">	Select a file: </p><br>
			<input type = "file" name="fileInput"  id = "select-file"> <br>
		</div>

		<div class = "tagsFile">
		    <p id = "tags-text"> Tags: </p><br>
		    <textarea id = "textTags" name="tags"></textarea>
		</div>

		<div class = "descriptionFile">
		    <p id = "description-text">	Description: </p><br>
		    <textarea id = "textDescription" name="descr"></textarea>
		</div>

    <div class="custom-select">
      <select name="isPublic">
        <option> Select type of file: </option>
        <option value = "public"> Public </option>
        <option value = "private"> Private </option>
      </select>
    </div>

		<div class = "uploadFile">
				<input type = "submit" name="upload-button" id = "upload-file" value = "Upload file"> <br>
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
