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
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<!--<link rel="icon" href="../../favicon.ico">-->

	<title>FooTable - A jQuery Responsive Table</title>

	<!-- Bootstrap core CSS -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" rel="stylesheet">

	<!-- FooTable Bootstrap CSS -->
	<link href="compiled/footable.bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="docs/css/docs.css" rel="stylesheet">

	<script src="docs/js/demo-rows.js"></script>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand active">FooTable</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="docs/getting-started.html">Getting started</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Components <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="docs/components/editing.html">Editing</a></li>
						<li><a href="docs/components/filtering.html">Filtering</a></li>
						<li><a href="docs/components/paging.html">Paging</a></li>
						<li><a href="docs/components/sorting.html">Sorting</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			 <li><a href="#">Link</a></li>
            		 <li class="dropdown">
              		   <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username'];?> <span class="caret"></span></a>
              		<ul class="dropdown-menu" role="menu">
                	 <li><a href="index.php?logout=1">Logout</a></li>
              	 	</ul>
            		 </li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>


<!-- Main component for a primary marketing message or call to action -->

</div>

<div class="container">



<table class="table table-striped footable footable-1 footable-filtering footable-filtering-right footable-paging footable-paging-center breakpoint-lg" style="display: table;">

<thead>
<tr class="footable-filtering"><th colspan="7">
<form class="form-inline">
<div class="form-group footable-filtering-search">
<label class="sr-only">Search</label><div class="input-group">
<input type="text" class="form-control" placeholder="Search">
<div class="input-group-btn">
<button type="button" class="btn btn-primary"><span class="fooicon fooicon-search"></span></button>
<button type="button" class="btn btn-default dropdown-toggle"><span class="caret"></span></button>
</div></div></div>
</form>
</th>
</tr>

<tr class="footable-header">
<th class="footable-sortable footable-first-visible" style="width: 80px; max-width: 80px; display: table-cell;"><center>ID</center><span class="fooicon fooicon-sort"></span></th>
<th class="footable-sortable" style="display: table-cell;"></center>Name</center><span class="fooicon fooicon-sort"></span></th>
<th class="footable-sortable" style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; word-break: keep-all; white-space: nowrap; display: table-cell;"><center>Memo</center></th>
<th class="footable-sortable" style="display: table-cell;"><center>File</center></th>
<th class="footable-sortable" style="display: table-cell;"><center>Date</center><span class="fooicon fooicon-sort"></span></th>
</tr>
</thead>
<tbody>
<?php
	while($board = $result2->fetch_array()){ ?>
<tr>
<td class="footable-first-visible" style="width: 80px; max-width: 80px; display: table-cell;"><center><?=$board["id"];?></center></td>
<td style="display: table-cell;"><?=$board["name"];?></td>
<td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; word-break: keep-all; white-space: nowrap; display: table-cell;"><?=$board["title"];?></td>
<td style="display: table-cell;"><a href="download.php?filename=<?=$board["file"];?>"><?=$board["file"];?></a></td>
<td style="display: table-cell;"><?=$board["date"];?></td>
</tr>
<?php } ?>
</tbody></table>
<tfoot><tr class="footable-paging">
<td colspan="7">
<div class="footable-pagination-wrapper">
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


</ul>
<div class="divider"></div>
<span class="label label-default">1 of 1000</span></div></td></tr></tfoot>



</div> <!-- /container -->

<!-- Placed at the end of the document so the pages load faster -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="docs/js/ie10-viewport-bug-workaround.js"></script>
<!-- Add in any FooTable dependencies we may need -->
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<!-- Add in FooTable itself -->
<script src="compiled/footable.js"></script>
<!-- Initialize FooTable -->
<script>
</script>
</body>
</html>
