<?php 
	include('config/session.php');
   	include('config/config.php'); 
 	function postPopup(){
                echo "<script>window.open('add.php', 'Add new record', 'width=400, height=400');</script>";
        }
        if(array_key_exists('add_new', $_POST)){
                postPopup();
        }

	
	if(isset($_GET["page"])){
		$page = $_GET["page"];
	} else{
		$page = 1;
	}

	$result = $db->query("select * from myrecords");
        $row_num = mysqli_num_rows($result); 
        $list = 5;
        $block_ct = 5;

        $block_num = ceil($page/$block_ct); 
        $block_start = (($block_num - 1) * $block_ct) + 1;
        $block_end = $block_start + $block_ct - 1;

        $total_page = ceil($row_num / $list); 
        if($block_end > $total_page) $block_end = $total_page; 
        $total_block = ceil($total_page/$block_ct);
        $start_num = ($page-1) * $list; 

	$result2 = $db->query("select * from myrecords order by id asc limit $start_num, $list"); 
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

	<div class="form-row float-right">
	<table class="table table-striped footable footable-1 footable-filtering footable-filtering-right footable-paging footable-paging-center breakpoint-lg" style="display: table;">
	<thead>
	 <tr class="footable-filtering">
	  <th colspan="7">
	   <form class="form-inline">
	    <div class="form-group footable-filtering-search">
	     <label class="sr-only">Search</label>
		<div class="form-row float-left">
                 <form class="navbar-form" role="search" action="common/navigation.php" method="post">
                 <div class="form-group">
                 <input type="text" name="url" class="form-control" placeholder="Search text">
                 </div>
                 <button type="submit" class="btn btn-default">SEARCH</button>
		 </form></div>
		 <form method="post">
                        <div class="col col-xs-8">
                                <button type="submit" class="btn btn-primary" name="add_new">
                                         Add New Records
                                </button>
                        </div>
                        </form>

	     </div>

	    </div>
	   </form>
	</th>
	</tr>
	</div>



		     <div class="panel-body">
                     <table class="table table-striped table-bordered table-list">
                        <thead>
                           <tr>
                              <th class="col-xs-1"><center>ID</center></th>
                              <th class="col-xs-2"><center>Name</center></th>
                              <th class="col-xs-5"><center>Memo</center></th>
                              <th class="col-xs-2"><center>File</center></th>
                              <th class="col-xs-2"><center>Date</center></th>
			      <th class="col-xs-2"><center>ActionM</center></th>
                           </tr>
                        </thead>
			<tbody>
			<?php
			   while($board = $result2->fetch_array()){ ?>
                           <tr>
                              <td class="hidden-xs"><center><?=$board["id"];?></center></td>
			      <td><?=$board["name"];?></td>
			      <td><?=$board["title"];?></td>
                              <td><a href="download.php?filename=<?=$board["file"];?>"><?=$board["file"];?></a></td> 
                              <td><center><?=$board["date"];?></center></td>
                              <!--<td class="text-right"><a onclick="confirm('Are you sure?')" href="?delete=<?=$row["id"];?>"> <i class="fa fa-trash"></i></a></td>-->
                              <td><center><a onclick="confirm('Are you sure?')" href="delete.php?id=<?=$board["id"];?>&filename=<?=$board["file"];?>"> <i class="fa fa-trash"></i></a></center></td>
                           </tr>
                        <?php } ?>
                        </tbody>
		     </table>
	<div class="text-center">
	<ul class="pagination">
<?php
	if($page <= 1){
		echo "<li><span><<</span></li>";
	}else{
            	echo "<li><a href='?page=1'><span><<</span></a></li>";
	}		
	for($i=$block_start; $i<=$block_end; $i++){
		if($page == $i){
			echo "<li><a href='#'>$i</a></li>";
		}else{
			echo "<li><a href='?page=$i'>$i</a></li>"; 
		}
	}
	if($page <= 1)
        {
        }else{
                $pre = $page-1;
		echo "<li><a href='?page=$pre'><span><</span></a></li>";
        }

	if($block_num >= $total_block){ 
        }else{
		$next = $page + 1;
            	echo "<li><a href='?page=$next'>></a></li>";
	}
        if($page >= $total_page){ 
		echo "<li><span>>></span></li>";
        }else{
		echo "<li><a href='?page=$total_page'><span>>></span></a></li>";
	}
?>
</ul></div>
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

