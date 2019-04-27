<?php
//if user got here by pressing the register button
  if( isset($_POST['register-button']))
  {
    // TODO: Add email to registration form
    // TODO: check email is correct
    // TODO:  check if mail exists in database
    // TODO: DELETE dummy $email


    require 'database.php';

    $username = $_POST['user'];
    $password = $_POST['pass'];
    $passwordConfirmation = $_POST['passConfirm'];

    //Check if email is valid
    /*
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
      header("Location: ../register.php?error=invalidmail");
      exit();
    }
    */
    //Check username for special characters
    $pattern = "/[a-zA-Z_0-9]*/";
    if(!preg_match($pattern,$username))
    {
      header("Location: ../registerpage/index.php?error=invalidUser");
      exit();
    }

    //Check if passwords match
    if($password!==$passwordConfirmation)
    {
      header("Location: ../register.php?error=passCheck");
      exit();
    }

    //Strong password
    if (!preg_match('/[\!\@\#\$\%\^\&\*\(\)\_\-\+\=\[\]\,\.\<\>]/', $password))
    {
      header("Location: ../register.php?error=weakPass");
      exit();
    }
    if(strlen($password)<6 || strlen($password)>32)
    {
      header("Location: ../register.php?error=passLength");
      exit();
    }

    //If all ok
    $sqlStatement="SELECT * FROM users WHERE username=?;";
    $Statement=mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($Statement,$sqlStatement))
    {
      header("Location: ../register.php?error=sqlError");
      exit();
    }

    mysqli_stmt_bind_param($Statement,"s",$username);
    mysqli_stmt_execute($Statement);
    mysqli_stmt_store_result($Statement);

    //get number of returned rows
    $result=1;
    $result = mysqli_stmt_num_rows($Statement);

    //if > 0 another user exists.
    if($result>0)
    {
      header("Location: ../register.php?error=userExists");
      exit();
    }

    //Code executes only if there were no errors previously
    $sqlStatement="INSERT INTO Users(email, username, pass) VALUES(?, ?, ?);";
    $Statement=mysqli_stmt_init($connection);

    if(!mysqli_stmt_prepare($Statement,$sqlStatement))
    {
      header("Location: ../register.php?error=sqlError");
      exit();
    }

    //Hash password using default algorithm(bCrypt)
    $hashPassword = password_hash($password,PASSWORD_DEFAULT);

    $email=$username."@gmail.com";

    mysqli_stmt_bind_param($Statement,"sss",$email,$username,$hashPassword);
    mysqli_stmt_execute($Statement);

    echo $username . $email . $hashPassword . "\n\n".$result;
//    header("Location: ../myAccountpage/index.php");

    //Close connection
    mysqli_stmt_close($Statement);
    mysqli_close($connection);

  }
  else
  {
    header("Location: ../register.php");
    exit();
  }

 ?>
