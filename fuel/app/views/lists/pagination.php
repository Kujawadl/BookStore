<?php if (isset($BaseUrl) && isset($Pages) && isset($Page) && $Pages > 1): ?>
  <nav aria-label="Page navigation">
    <ul class="pagination">
      <!-- Previous Button -->
      <?php if ($Page == 1): ?>
        <li class='disabled'>
          <span aria-hidden="true">&laquo;</span>
        </li>
      <?php else: ?>
        <li>
          <a href="<?php echo $BaseUrl . '/' . ($Page - 1) ?>" aria-label="Previous">
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
              <a href='<?php echo $BaseUrl . '/' . $i ?>'>
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
          <a href="<?php echo $BaseUrl . '/' . ($Page + 1) ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
<?php endif; ?>
