<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Sign In Page </title>
  <meta charset="UTF-8">
  <link href="css/signin.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

  <body>
    <header> FOU </header>
    <div class = "buttonsList">
      <a href ="../registerpage/index.php"> Register </a>
      <a href = "../signinpage/index.php"> Sign in </a>
    </div>

    <!-- HEADER -->
    <h2> Log in </h2>
    <!-- MAIN BOX -->
    <div class = "signin-box">

    <form class = "form" action = "javascript:void(0);" method="post">

      <!-- USERNAME -->
      <div id = "usernameId">
        Username: <br>
        <input type = "text" id = "userText" name = "userLogin" onfocus="clearError('user')" required>
        <div id="userError"></div>
      </div>

      <!-- PASSWORD -->
      <div id = "passwordId">
        Password: <br>
        <input type = "password" id = "passText" name = "passLogin" onfocus="clearError('pass')" required>
        <div id="passError"></div>
      </div>

      <!-- SIGNIN BUTTON -->
      <div id = "signinButtonId">
        <input type = "submit" onclick="validateThenSend()" name ="login-button" value = "Sign in" id = "submitText" >
      </div>

    </form>

  <!-- DONT HAVE AN ACCOUNT text -->
  <a href = "../registerpage/index.php" id = "dontHaveAccountId"> Don't have an account yet? </a>

</div>
<br>
<br>
<br>
<br>

<script>
  function getFormInputs()
  {
    var user = document.getElementById('userText').value;
    var pass = document.getElementById('passText').value;

    return {
      user: user,
      pass: pass,
    };
  }

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
    'user': document.getElementById('userError'),
    'pass': document.getElementById('passError'),
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

  function validateThenSend() 
  {
    var inputs = getFormInputs();

    // create a new XMLHttpRequest object -- an object like any other!!!!
    var http = new XMLHttpRequest();

    var url = '../phpScripts/loginScript.php'
      + '?user=' + inputs['user']
      + '&pass=' + inputs['pass'];

    // open the request and pass the HTTP method name and the resource as parameters
    http.open('GET', url, true);

    // write a function that runs anytime the state of the AJAX request changes
    http.onreadystatechange = function() 
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
          if (response === "Success");
            window.location.href = '../myAccountpage/index.php';
        }
      }
    };

    http.send();
  }
</script>

<footer>
  <nav>
    <a href="../contactpage/index.php">Contact</a>
  </nav>
</footer>

  </body>
</html>
