<?php
  session_start();

  require 'database.php';
  // TODO: combine if unlink &mysqli clauses
// TODO: security
// TODO: delete dummy values

  //after pagination is done


  $fileId = mysqli_real_escape_string($connection, $_SESSION['FID']);
  $sql = "SELECT * FROM files where id = ? AND uploaded_by LIKE ?";

  $stmt = mysqli_stmt_init($connection);

  if (!mysqli_stmt_prepare($stmt,$sql))
  {
    header("Location: ../myAccountpage.php?error=sql");
    exit();
  }
  else
  {
    mysqli_stmt_bind_param($stmt,"is",$fileId,$_SESSION['USERNAME']);
    mysqli_stmt_execute($stmt);

  }
  $res = mysqli_stmt_get_result($stmt);
  if(mysqli_num_rows($res)==0)
  { echo '-rows';
    header('Location: ../myAccountpage/index.php?error=noAccess');
    exit();
  }
  $row = mysqli_fetch_assoc($res);

  $fileExtension = $row['TYPE'];

  if($row['uploaded_by']==$row['location'])
  {
    $isPrivate=true;
    $deletePath = '../FileStorage/'. $row['uploaded_by'] .'/'.$row['NAME'] . '.' . $row['TYPE'];
    echo $deletePath;

  }
  else
  {
    $isPrivate=false;
    $deletePath = '../FileStorage/PUBLIC_FILES/'.$row['NAME'] . '.'. $row['TYPE'];
    echo $deletePath;
  }


  //prepare sql
  $sql = "DELETE FROM files WHERE id=? AND uploaded_by LIKE ?;";
  $stmt = mysqli_stmt_init($connection);

  if(!mysqli_stmt_prepare($stmt,$sql))
  {
    echo '  error sql ';
    exit();
  }
  else // delete from database
  {
    mysqli_stmt_bind_param($stmt,"is",$fileId,$_SESSION['USERNAME']);
    mysqli_stmt_execute($stmt);
    echo 'delete succes'."\n";
  }

//delete from fileSystem
  if(!unlink($deletePath))
  {
    header('Location: ../myAccountpage/index.php?error=deleteError');
    exit();
  }
  else {
    echo 'delete succes';
  }

  echo $deletePath;


 ?>
