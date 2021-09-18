<?php include('config/config.php') ?>
<?php
// LOGIN USER
if (isset($_POST['login_user'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	if (count($errors) == 0) {
		$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
		echo $query;	
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_array($result);

		if(mysqli_num_rows($result) == 1){
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			echo "<script>location.href='index.php';</script>";
		}
		else{
			echo "<script>window.alert('Wrong username/password combination')</script>";
		}/*	
		if($result->num_rows != 0){
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if($row){
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}
		}
		else {
			array_push($errors, "Wrong username/password combination");
		}
		 */
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">

    <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style type="text/css">
        </style>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
   
</head>
<body>
      

    <br />
	
	
    
    <div class="container" style="margin-top:50px">

            <div class="col-md-4">

                </div>
<div class="col-md-4">
        
    <div class="panel panel-info">
  <div class="panel-heading"><h3 class="panel-title"><strong>Client Sign In </strong></h3></div>
  <div class="panel-body">
  <form method="post" action="">

 <?php include('config/errors.php'); ?>
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name="username" class="form-control"  placeholder="Enter username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password </label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button type="submit" name="login_user" class="btn btn-sm btn-primary">Sign in</button>
  <button type="button" name="sign_user" class="btn btn-sm btn-primary" onclick="location.href='register.php'">Sign up</button>
</form>
  </div>
</div>
</div>
<div class="col-md-4">

</div>
<br>

</div>
	<script type="text/javascript">
		</script>
</body>
</html>
