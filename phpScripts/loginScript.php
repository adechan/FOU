<?php


  if(isset($_POST['login-button']))
  {
    require 'database.php';
    $username = $_POST['userLogin'];
    $password = $_POST['passLogin'];

    $sqlStatement = "SELECT * FROM Users WHERE username=?;";
    $Statement = mysqli_stmt_init($connection);

    //Check if statement works
    if(!mysqli_stmt_prepare($Statement,$sqlStatement))
    {
      header("Location: ../index.php?error=sqlError");
      exit();
    }

    mysqli_stmt_bind_param($Statement,"s",$username);
    mysqli_stmt_execute($Statement);

    $result = mysqli_stmt_get_result($Statement);

    //Store result in an array
    if($row = mysqli_fetch_assoc($result))
    {
      //Hash the password from input form and
      //check it against the one in DB
      $checkPassword = password_verify($password, $row['pass']);
      if($checkPassword==false)
      {
        header("Location: ../index.php?error=wrongPass");
        exit();
      }
      //passwords match, login user
      //Start session
      session_start();

      //Create session variables
      $_SESSION['ID']= $row['id'];
      $_SESSION['USERNAME']= $row['username'];

      header("Location: ../myAccountpage/index.php?loginSucces");
      exit();

    }
    else {
      header("Location: ../index.php?error=sqlError");
      exit();
    }//store result IF
  } // first IF (isset)
  else
  {
    header("Location: ../index.php");
    exit();
  }
?>
