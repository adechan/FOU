<?php
session_start();
if(!isset($_SESSION['USERNAME']))
  header("Location: ../index.php?access=denied");

//clamav call
require 'database.php';


  if(isset($_POST['upload-button']))
  {
    $file = $_FILES['fileInput'];

    $fileName = $_FILES['fileInput']['name'];
    $fileSize = $_FILES['fileInput']['size'];
    $fileType = $_FILES['fileInput']['type'];
    $fileError = $_FILES['fileInput']['error'];
    $fileTempName = $_FILES['fileInput']['tmp_name'];
    $fileDescription = $_POST['descr'];
    $fileTags = $_POST['tags'];
    $isPublic = $_POST['isPublic'];


    //CHANGE SIZE TO READABLE
    if($fileSize < 1024){
      $readableSize=$fileSize;
      $readableSize=$readableSize . "B";
    }
    else if ($fileSize < 1048576){
      $readableSize = round(($fileSize / 1024),2);
      $readableSize = $readableSize . "kB";
    }
    else {
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

        //FILE IS PRIVATE
        if($isPublic=="private")
        {
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

        //insert into DB
        $sqlCommand = "INSERT INTO Files(NAME, description, location, size, TYPE, created_at_day,created_at_hour, uploaded_by)
        VALUES(?,?,?,?,?,?,?,?);";
        $sqlStatement = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($sqlStatement,$sqlCommand))
          {echo "Sql error insert file private"; exit();}
          else
          {
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
            {echo "Sql error insert tags failure private "; exit();}
            else
            {
            $sqlCount = "SELECT max(id) as max from files";
            $res = mysqli_query($connection,$sqlCount);
            $row = mysqli_fetch_assoc($res);
            $intResult = (int) $row['max'];
            echo "<h1> ". $intResult . "</h1>";
            foreach($fileTagsArray as $tag)
            {
              mysqli_query($connection,"INSERT INTO tags(id_file,name) VALUES($intResult,'$tag')");
            }
          }
            header('Location: ../addfilepage/index.php?upload=succes');
        }
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
                {echo "Sql error"; exit();}
                else
                {
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
                  {echo "Sql error insert tags failure public "; exit();}
                else
                {
                  $sqlCount = "SELECT max(id) as max from files";
                  $res = mysqli_query($connection,$sqlCount);
                  $row = mysqli_fetch_assoc($res);
                  $intResult = (int) $row['max'];
                  echo "<h1> ". $intResult . "</h1>";
                  foreach($fileTagsArray as $tag)
                  {
                    mysqli_query($connection,"INSERT INTO tags(id_file,name) VALUES($intResult,'$tag')");
                  }
                }

                header('Location: ../addfilepage/index.php?upload=succes');
                }
        }//else file is public
      }//filesize IF
      else
      {
          header('Location: ../addfilepage/index.php?error=fileToLarge');
      }
    }//fileError IF
    else
    {
        header('Location: ../addfilepage/index.php?error=upload');
    }
  }//isset IF

 ?>
