<?php if (isset($Url) && isset($Value) && isset($Name)): ?>
<span
  class='edit'
  style='cursor: pointer;'
  action='<?php echo $Url; ?>'
  name='<?php echo $Name; ?>'
><?php echo $Value; ?></span>
<?php endif; ?>
