<?php
  //Set connection variables
  $servername="127.0.0.1";
  $databaseUser="root";
  $databasePass="";
  $databaseName="DatabaseFOU";

  $connection=mysqli_connect($servername,$databaseUser,$databasePass,$databaseName);

  //Check if connectino failed
  if(!$connection)
  {
    die("Unable to establish connection: ".mysqli_connect_error());
  }

 ?>
