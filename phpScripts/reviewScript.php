<?php
  require 'database.php';

  $email = $_POST['Email'];
  $message = $_POST['review'];
  echo $email . $message;
  $sql = "INSERT INTO reviews(email,message) VALUES (?,?)";
  $stmt = mysqli_stmt_init($connection);
  if(!mysqli_stmt_prepare($stmt,$sql))
  {
    header("Location: index.php?error=sql");
  }

  else
  {
      mysqli_stmt_bind_param($stmt,"ss",$email,$message);
      mysqli_stmt_execute($stmt);
      header('Location: ../contactpage/index.php?message=sent');
  }
 ?>
