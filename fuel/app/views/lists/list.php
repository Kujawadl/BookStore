<?php if (isset($Rows) && count($Rows) > 0): ?>
  <?php
    $Pages = intdiv(count($Rows) / 10) + 1;
    $Page  = (isset($_GET['p']) && is_numeric($_GET['p']) ? $_GET['p'] : 1);
  ?>
  <table class="table table-condensed table-hover">
  	<tbody>
      <?php
        $Start = 10 * ($Page - 1);
        $End = $Start + 10;
        for ($i = $Start; $i < $End && $i < count($Rows); $i++)
        {
          echo($Rows[$i]);
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <td>
          <div class="row text-center">
            <?php
              if ($Pages > 1)
              {
                echo View::forge('lists/pagination', array('Pages' => $Pages));
              }
            ?>
          </div>
        </td>
      </tr>
    </tfoot>
  </table>
<?php else: ?>
  <p>No results.</p>
<?php endif; ?>
