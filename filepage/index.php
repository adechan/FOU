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
	  <link href="css/file.css" rel="stylesheet" type="text/css">
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

    <h2> My file </h2>

    <div class = "buttonsList2">
      <a href = "../filepage/modifyproperties.html"> Modify File</a>
      <a href = "#"> Download </a>
      <a href = "../filepage/delete.html"> Delete </a>
    </div>

		<table class="detailsFile">
			  <tr>
			    <th> Name </th>
          <td> Curs2 </td>
			  </tr>

			  <tr>
          <th> Author </th>
  			  <td> Buraga S </td>
			  </tr>

			  <tr>
			    <th> Type of file </th>
          <td> PowerPoint </td>
			  </tr>

			  <tr>
			    <th> Description </th>
          <td> Course TW </td>
			  </tr>

			  <tr>
			    <th> Uploaded on </th>
          <td> 23 March 2019 </td>
			  </tr>

			  <tr>
			    <th> Version </th>
          <td> 1.0 </td>
				</tr>

				<tr>
				 <th> Tags </th>
					<td> Course, School, TW</td>
			 </tr>


			</table>

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
