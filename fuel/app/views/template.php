<?php
  if (!isset($title))
  {
    $title = "Book Store";
  }

  if (!isset($content))
  {
    $content = View::forge('error/501');
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<title>Book Store</title>
	<?php echo Asset::css('bootstrap.css'); ?>
  <?php echo Asset::css('bootstrap-theme.css'); ?>
  <?php echo Asset::css('sweetalert.css'); ?>
  <?php echo Asset::css('hljs.css'); ?>
  <?php echo Asset::css('site.css'); ?>

  <?php echo Asset::js('jquery-3.1.0.js'); ?>
  <?php echo Asset::js('bootstrap.js'); ?>
  <?php echo Asset::js('sweetalert.min.js'); ?>
  <?php echo Asset::js('jeditable.min.js'); ?>
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
			<h1><?php echo $title . "&emsp;" . (isset($subtitle) ? "<small>$subtitle</small>" : '');?></h1>
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
          <small>Thanks to <a href="http://t4t5.github.io/sweetalert/">SweetAlert</a> and <a href="https://highlightjs.org/">Highlight.js</a> as well.</small><br>
          <small>Licensed under <a href="/index/license"><span class='label label-default'><span class='glyphicon glyphicon-globe'></span> GPL-3.0</span></a></small>
  			</p>
      </div>
		</footer>
	</div>
</body>
</html>
