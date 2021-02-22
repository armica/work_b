<?php
	libxml_disable_entity_loader(false);
        libxml_use_internal_errors(true);
	
	if(isset($_POST["url"]) && !(empty($_POST["url"]))) {
                $url = $_POST["url"];

                try{
                        $ch = curl_init("$url");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0);
                        $inject = curl_exec( $ch );
                        curl_close($ch);

                        $string = simplexml_load_string($inject, 'SimpleXMLElement', LIBXML_NOENT);
			echo $string;
			if(!is_object($string)) throw new Exception("error");
                                foreach($string->channel->item as $row){
                                        //print htmlentities($row->title);
                                        echo "<script>alert('XML document is valid');location.href='../index.php';</script>";
				//	print htmlentities($row);
					
                                }
                }catch (Exception $e){
                                        echo "<script>alert('XML document is unvalid');location.href='../index.php';</script>";
        }
				
	}

?>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
        <ul class="nav navbar-nav">
            <li><a href="#">RSS Validity Checker :</a></li>
    		
        </ul>
        <form class="navbar-form navbar-left" role="search" action="common/navigation.php" method="post">
            <div class="form-group">
              <input type="text" name="url" class="form-control" placeholder="http://www.hani.com/rss/">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Link</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username'];?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="index.php?logout=1">Logout</a></li>
              </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
