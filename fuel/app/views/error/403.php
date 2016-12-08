<?php
$WAT = array(
  'WAT1.jpg',
  'WAT2.jpg',
  'WAT3.jpg',
  'WAT4.jpg',
  'WAT5.jpg',
  'WAT6.jpg',
)
?>

<div class="jumbotron">
  <h1>Error 403: <small>Forbidden</small></h1>
  <p>Evidently, you aren't allowed to view this page... Bummer...</p>
  <?php echo Asset::img($WAT[array_rand($WAT)], array('class' => 'img-thumbnail img-responsive')) ?>
</div>
