<?php
  session_start();
  require 'database.php';
  $fileId = $_GET['fid'];
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
   }

   $filePath='../FileStorage/' . $row['location'] .'/';
   $fileName = $filePath . $fileName = $row['NAME'] .'.'.$row['TYPE'];

    $contentType = mime_content_type ( $fileName);

header('Content-Description: File Transfer');
header('Content-Type:'. $contentType);
header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($fileName));

readfile ($fileName);
exit();
 ?>
