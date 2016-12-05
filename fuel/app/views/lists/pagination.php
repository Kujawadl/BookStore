<?php
  $Page = (isset($_GET['p']) && is_numeric($_GET['p']) ? $_GET['p'] : 1);
  if (isset($Pages)):
?>
  <ul class="pagination">
    <!-- Previous Button -->
    <?php if ($Page == 1): ?>
      <li class='disabled'>
        <span aria-hidden="true">&laquo;</span>
      </li>
    <?php else: ?>
      <li>
        <a href="<?php echo Uri::update_query_string(array('p' => $i - 1)); ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
    <?php endif; ?>
    <!-- Pages -->
    <?php $Start = ($Page - 3 > 0     ? $Page - 3 : 1); ?>
    <?php $End = ($Page + 3 <= $Pages ? $Page + 3 : $Pages); ?>
    <?php for ($i = $Start; $i <= $End; $i++): ?>
      <?php if ($i == $Page): ?>
          <li class='active'>
            <span>
              <?php echo $i; ?>
            </span>
          </li>
      <?php else: ?>
          <li>
            <a href='<?php echo Uri::update_query_string(array('p' => $i)); ?>'>
              <?php echo $i; ?>
            </a>
          </li>
      <?php endif; ?>
    <?php endfor; ?>
    <!-- Next Button -->
    <?php if ($Page == $Pages): ?>
      <li class='disabled'>
        <span aria-hidden="true">&raquo;</span>
      </li>
    <?php else: ?>
      <li>
        <a href="<?php echo Uri::update_query_string(array('p' => $i + 1)); ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    <?php endif; ?>
  </ul>
<?php endif; ?>
