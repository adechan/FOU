<?php
  session_start();

  require 'database.php';
  // TODO: combine if unlink &mysqli clauses
// TODO: security
// TODO: delete dummy values

  //will get from POST method
  //after pagination is done
  $fileName = 'FEAF';
  $fileExtension = 'txt';
  $isPrivate=false;
  $rootStorage= '../FileStorage';
  $user = $_SESSION['USERNAME'];

  //prepare location string
  if($isPrivate)
  {$deletePath=$rootStorage . '/'. $_SESSION['USERNAME']. '/' . $fileName . '.' . $fileExtension;}
  else {$deletePath = $rootStorage . '/' . 'PUBLIC_FILES' . '/' . $fileName . '.' . $fileExtension;}

  //check for permission
  $sql2 ="SELECT * FROM files WHERE name LIKE '$fileName' AND TYPE LIKE '$fileExtension' AND uploaded_by LIKE '$user'";
  $result =mysqli_query($connection,$sql2);

  if(mysqli_num_rows($result)==0)
  {
    echo ' bastard you have no acces';
    header('Location: ../filepage/delete.php?access=denied');
    exit();
  }
  else
  {
  //prepare sql
  $sql = "DELETE FROM files WHERE NAME LIKE ? AND TYPE LIKE ? AND uploaded_by LIKE ?;";
  $stmt = mysqli_stmt_init($connection);

  if(!mysqli_stmt_prepare($stmt,$sql))
  {
    echo '  error sql ';
    exit();
  }
  else // delete from database
  {
    mysqli_stmt_bind_param($stmt,"sss",$fileName,$fileExtension,$_SESSION['USERNAME']);
    mysqli_stmt_execute($stmt);
    echo 'delete succes'."\n";
  }

//delete from fileSystem
  if(!unlink($deletePath))
  {
    header('Location: ../filepage/delete.php?deleteError');
    exit();
  }
  else {
    echo 'delete succes';
  }

  echo $deletePath;
  }

 ?>
