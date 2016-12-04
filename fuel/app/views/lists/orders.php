<?php if (isset($Orders)): ?>
  <table class="table table-condensed table-hover">
  	<tbody>
      <?php foreach ($Orders as $Order): ?>
        <tr>
          <td>
            <div class='row'>
              <div class='col-md-6'>
                <h4><?php echo($Order->id); ?></h4>
                <h5><?php echo($Order->Date); ?></h5>
                <?php echo($Order->Quantity() . (($Order->Quantity()) > 1 ? ' items' : 'item')); ?>
              </div>
              <div class='col-md-3'>
                <h5>Shipped To:</h5>
                <?php echo($Order->Address()); ?>
              </div>
              <div class='col-md-3'>
                <h4>Total: $<?php echo($Order->Value()); ?></h4>
              </div>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No results.</p>
<?php endif; ?>
