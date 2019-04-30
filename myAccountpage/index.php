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
		  <a href="../myAccountpage/index.php">All Files</a>
		  <a href="../addfilepage/index.php">Add Files</a>
		  <a href="../logoutpage/index.php">Logout</a>
			<input type="text" placeholder="Search...">
		</div>

			<table class="files">
			  <tr>
			    <th>Name</th>
			    <th>Description</th>
			    <th>Author</th>
					<th>Program</th>
			  </tr>
			  <tr>
			    <td><a href="../filepage/index.php">Curs2</a> </td>
			    <td>curs TW</td>
			    <td>Buraga S.</td>
					<td>PowerPoint</td>
			  </tr>
			  <tr>
			    <td>Books </td>
			    <td>list of books</td>
			    <td>Gigel</td>
					<td>Text Document</td>
			  </tr>
			  <tr>
			    <td>Mos Craciun si prietenii sai </td>
			    <td>carte</td>
			    <td>autor123</td>
					<td>EPUB</td>
			  </tr>
			  <tr>
			    <td>Fight Club</td>
			    <td>movie</td>
			    <td>Chuck Palahniuk</td>
					<td>KMPlayer</td>
			  </tr>
			  <tr>
			    <td>Gramatica limbii romane</td>
			    <td>important</td>
			    <td>Veorica123</td>
					<td>PDF</td>
				</tr>
			</table>
			<!-- container for the dropup Group By button-->
			<div class="buttonContainer">
			  <button class="dropButton">Group By</button>
			  <div class="buttonContent">
			    <a href="#">Author</a>
			    <a href="#">Program</a>
			  </div>
			</div>

			<div class="centerPagination">
				<div class="pagination">
				  <a href="#">&laquo;</a>
				  <a class="active" href="#">1</a>
				  <a href="#">2</a>
				  <a href="#">3</a>
				  <a href="#">4</a>
				  <a href="#">5</a>
				  <a href="#">6</a>
				  <a href="#">&raquo;</a>
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