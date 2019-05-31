<?php
session_start();

//NOT DONE

require 'database.php';

if(isset($_GET['modify-button']))
{
  //get user input
  //change
  $fileName = $_GET['name'];
  $fileDescription=$_GET['description'];
  $fileTags = $_GET['tags'];
  $username = $_SESSION['USERNAME'];

  //check if name already exists
  $sql = "SELECT * from files where name like ? AND uploaded_by like ?";
  $stmt = mysqli_stmt_init($connection);

  if (!mysqli_stmt_prepare($stmt,$sql))
  {
    header("Location: ../filepage/modifyProperties.php?error=sql");
  }
  else
  {
    //in loc de 'index' pune $fileName
    $dummy = 'cygwin';
    mysqli_stmt_bind_param($stmt,"ss",$dummy,$username);
    mysqli_stmt_execute($stmt);

    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    $oldName = $row['NAME'];
    $fileExtension = $row ['TYPE'];
    $fileNameModified = $fileName;

  }


if($row['location']==$row['uploaded_by']) //$isPrivate
{
  echo 'IS PRIVATE' . "<BR>";
  $counter=1;
  while(file_exists("../FileStorage/" . $_SESSION['USERNAME'] . "/" . $fileNameModified . "." . $fileExtension))
  {
    $fileNameModified = $fileName . "(" . $counter .")";
    $counter++;
  }
  echo 'MODIFIED= '.   $fileNameModified;
}
else //ispublic
{
  echo "ELSE <BR>";
  $counter=1;
  while(file_exists("../FileStorage/" . "PUBLIC_FILES" . "/" . $fileNameModified . "." . $fileExtension))
  {
    $fileNameModified = $fileName . "(" . $counter .")";
    $counter++;
  }
  echo $fileNameModified;
}
    // echo $oldName;
    // //CHANGE like 'index' to $oldName
    // $sql = "UPDATE files SET name = '$fileName', description='$fileDescription', tags='$fileTags' WHERE name like 'index' ";
    //
    //
    //
    // echo $fileName . $fileDescription . $fileTags;
    // $sql = "UPDATE files SET name = '$fileName', description='$fileDescription', tags='$fileTags' WHERE name like '$oldName' ";
    // mysqli_query($connection, $sql);
    // echo 'done';


  }


 ?>
