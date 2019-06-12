<?php
  session_start();
  if(!isset($_SESSION['USERNAME']))
    header("Location: ../index.php?access=denied");

  //clamav call
  require 'database.php';

  function outputError($error, $type)
  {
    echo 'Error: ' . json_encode(array(
      'type' => $type,
      'message' => $error
    ));

    exit();
  }

  var_dump($_FILES);

  $file = $_FILES['fileInput'];

  $fileName = $_FILES['fileInput']['name'];
  $fileSize = $_FILES['fileInput']['size'];
  $fileType = $_FILES['fileInput']['type'];
  $fileError = $_FILES['fileInput']['error'];
  $fileTempName = $_FILES['fileInput']['tmp_name'];
  $fileDescription = $_POST['descr'];
  $fileTags = $_POST['tags'];
  $isPublic = $_POST['isPublic'];

  echo 'File size = ' . $fileSize;

  if ($fileSize == 0)
    outputError('Unable to upload file', 'file');

  //CHANGE SIZE TO READABLE
  if($fileSize < 1024)
  {
    $readableSize=$fileSize;
    $readableSize=$readableSize . "B";
  }
  else if ($fileSize < 1048576)
  {
    $readableSize = round(($fileSize / 1024),2);
    $readableSize = $readableSize . "kB";
  }
  else 
  {
    $readableSize = round(($fileSize /1048576),2); //double chec
    $readableSize= $readableSize . "MB";
  }

  //delete whitespaces
  $fileTags = preg_replace('/\s+/', '', $fileTags);
  //get tags as array
  $fileTagsArray = explode(",",$fileTags);

  //Separate name of file by '.' to get the extension
  //explode returns an array
  $fileSeparatedArray = explode('.', $fileName);
  //get the actual extension
  $fileExtension = strtolower(end($fileSeparatedArray));
  //get filename with no extension
  $slicedArray = array_slice($fileSeparatedArray,0,-1,);
  $fileNameNoExtension = implode(".", $slicedArray);

  //potentially dangerous files
  $forbiddenFiles = array('zip','rar','bat','js','vbs','wsf','exe','com','msi','cmd');

  if(in_array($fileExtension,$forbiddenFiles))
    outputError('File type not allowed', 'file');

  if(!($fileError === 0))
    outputError('File error', 'file');

  //max 5MB allowed
  if($fileSize >= 5242880)
    outputError('File size must be smaller than 5MB', 'file');

  //FILE IS PRIVATE
  if($isPublic=="private")
  {
    //CHECK if file exists already
    //and rename
    $counter=1;
    $noExtensionVariable = $fileNameNoExtension;

    while(file_exists("../FileStorage/" . $_SESSION["USERNAME"] . "/" . $fileNameNoExtension . "." . $fileExtension))
    {
      $fileNameNoExtension = $noExtensionVariable . "(" . $counter .")";
      $counter++;
    }

    $fileFinalDestination = "../FileStorage/" . $_SESSION['USERNAME'] . "/" . $fileNameNoExtension . "." . $fileExtension;

    //actually upload file
    move_uploaded_file($fileTempName, $fileFinalDestination);

    //insert into DB
    $sqlCommand = "INSERT INTO Files(NAME, description, location, size, TYPE, created_at_day,created_at_hour, uploaded_by)
    VALUES(?,?,?,?,?,?,?,?);";
    
    $sqlStatement = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($sqlStatement,$sqlCommand))
      outputError("Sql Error insert file private", 'file');
      
    $currentDay=date("Y-m-d");
    $currentHour=date("H:i:s");
    $storageLocation =  $_SESSION['USERNAME'];

    mysqli_stmt_bind_param($sqlStatement,"ssssssss",$fileNameNoExtension,$fileDescription,$storageLocation,$readableSize,
    $fileExtension,$currentDay,$currentHour,$_SESSION['USERNAME']);
    mysqli_stmt_execute($sqlStatement);
    //insert tags into tags tags table

    $sqlCommand = "INSERT INTO tags(id_file,name) VALUES (?,?)";
    $sqlStatement = mysqli_stmt_init($connection);

    if(!mysqli_stmt_prepare($sqlStatement,$sqlCommand))
      outputError('Sql error insert tags failure private', 'file'); 

    $sqlCount = "SELECT max(id) as max from files";
    $res = mysqli_query($connection,$sqlCount);
    $row = mysqli_fetch_assoc($res);

    $intResult = (int) $row['max'];
    echo "<h1> ". $intResult . "</h1>";
    
    foreach($fileTagsArray as $tag)
      mysqli_query($connection,"INSERT INTO tags(id_file,name) VALUES($intResult,'$tag')");
  }// CLOSE IF (is private)

  else // file is public
  {
    //CHECK if file exists already
    //and rename
    $counter=1;
    $noExtensionVariable=$fileNameNoExtension;
    while(file_exists("../FileStorage/PUBLIC_FILES/" . $fileNameNoExtension . "." . $fileExtension))
    {
      $fileNameNoExtension = $noExtensionVariable . "(" . $counter .")";
      $counter++;
    }

    $fileFinalDestination = "../FileStorage/PUBLIC_FILES/" . $fileNameNoExtension . "." . $fileExtension;

    //actually upload file
    move_uploaded_file($fileTempName,$fileFinalDestination);

    //insert into DB
    $sqlCommand = "INSERT INTO Files(NAME, description, location, size, TYPE, created_at_day,created_at_hour, uploaded_by)
    VALUES(?,?,?,?,?,?,?,?);";
    $sqlStatement = mysqli_stmt_init($connection);

    if(!mysqli_stmt_prepare($sqlStatement,$sqlCommand))
      outputError('SQL Error', 'file');

    $currentDay=date("Y-m-d");
    $currentHour=date("H:i:s");
    $storageLocation = "PUBLIC_FILES";
    mysqli_stmt_bind_param($sqlStatement,"ssssssss",$fileNameNoExtension,$fileDescription,$storageLocation,$readableSize,
    $fileExtension,$currentDay,$currentHour,$_SESSION['USERNAME']);
    mysqli_stmt_execute($sqlStatement);

    //upload to Tags
    $sqlCommand = "INSERT INTO tags(id_file,name) VALUES (?,?)";
    $sqlStatement = mysqli_stmt_init($connection);

    if(!mysqli_stmt_prepare($sqlStatement,$sqlCommand))
      outputError('SQL Error while inserting tags for public upload');

    $sqlCount = "SELECT max(id) as max from files";
    $res = mysqli_query($connection,$sqlCount);
    $row = mysqli_fetch_assoc($res);
    $intResult = (int) $row['max'];
    echo "<h1> ". $intResult . "</h1>";
    foreach($fileTagsArray as $tag)
      mysqli_query($connection,"INSERT INTO tags(id_file,name) VALUES($intResult,'$tag')");

    echo 'Success';
  }//else file is public
 ?>
