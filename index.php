<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="assets/images/favicon.png" sizes="32x32">
<title>Imager Scraper</title>
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/lightbox.css" rel="stylesheet">
<link href="assets/css/main.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
</head>

<body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php"><b>Imager</b> Scraper</a>
        </div>
      </div>
    </div>

	<div id="headerwrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h1>Download images<br/>
					from website</h1>
          			<h2>Type wesite url on input</h2>
					<form class="form-inline" id="search-images" role="form" method="post" action="result.php">
					  <div class="form-group form-search">
					    <input type="url" class="form-control" name="url" placeholder="http://" required autofocus autocomplete="off">
					  </div>
					  <button type="submit" class="btn btn-default btn-lg">
					  	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					  </button>
					</form>					
				</div><!-- /col-lg-6 -->
				<div class="col-lg-6">
					<img class="img-responsive" src="assets/images/ipad-hand.png" alt="">
				</div><!-- /col-lg-6 -->
				
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /headerwrap -->
	
	<footer>
		<div class="container">
			<p class="centered"><?php echo date('Y') ?> <a href="index.php">Imager</a> | All right reserved</p>
		</div><!-- /container -->
	</footer>

<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/lightbox.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>