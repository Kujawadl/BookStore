<?php if (isset($BaseUrl) && isset($Rows) && count($Rows) > 0): ?>
  <?php
    $Pages = count($Rows) / 10;
    $Page  = (isset($_GET['p']) && is_numeric($_GET['p']) ? $_GET['p'] : 1);

    echo("TEST");
  ?>
  <table class="table table-condensed table-hover">
  	<tbody>
      <?php
        $Start = 10 * ($Page - 1);
        $End = $Start + 10;
        for ($i = $Start; $i < $End; $i++)
        {
          echo($Rows[$i]);
        }
      ?>
    </tbody>
    <?php
      if ($Pages > 1)
      {
        $data['BaseUrl'] = $BaseUrl;
        $data['Pages']   = $Pages;
        $data['Page']    = $Page;

        echo View::forge('lists/pagination', $data);
      }
    ?>
  </table>
<?php else: ?>
  <p>No results.</p>
<?php endif; ?>
