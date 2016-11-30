<?php
  if (!isset($title))
  {
    $title = "Book Store";
  }

  if (!isset($content))
  {
    $content = '
      <div class="jumbotron">
        <h1>Error 501: <small>There\'s nothing here...</small></h1>
        <p>Sorry, but it looks like we haven\'t gotten around to implementing this part of the site just yet. Check back at a later time.</p>
      </div>
    ';
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
  <?php echo Asset::css('bootstrap-theme.css'); ?>
  <?php echo Asset::css('sweetalert.css'); ?>
  <?php echo Asset::css('site.css'); ?>

  <?php echo Asset::js('jquery-3.1.0.js'); ?>
  <?php echo Asset::js('bootstrap.js'); ?>
  <?php echo Asset::js('sweetalert.min.js'); ?>
  <?php echo Asset::js('site.js'); ?>

  <!-- iOS homescreen icon -->
  <link rel="apple-touch-icon-precomposed" href="<?php echo(Asset::get_file('Book Shelf-96.png', 'img')); ?>">

  <!-- Windows 10 metro tile icon -->
  <meta name="msapplication-TileColor" content="#FFFFFF">
  <meta name="msapplication-TileImage" content="<?php echo(Asset::get_file('Book Shelf-96.png', 'img')); ?>">

  <!-- Android homescreen icon -->
  <link rel="shortcut icon" sizes="96x96" href="<?php echo(Asset::get_file('Book Shelf-96.png', 'img')); ?>">

	<style>
		body { margin: 40px; }
	</style>
</head>
<body>
  <?php echo render('navbar'); ?>
	<div class="container">
		<div class="col-md-12">
			<h1><?php echo $title; ?></h1>
      <?php echo View::forge('flash'); ?>
		</div>
		<div class="col-md-12">
      <?php echo $content; ?>
		</div>
		<footer>
      <div class="col-md-12">
      <hr />
  			<p>
  				Proudly powered by <a href="http://fuelphp.com">FuelPHP</a>, <a href="http://jquery.com/">jQuery</a>, and <a href="http://getbootstrap.com/">Bootstrap</a>.<br>
          <small>Icons provided by <a href="http://icons8.com">Icons8</a> and <a href="http://glyphicons.com">Glyphicons</a>.</small><br>
          <small>Licensed under <a href="/index/license"><span class='label label-default'><span class='glyphicon glyphicon-globe'></span> GPL-3.0</span></a></small>
  			</p>
      </div>
		</footer>
	</div>
</body>
</html>
