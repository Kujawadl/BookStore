<? if (isset($BaseUrl) && isset($Pages) && isset($Page) && $Pages > 1): ?>
  <tfoot>
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
        <?php for ($i = 0; $i < $Pages; $i++): ?>
          <?php if ($i == $Page): ?>
              <li class='active'>
                <?php echo $i; ?>
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
  </tfoot>
<?php endif; ?>
