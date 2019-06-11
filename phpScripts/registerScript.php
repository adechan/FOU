<?php
//if user got here by pressing the register button

  function outputError($error, $type)
  {
    echo 'Error: ' . json_encode(array(
      'type' => $type,
      'message' => $error
    ));

    exit();
  }

  function onRegisterClick()
  {
    require 'database.php';

    $username = $_GET['user'];
    $password = $_GET['pass'];
    $passwordConfirmation = $_GET['passConfirm'];
    $email = $_GET['email'];

    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
      // header("Location: ../register.php?error=invalidmail");
      // exit();
      outputError('Invalid email address', 'email');
    }

    //PUBLIC_FILES is the storage for all files.
    //can't have a user with same name.
    if($username=="PUBLIC_FILES")
    {
      // header("Location: ../registerpage/index.php?error=invalidUsername");
      // exit();
      outputError('Username already exists', 'user');
    }

    //Check username for special characters
    $pattern = "/[a-zA-Z_0-9]*/";
    if(!preg_match($pattern,$username))
    {
      // header("Location: ../registerpage/index.php?error=invalidUser");
      // exit();
      outputError('Invalid username', 'user');
    }

    //Check if passwords match
    if($password!==$passwordConfirmation)
    {
      // header("Location: ../register.php?error=passCheck");
      // exit();
      outputError('Passwords do not match', 'passConfirm');
    }

    //Strong password
    if (!preg_match('/[\!\@\#\$\%\^\&\*\(\)\_\-\+\=\[\]\,\.\<\>]/', $password))
    {
      // header("Location: ../register.php?error=weakPass");
      // exit();
      outputError('Password is too weak', 'pass');
    }

    if(strlen($password)<6 || strlen($password)>32)
    {
      // header("Location: ../register.php?error=passLength");
      // exit();
      outputError('Invalid password length', 'pass');
    }

    //If all ok
    $sqlStatement="SELECT * FROM users WHERE username=? OR email=?;";
    $Statement=mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($Statement,$sqlStatement))
    {
      // header("Location: ../register.php?error=sqlError");
      // exit();
      outputError('SQL Error', 'other');
    }

    mysqli_stmt_bind_param($Statement,"ss",$username,$email);
    mysqli_stmt_execute($Statement);
    mysqli_stmt_store_result($Statement);

    //get number of returned rows
    $result = mysqli_stmt_num_rows($Statement);

    //if > 0 another user exists.
    if($result > 0)
    {
      // header("Location: ../register.php?error=userOrEmailExists");
      // exit();
      outputError('Username or email already exists', 'user');
    }

    //Code executes only if there were no errors previously
    $sqlStatement="INSERT INTO Users(email, username, pass) VALUES(?, ?, ?);";
    $Statement=mysqli_stmt_init($connection);

    if(!mysqli_stmt_prepare($Statement,$sqlStatement))
    {
      // header("Location: ../register.php?error=sqlError");
      // exit();
      outputError('SQL Error', 'other');
    }

    //Hash password using default algorithm(bCrypt)
    $hashPassword = password_hash($password,PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($Statement,"sss",$email,$username,$hashPassword);
    mysqli_stmt_execute($Statement);

    //Close connection
    mysqli_stmt_close($Statement);
    mysqli_close($connection);

    //Create folder for user
    $folderPath = "../FileStorage/" .$username;
    mkdir($folderPath);

    echo 'Valid';
    // header("Location: ../index.php");
    // exit();
  }

  onRegisterClick();
   if( isset($_POST['register-button']))
  {
    // onRegisterClick();
  }
  else
  {
    // header("Location: ../register.php");
    // exit();
  }

 ?>
