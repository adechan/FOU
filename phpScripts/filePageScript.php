<?php
require 'database.php';
  if(isset($_GET['fid']))
  {
    $fileId = $_GET['fid'];

    $sqlTags = "SELECT name from tags WHERE id_file = ". $fileId;
    $sqlRes = mysqli_query($connection,$sqlTags);
    $numberOfRows = mysqli_num_rows($sqlRes);

    $tagsToPrint = array();
    for($i=0; $i<$numberOfRows; $i++)
    {
    $row = mysqli_fetch_assoc($sqlRes);
    array_push($tagsToPrint,$row['name']);
  }


    $sql = "SELECT * FROM files WHERE id = ?
    AND (uploaded_by like ? OR location like 'PUBLIC_FILES')";

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
         header("Location: ../myAccountpage/index.php?noSuchfile");
       }
       else //only one row can be returned, print values
       {
         echo '<table class="detailsFile"> ';
         echo '<tr>';
         echo '<th>' . 'Name'. '</th>';
         echo '<td>' . $row['NAME'] . '</td>';
         echo '</tr>';

         echo '<tr>';
         echo '<th>' . 'Author'. '</th>';
         echo '<td>' . $row['uploaded_by'] . '</td>';
         echo '</tr>';

         echo '<tr>';
         echo '<th>' . 'Type Of File'. '</th>';
         echo '<td>' . $row['TYPE'] . '</td>';
         echo '</tr>';

         echo '<tr>';
         echo '<th>' . 'Description'. '</th>';
         echo '<td>' . $row['description'] . '</td>';
         echo '</tr>';

         echo '<tr>';
         echo '<th>' . 'Tags'. '</th>';
         echo '<td>';
         if(!empty($tagsToPrint))
          foreach ( $tagsToPrint as $tag)
            echo $tag . ", ";
         echo '</td>';
         echo '</tr>';

         echo '<tr>';
         echo '<th>' . 'Uploaded On'. '</th>';
         echo '<td>' . $row['created_at_day'] . '</td>';
         echo '</tr>';


         echo '</table>';
       }
     }


  }
 ?>
