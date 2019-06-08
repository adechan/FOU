<?php
session_start();
require 'database.php';
  //escape string for safety
  $searchInput = mysqli_real_escape_string($connection,$_GET['searchString']);
  $keywords = explode(" ",$searchInput);
  $wordsToSearch="";
  $publicFiles='PUBLIC_FILES';
  //build tags string for sql query
  foreach ($keywords as $word){
    //$toSearch = $toSearch . "'". $word . "'" . ',';
    $wordsToSearch = $word . ',' . $wordsToSearch;
  }
  //delete last comma
  $wordsToSearch = substr($wordsToSearch,0,strlen($wordsToSearch)-1);
  $toSearch = $wordsToSearch;

  $sql = "SELECT DISTINCT * FROM files
          LEFT JOIN tags ON files.id = tags.id_file
          WHERE (FIND_IN_SET(tags.name,?)
          OR FIND_IN_SET(files.name,?)
          OR FIND_IN_SET(files.uploaded_by,?))
          AND (files.uploaded_by LIKE ? OR files.location LIKE ?)
          GROUP BY files.id";

  $stmt = mysqli_stmt_init($connection);

  if (!mysqli_stmt_prepare($stmt,$sql))
  {
    header("Location: ../myAccountpage/index.php?error=sql");
  }
  else
  {

    mysqli_stmt_bind_param($stmt,"sssss",$toSearch,$toSearch,$toSearch,$_SESSION['USERNAME'],$publicFiles);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    //pagination code
    $resultsPerPage =10;
$numOfResults = mysqli_num_rows($res);
  $numOfPages = ceil ($numOfResults/$resultsPerPage);
  if (!isset($_GET['page'])){
    $page = 1 ;
  }else{
    $page = $_GET['page'];
  }
  $startRow = ($page-1) * $resultsPerPage;
  $sql = $sql . " LIMIT " . $startRow . "," . $resultsPerPage;
  $stmt = mysqli_stmt_init($connection);
  if(!mysqli_stmt_prepare($stmt,$sql))
  {
    header("Location: index.php?error=sql");
  }
  else
  {
      mysqli_stmt_bind_param($stmt,"sssss",$toSearch,$toSearch,$toSearch,$_SESSION['USERNAME'],$publicFiles);
      mysqli_stmt_execute($stmt);
  }
  //pagination code done
  $res = mysqli_stmt_get_result($stmt);


    echo '			<table class="files">
            <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Author</th>
              <th>Program</th>
            </tr>';

    while($row =mysqli_fetch_assoc($res))
      {
        $fileID = $row['id'];

        echo '<tr>';
        echo '<td>' . '<a href="../filepage/index.php?fid=' . $fileID . '">' . $row['NAME'] . '</a>' . '</td>';
        echo '<td>' . $row['description']  . '</td>';
        echo '<td>' . $row['uploaded_by'] . '</td>';
        echo '<td>' . $row['TYPE'] . '</td>';
        echo '</tr>';
      }
    echo '</table>';
    echo '<div class="centerPagination">
            <div class="pagination">';
    for($pageCounter=1;$pageCounter<=$numOfPages;$pageCounter++)
      echo '<a href="index.php?page=' .$pageCounter . '">' . $pageCounter . '</a>';
    echo '</div>
           </div>';
}
 ?>
