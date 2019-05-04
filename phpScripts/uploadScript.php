<?php
session_start();
if(!isset($_SESSION['USERNAME']))
  header("Location: ../index.php?access=denied");
// TODO: check for malware
// TODO: DELETE Dummydescription
// TODO: check errors again & change messages
// TODO: send message error or succes
// TODO: upload for PUBLIC files

require 'database.php';


  if(isset($_POST['upload-button']))
  {
    $file = $_FILES['fileInput'];

    $fileName = $_FILES['fileInput']['name'];
    $fileSize = $_FILES['fileInput']['size'];
    $fileType = $_FILES['fileInput']['type'];
    $fileError = $_FILES['fileInput']['error'];
    $fileTempName = $_FILES['fileInput']['tmp_name'];

    //Separate name of file by '.' to get the extension
    //explode returns an array
    $fileSeparatedArray = explode('.', $fileName);
    //get the actual extension
    $fileExtension = strtolower(end($fileSeparatedArray));

    //get filename with no extension
    $slicedArray = array_slice($fileSeparatedArray,0,-1,);
    $fileNameNoExtension = implode(".",$slicedArray);

    //potentially dangerous files
    $forbiddenFiles = array('zip','rar','bat','js','vbs','wsf','exe','com','msi','cmd');

    if(in_array($fileExtension,$forbiddenFiles))
    {
      echo 'Error: File type not allowed!';
      exit();
    }
    if($fileError ===0)
    {
      //max 5MB allowed
      if($fileSize <5242880 )
      {
        //upload
        //CHECK if file exists already
        //and rename
        $counter=1;
        $noExtensionVariable=$fileNameNoExtension;

        while(file_exists("../FileStorage/" . $_SESSION["USERNAME"] . "/" . $fileNameNoExtension . "." . $fileExtension))
        {
          $fileNameNoExtension = $noExtensionVariable . "(" . $counter .")";
          $counter++;
        }

        $fileFinalDestination = "../FileStorage/" . $_SESSION['USERNAME'] . "/" . $fileNameNoExtension . "." . $fileExtension;

        //actually upload file
        move_uploaded_file($fileTempName,$fileFinalDestination);

        $sqlCommand = "INSERT INTO Files(NAME, description, location, size, TYPE, created_at_day,created_at_hour, uploaded_by)
        VALUES(?,?,?,?,?,?,?,?);";

        $sqlStatement = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($sqlStatement,$sqlCommand))
          {echo "Sql error"; exit();}
          else
          {
            //dummy values . must change
            $dummyDescription = "This is a description";
            $dummySize = "1.35MB";

            $currentDay=date("Y-m-d");
            $currentHour=date("H:i:s");

            $storageLocation = "FileStorage/" . $_SESSION["USERNAME"] . "/";
          mysqli_stmt_bind_param($sqlStatement,"ssssssss",$fileNameNoExtension,$dummyDescription,$storageLocation,$dummySize,
          $fileExtension,$currentDay,$currentHour,$_SESSION['USERNAME']);

          mysqli_stmt_execute($sqlStatement);
          }
        echo "File uploaded succesfully" . "<br>";

        echo $fileFinalDestination . "\n" . $fileSize . "\n";

      }
      else
      {
          echo 'File is too large!';
      }
    }
    else
    {
        echo 'Error uploading file!';
    }
  }

 ?>
