<?php
session_start();
require 'database.php';
  //escape string for safety
  $searchInput = mysqli_real_escape_string($connection,$_GET['searchString']);
  $keywords = explode(" ",$searchInput);
  $toSearch="";
  //build string for sql query
  foreach ($keywords as $word){
    $toSearch = $word . ',' . $toSearch;
  }
  $toSearch = substr($toSearch,0,strlen($toSearch)-1);
  $toSearch = '"' . $toSearch. '"';
  echo $toSearch;

  $sql = "SELECT * FROM files WHERE "

 ?>
