<?php include('config/session.php') ?>
<?php include('config/config.php') ?>
<?php 
   $result = $db->query("select * from myrecords");
   $total_records=$result->num_rows;
   
   function postPopup(){
	echo "<script>window.open('add.php', 'Add new record', 'width=400, height=400');</script>";
   }
   if(array_key_exists('add_new', $_POST)){
	postPopup();
   }

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
                           <h3 class="panel-title">Exisiting <?=$total_records;?> Records</h3>
                        </div>
                     </div>
                  </div>
                  <div class="panel-body">
                     <table class="table table-striped table-bordered table-list">
                        <thead>
                           <tr>
                              <th class="hidden-xs">ID</th>
                              <th>Name</th>
                              <th>File</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
			<?php
			      $sel_query="Select * from myrecords order by id asc";
                              $result = mysqli_query($db,$sel_query);
                              while($row = mysqli_fetch_assoc($result)) { ?>
                           <tr>
                              <td class="hidden-xs"><?=$row["id"];?></td>
                              <td><?=$row["name"];?></td>
			      <td><a href="download.php?filename=<?=$row["file"];?>"><?=$row["file"];?></a></td> 
                              <!--<td class="text-right"><a onclick="confirm('Are you sure?')" href="?delete=<?=$row["id"];?>"> <i class="fa fa-trash"></i></a></td>-->
                              <td class="text-right"><a onclick="confirm('Are you sure?')" href="delete.php?id=<?=$row["id"];?>&filename=<?=$row["file"];?>"> <i class="fa fa-trash"></i></a></td>
                           </tr>
			<?php } ?>
                        </tbody>
                     </table>
                  </div>
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
