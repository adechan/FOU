<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Register Page </title>
  <meta charset="UTF-8">
  <link href="css/register.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

  <body>

    <header> FOU </header>
    <div class = "buttonsList">
      <a href = "../registerpage/index.php"> Register </a>
      <a href = "../signinpage/index.php"> Sign in </a>
    </div>

    <!-- HEADER -->
    <h2> Registration </h2>
    <!-- MAIN BOX -->
    <div class = "register-box">

    <!-- Javascript: VOID(0) : URL will redirect the browser to a plain text version of the result of evaluating that JavaScript. 
    But if the result is undefined, then the browser stays on the same page-->

    <form id="registerForm" method='post' name="registerForm" action="javascript:void(0);">

      <!-- EMAIL -->
      <div id = "emailId">
        Email: <br>
        <input type = "text" id = "emailText" onfocus="clearError('email')" name ="email" required>
        <div id="emailError"></div>
      </div>

      <!-- USERNAME -->
      <div id = "usernameId">
        Username: <br>
        <input type = "text" id = "userText" onfocus="clearError('user')" name ="user" required>
        <div id="userError"></div>
      </div>

      <!-- PASSWORD -->
      <div id = "passwordId">
        Password: <br>
        <input type = "password" id = "passText" onfocus="clearError('pass')" name = "pass" required>
        <div id="passError"></div>
      </div>

      <!-- CONFIRM PASSWORD -->
      <div id = "confirmPasswordId">
        Confirm password: <br>
        <input type = "password" id = "passConfirmText" onfocus="clearError('passConfirm')" name = "passConfirm" required>
        <div id="passConfirmError"></div>
      </div>

      <!-- REGISTER BUTTON -->
      <div id = "registerButtonId">
        <input type = "submit" name="register-button" onclick="validateThenSend()" value = "Create account" id = "submitText" >
      </div>

    </form>

  <!-- ALREADY HAVE AN ACCOUNT text -->
  <a href = "../signinpage/index.php" id = "alreadyAccountId"> Already have an account? </a>

<script>
  function getFormInputs()
  {
    var email = document.getElementById('emailText').value;
    var user = document.getElementById('userText').value;
    var pass = document.getElementById('passText').value;
    var passConfirm = document.getElementById('passConfirmText').value;

    return {
      email: email,
      user: user,
      pass: pass,
      passConfirm: passConfirm
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
    'email': document.getElementById('emailError'),
    'user': document.getElementById('userError'),
    'pass': document.getElementById('passError'),
    'passConfirm': document.getElementById('passConfirmError'),
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

    var url = '../phpScripts/registerScript.php'
      + '?email=' + inputs['email']
      + '&user=' + inputs['user']
      + '&pass=' + inputs['pass']
      + '&passConfirm=' + inputs['passConfirm'];

    // open the request and pass the HTTP method name and the resource as parameters
    http.open('GET', url, true); // true means asynch

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
          window.location.href = '../signinpage/index.php';
        }
      }
    };

    http.send();
  }
</script>

</div>
<br>
<br>
<br>
<br>

<footer>
  <nav>
    <a href="../contactpage/index.php">Contact</a>
  </nav>
</footer>

  </body>
</html>
