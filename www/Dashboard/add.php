<?php include('config/session.php') ?>
<?php include('config/config.php') ?>
<!DOCTYPE html>
<html>
   <head>
      <?php include('common/head.php') ?>
   </head>
   <body>
      </br>
      <div class="container">
         <div class="row">
            <div class="col-md-4 col-md-offset-4">
               <div class="card">
                  <div class="card-header">Add New Records</div>
                  <div class="card-body">
                     <form action="filesLogic.php" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                           <label for="name" class="col-md-3 col-form-label text-right">Name</label>
                           <div class="col-md-9">
                              <input type="text" id="name" class="form-control" name="name" required>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="file" class="col-md-3 col-form-label text-right">File</label>
			   <div class="col-md-9">
                              <input type="file" id="file" class="form-control" name="file" required>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-12 text-right">
                              <button type="submit" class="btn btn-primary" name="add_new" >
                              Add New Records
                              </button>
                           </div>
                        </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
	</body>
</html>
