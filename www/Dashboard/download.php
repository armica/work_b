<?php
	$file_name = $_REQUEST['filename'];
	$fileDir = "./uploads";
	$fullPath = $fileDir."/".$file_name;
	$length = filesize($fullPath);

	header("Content-Type: application/octet-stream");
	header("Content-Length: $length");
	header("Content-Disposition: attachment; filename=".iconv('utf-8','euc-kr',$file_name));
	header("Content-Transfer-Encoding: binary");

	$fh = fopen($fullPath, "r");
	fpassthru($fh);

	exit;
	header('location: index.php');
?>


