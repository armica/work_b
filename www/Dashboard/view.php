<?php include('config/session.php') ?>
<?php include('config/config.php') ?>
<?php
   $id = $_GET['id'];
   $sql = 'select * from myrecord where id ='.$id;
   $result = mysqli_query($db, $sql);
   $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Home</title>
      <?php include('common/head.php') ?>
   </head>
   <body>
      <?php include('common/navigation.php') ?>
      <div class="container">
         <br />
         <div class="row">
            <div class="col-md-12 col-md-offset-0">
               <div class="panel panel-default panel-table">
                  <div class="panel-heading">
                     <div class="row">
                        <div class="col col-xs-6">
                           <h3 class="panel-title">View Records</h3>
                        </div>
                     </div>
                  </div>
		  <div class="card-body">
		 <form method="get">
        	<div class="form-group">
          	<label for="name">Name</label>
          	<input value="<?= $row['name']; ?>" type="text" name="name" id="name" class="form-control">
        	</div>
        	<div class="form-group">
          	<label for="name">Content</label>
         	 <input type="text" value="<?= $row['context']; ?>" name="context" id="context" class="form-control">
        	</div>
        	<div class="form-group">
          <button type="button" class="btn btn-info" onclick="location.href='./index.php'">Back</button>
        </div>
      </form>

                 <div class="panel-footer">
                     <div class="row">
                        <form method="post">
                        <div class="col col-xs-8">
                                <button type="submit" class="btn btn-primary" name="add_new">
                                         Add New Records
                                </button>
                        </div>
                        </form>
                     </div>
               </div>
               </div>
            </div>
         </div>
      </div>
      </div>
   </body>
</html>

