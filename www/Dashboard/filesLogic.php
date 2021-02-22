<?php include('config/config.php') ?>
<?php

	$query = "SELECT * FROM myrecords";
	$result = mysqli_query($db, $query);
	$files = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	// Uploads files
	if (isset($_POST['add_new'])) { // if save button on the form is clicked
   	
	$name = $_POST['name'];
 
	// name of the uploaded file
	$filename = $_FILES['file']['name'];
	
	// destination of the file on the server
	$destination = 'uploads/' . $filename;

    	// get the file extension
    	$extension = pathinfo($filename, PATHINFO_EXTENSION);

    	// the physical file on a temporary uploads directory on the server
    	$file = $_FILES['file']['tmp_name'];
    	$size = $_FILES['file']['size'];

	if ($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        	echo "File too large!";
    	} else {
        	if (move_uploaded_file($file, $destination)) {
            		$query = "INSERT INTO myrecords (name, file, size, downloads) VALUES ('$name', '$filename', $size, 0)";
            		if (mysqli_query($db, $query)) {
				echo "<script>alert('Successd to upload file');</script>";
				echo "<script>opener.location.href='index.php';</script>";
				echo "<script>self.close();</script>";
            		}
        	} else {
			 echo "<script>alert('Failed to upload file');location.href='add.php';</script>";
        	}
    	}
	}

// Downloads files
if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];

    // fetch file to download from database
    $query = "SELECT * FROM myrecoreds WHERE file=$filename";
    $result = mysqli_query($db, $query);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['name']));
        
        //This part of code prevents files from being corrupted after download
        ob_clean();
        flush();
        
        readfile('uploads/' . $file['name']);

        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE files SET downloads=$newCount WHERE id=$id";
        mysqli_query($db, $updateQuery);
        exit;
    }

}
