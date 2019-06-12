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
		  <a href="../allFilespage/index.php">All Files</a>
		  <a href="../addfilepage/index.php">Add Files</a>
		  <a href="../logoutpage/index.php">Logout</a>

       <form class="" action = "../allFilespage/index.php">
			  <input type="text" placeholder="Search..." name="searchString" >
        <input type="submit" id = "search-button" name="search-button" value="Search">
      </form>

		</div>


    <h2> Add a file </h2>

    <div class = "addfile-box">
		<form id='uploadForm' action="javascript:void(0);" method = "post" enctype = "multipart/form-data">

		<div class = "selectFile">
		  <p id = "select-text">	Select a file: </p><br>
			<input type = "file" name="fileInput" id = "select-file" onfocus="clearError('file')" > <br>
		</div>
		<div id="uploadError"></div>

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
        <option> Select type of file: (default public) </option>
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
	  
	  
<script>
  function findErrorMessage(response)
  {
    const start = response.search('Error: ');
    if (start == null)
      return null;
    
    const match = response.match('Error: .*$');

    if (match == null)
      return null;

    return JSON.parse(match[0].substring('Error: '.length));
  }

  const errorDivs = {
    'file': document.getElementById('uploadError'),
  };

  function clearError(type)
  {
    errorDivs[type].innerHTML = '';
  }

  function handleError(error)
  {
    const message = error['message'];
    const type = error['type'];

    console.log('Error: ' + JSON.stringify(error));
    errorDivs[type].innerHTML = message;
  }

  function sendFormData(formData)
  {
    // create a new XMLHttpRequest object -- an object like any other!!!!
    var http = new XMLHttpRequest();
    var url = '../phpScripts/uploadScript.php';

    // open the request and pass the HTTP method name and the resource as parameters
    http.open('POST', url, true); // true means asynch
    // http.setRequestHeader("Content-type", "application/json");

    // write a function that runs anytime the state of the AJAX request changes
    http.addEventListener('readystatechange', function() 
    { 
      // check if the request has a readyState of 4, which indicates the server has responded (complete)
      if (http.readyState === 4) 
      {
        const response = http.responseText;
        console.log('Server responded with: ' + response);

        const errorMessage = findErrorMessage(response);

        if (errorMessage != null)
          handleError(errorMessage);
        else
        {
          // Navigate to login page on success
          window.location.href = '../addfilepage/uploaddone.php';
        }
      }
    }, false);

    http.send(formData);
  }

  var form = document.getElementById('uploadForm');
  form.onsubmit = function()
  {
    var formData = new FormData(form);
    sendFormData(formData);
    return false; // don't do the default form action
  };
</script>


    <footer>
			<nav>
				<a href="../contactpage/index.php">Contact</a>
			</nav>
		</footer>

	</body>
</html>
