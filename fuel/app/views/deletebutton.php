<?php if (isset($action) && isset($confirmation) && isset($redirect)): ?>
  <span
    class='delete glyphicon glyphicon-remove-sign glyphicon-delete'
    style='cursor: pointer;',
    action='<?php echo $action; ?>',
    confirmation='<?php echo $confirmation; ?>',
    redirect='<?php echo $redirect; ?>'
  ></span>
<?php endif; ?>
