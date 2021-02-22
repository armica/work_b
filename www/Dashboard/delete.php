<?php include('config/config.php') ?>
<?php
   $filename = $_GET['filename'];
   $id = $_GET['id'];
   
   if (isset($filename, $id)) {
	$query = "delete from myrecords where id=$id";
    	mysqli_query($db, $query);
	
	$destination = '/var/www/html/Dashboard/uploads/';
	$rm_comm = "rm -f $destination$filename";
	$result = shell_exec($rm_comm);
	echo $result;
	echo "<script>alert('removed file');location.href='index.php';</script>";
	}
?>
