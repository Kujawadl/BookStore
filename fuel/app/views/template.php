<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
  <?php echo Asset::css('bootstrap-theme.css'); ?>
  <?php echo Asset::css('site.css'); ?>

  <?php echo Asset::js('jquery-3.1.0.js'); ?>
  <?php echo Asset::js('bootstrap.js'); ?>
	<style>
		body { margin: 40px; }
	</style>
</head>
<body>
	<div class="container">
		<div class="col-md-12">
			<h1><?php echo $title; ?></h1>
<?php if (Session::get_flash('success')): ?>
			<div class="alert alert-success">
				<strong>Success</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
				</p>
			</div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
			<div class="alert alert-danger">
				<strong>Error</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
				</p>
			</div>
<?php endif; ?>
		</div>
		<div class="col-md-12">
      <?php echo $content; ?>
		</div>
		<footer>
      <div class="col-md-12">
      <hr />
  			<p>
  				Proudly powered by <a href="http://fuelphp.com">FuelPHP</a>, <a href="http://jquery.com/">jQuery</a>, and <a href="http://getbootstrap.com/">Bootstrap</a>.<br>
          <small>Licensed under <a href="/index/license"><span class='glyphicon glyphicon-globe'></span> GPL-3.0</a></small>
  			</p>
      </div>
		</footer>
	</div>
</body>
</html>
