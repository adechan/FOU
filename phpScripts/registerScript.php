<?php
//if user got here by pressing the register button
  if( isset($_POST['register-button']))
  {
    require 'database.php';

    $username = $_POST['user'];
    $password = $_POST['pass'];
    $passwordConfirmation = $_POST['passConfirm'];
    $email = $_POST['email'];

    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
      header("Location: ../register.php?error=invalidmail");
      exit();
    }

    //PUBLIC_FILES is the storage for all files.
    //can't have a user with same name.
    if($username=="PUBLIC_FILES")
    {
      header("Location: ../registerpage/index.php?error=invalidUsername");

      exit();
    }

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
    $sqlStatement="SELECT * FROM users WHERE username=? OR email=?;";
    $Statement=mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($Statement,$sqlStatement))
    {
      header("Location: ../register.php?error=sqlError");
      exit();
    }

    mysqli_stmt_bind_param($Statement,"ss",$username,$email);
    mysqli_stmt_execute($Statement);
    mysqli_stmt_store_result($Statement);

    //get number of returned rows
    $result = mysqli_stmt_num_rows($Statement);

    //if > 0 another user exists.
    if($result>0)
    {
      header("Location: ../register.php?error=userOrEmailExists");
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

    mysqli_stmt_bind_param($Statement,"sss",$email,$username,$hashPassword);
    mysqli_stmt_execute($Statement);

    //Close connection
    mysqli_stmt_close($Statement);
    mysqli_close($connection);

    //Create folder for user
    $folderPath = "../FileStorage/" .$username;
    mkdir($folderPath);

    header("Location: ../index.php");
    exit();
  }
  else
  {
    header("Location: ../register.php");
    exit();
  }

 ?>
