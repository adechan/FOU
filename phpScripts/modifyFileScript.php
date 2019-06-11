<?php
session_start();

require 'database.php';

if(isset($_GET['modify-button']))
{
  $fileId=$_SESSION['FID'];
  //get user input
  $fileName = $_GET['name'];
  $fileDescription=$_GET['description'];
  $fileTags = $_GET['tags'];

  $sql = "SELECT * from files WHERE id = ? AND uploaded_by like ? ";
  $stmt = mysqli_stmt_init($connection);

  if (!mysqli_stmt_prepare($stmt,$sql))
  {
    header("Location: ../filepage/modifyProperties.php?error=sql");
  }
  else
  {
    mysqli_stmt_bind_param($stmt,"is",$fileId,$_SESSION['USERNAME']);
    mysqli_stmt_execute($stmt);

    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);

    if(empty($row))
    {
      header("Location: ../myAccountpage/index.php?error=noSuchfileaa" . $fileId);
      exit();
    }
  }
//$row holds file information

if($row['location']==$row['uploaded_by']) //$isPrivate
{
  $fileLocation = '../FileStorage/' . $_SESSION['USERNAME'] . '/';
}
else //ispublic
{
  $fileLocation = '../FileStorage/PUBLIC_FILES/';
}

$fileNameModified=$fileName;
$fileExtension=$row['TYPE'];
$counter=1;

//rename if file another file with same name exists
while(file_exists($fileLocation . $fileNameModified . "." . $fileExtension))
{
  $fileNameModified = $fileName . "(" . $counter .")";
  $counter++;
}

//update row
$sql = "UPDATE files SET NAME= ?, description = ? WHERE id= ?";
$stmt = mysqli_stmt_init($connection);

if (!mysqli_stmt_prepare($stmt,$sql))
{
  header("Location: ../filepage/modifyProperties.php?error=sql");
  exit();
}
else
{
  mysqli_stmt_bind_param($stmt,"ssi",$fileName,$fileDescription,$fileId);
  mysqli_stmt_execute($stmt);

    $fullOldFileName = $fileLocation . $row['NAME'] .'.'. $row['TYPE'];
    $fullNewFileName = $fileLocation . $fileName . '.' . $row['TYPE'];

    //rename the file in storage
    if(!rename($fullOldFileName,$fullNewFileName))
      header('Location: ../myAccountpage/index.php?error=nofile');
      
    //delete Tags
    $sql = "DELETE FROM tags WHERE id_file = ?";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt,$sql))
    {
      header("Location: ../filepage/modifyProperties.php?error=sql");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt,"i",$fileId);
      mysqli_stmt_execute($stmt);
    }
    //add new tags into DB

    //delete whitespaces
    $fileTags = preg_replace('/\s+/', '', $fileTags);
    $fileTags = preg_replace('/"/','',$fileTags);
    $fileTags = preg_replace("/'/",'',$fileTags);
    //get tags as array
    $fileTagsArray = explode(",",$fileTags);

    foreach($fileTagsArray as $tag)
    {
      mysqli_query($connection,"INSERT INTO tags(id_file,name) VALUES($fileId,'$tag')");
    }

}
}

 ?>
