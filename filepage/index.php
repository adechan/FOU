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
	  <link href="css/file.css" rel="stylesheet" type="text/css">
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
        <input type="submit" name="search-button" value="Search">
      </form>
		</div>

    <h2> My file </h2>
<?php
  $var = $_GET['fid'];

  echo '<div class = "buttonsList2">';

  echo '<a href = "../filepage/modifyproperties.php?fid=' . $var . '">' .  'Modify File</a>';

  echo '<a href = "../phpScripts/downloadScript.php?fid='. $var .'"> Download </a>';

  echo '<a href = "../filepage/delete.php?fid='. $var .'"> Delete </a>';

  echo '</div>';

    require '../phpScripts/filePageScript.php';
?>
       <br>
       <br>

			<footer>
				<nav>
					<a href="../contactpage/index.php">Contact</a>
				</nav>
			</footer>

	</body>
</html>
