<?php

require 'database.php';

  $resultsPerPage =10;
  $location = 'PUBLIC_FILES';

  $sql = "SELECT * FROM files WHERE location LIKE ?";
  $stmt = mysqli_stmt_init($connection);
  if(!mysqli_stmt_prepare($stmt,$sql))
  {
    header("Location: index.php?error=sql");
  }
  else
  {
      mysqli_stmt_bind_param($stmt,"s",$location);
      mysqli_stmt_execute($stmt);
  }


  $res = mysqli_stmt_get_result($stmt);
  $numOfResults = mysqli_num_rows($res);

  $numOfPages = ceil ($numOfResults/$resultsPerPage);

  //get the page the user is on
  if (!isset($_GET['page'])){
    $page = 1 ;
  }else{
    $page = $_GET['page'];
  }
  //get the interval of rows to show to user
  $startRow = ($page-1) * $resultsPerPage;

  $sql = "SELECT * FROM files WHERE location LIKE ? LIMIT " . $startRow . "," . $resultsPerPage;
  $stmt = mysqli_stmt_init($connection);

  if(!mysqli_stmt_prepare($stmt,$sql))
  {
    header("Location: index.php?error=sql");
  }
  else
  {
      mysqli_stmt_bind_param($stmt,"s",$location);
      mysqli_stmt_execute($stmt);
  }

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

  //print pages buttons
  echo '<div class="centerPagination">
          <div class="pagination">';
          
  for($pageCounter=1; $pageCounter<=$numOfPages; $pageCounter++)
    echo '<a href="index.php?page=' .$pageCounter . '">' . $pageCounter . '</a>';
  echo '</div>
  			 </div>';

 ?>
