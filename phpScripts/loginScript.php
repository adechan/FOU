<?php
  function outputError($error, $type)
  {
    echo 'Error: ' . json_encode(array(
      'type' => $type,
      'message' => $error
    ));

    exit();
  }

  require 'database.php';
  $username = $_GET['user'];
  $password = $_GET['pass'];

  $sqlStatement = "SELECT * FROM Users WHERE username=?;";
  $statement = mysqli_stmt_init($connection);

  //Check if statement works
  if(!mysqli_stmt_prepare($statement, $sqlStatement))
    outputError('SQL Error', 'other');

  mysqli_stmt_bind_param($statement, "s", $username);
  mysqli_stmt_execute($statement);
  
  // mysqli_stmt_store_result($statement);

  // //get number of returned rows
  // $num_rows = mysqli_stmt_num_rows($statement);

  // if ($num_rows <= 0)
  //   outputError('Invalid username', 'user');

  $result = mysqli_stmt_get_result($statement);

  if ($result == null)
    outputError('SQL Error', 'other');

  //Store result in an array
  $row = mysqli_fetch_assoc($result);

  if($row == null)
    outputError('Invalid username', 'user');
  
  //Hash the password from input form and
  //check it against the one in DB
  $checkPassword = password_verify($password, $row['pass']);
  if($checkPassword==false)
    outputError('Incorrect password', 'pass');

  //passwords match, login user
  //Start session
  session_start();

  //Create session variables
  $_SESSION['ID']= $row['id'];
  $_SESSION['USERNAME']= $row['username'];

  echo 'Success';
?>
