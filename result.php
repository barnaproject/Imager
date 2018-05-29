<?php
require_once('Imager.php');

$image = new Imager();

if(isset($_POST['url']))
  $url = $_POST['url'];

if(isset($_POST['imgs']))
  $image->download_images($_POST['imgs']);
?>
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

	<div class="loader">
      <img src="assets/images/loader.gif">
    </div>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php"><b>Imager</b> Scraper</a>
        </div>
      </div>
    </div>
	
	<div class="container results-container" style="opacity: 0">
		<div class="row mt centered">
			<h1>Results <small class="num_results"></small></h1>
			<h3><b>url:</b> <a href="<?php echo $url; ?>" target="_blank"><?php echo $image->short_url($url); ?> <span class="glyphicon glyphicon-new-window"></span></a></h3>
			<div id="results">
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th><span class="glyphicon glyphicon-search"></span></th>
                  <th>Width</th>
                  <th>Height</th>
                  <th>Extension</th>
                  <th>Image url</th>
                  <th>Preview</th>
                </tr>
              </thead>
              <tbody>
                <?php $image->get_images($url); ?>
              </tbody>
            </table>
          </div>
			</div>
      <div class="clear"></div>
		</div><!-- /row -->
		<hr>
		<div class="row centered">
			<div class="col-lg-6 col-lg-offset-3">
        <form id="download_images" class="form-inline" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="hidden-images"></div>
          <button type="submit" class="btn btn-primary btn-lg" style="display:none"><span class="glyphicon glyphicon-download"></span> Download all</button> <a href="index.php" class="btn btn-success btn-lg">Search New</a>
        </form>
			</div>
			<div class="col-lg-3"></div>
		</div><!-- /row -->
		<hr>
	</div><!-- /container -->
	
	<footer>
		<div class="container">
			<p class="centered"><?php echo date('Y') ?> <a href="index.php">Imager</a> | All right reserved</p>
		</div><!-- /container -->
	</footer>

  <?php require_once('includes/modal.php'); ?>

<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/lightbox.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>