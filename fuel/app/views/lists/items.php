<?php if (isset($Order)): ?>
  <table class="table table-condensed table-hover">
  	<tbody>
      <?php foreach ($Order->Items as $Item): ?>
        <tr>
          <td>
            <div class='row'>
              <div class='col-md-6'>
                <pre><?php echo(var_export($Item->Book)); ?></pre>
              </div>
              <div class='col-md-3'>
<?php /*                <h5>$<?php echo($Item->Book->Price); ?></h5>
              </div>
              <div class='col-md-3'>
                <form item='<?php echo($Item->Book->id); ?>'>
                  Qty:
                  <input type='number' value='<?php ?>' />
                  <button class='btn btn-default' text='Update' type='submit' />
              </div>
            </div>
            <div class='row'>
              <div class='col-md-12'>
                <div class='row'>
                  <div class='col-md-3'>
                    Author(s):
                    <ul>
                      <?php foreach($Item->Book->Authors as $Author): ?>
                        <li>
                          <?php echo($Author->FName . ' ' . $Author->LName) ?>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                  <div class='col-md-3'>
                    Categories:
                    <ul>
                      <?php foreach($Item->Book->Categories as $Category): ?>
                        <li>
                          <?php echo($Category->Name); ?>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                  <div class='col-md-3'>
                    ISBN: <?php echo($Item->Book->ISBN); ?>
                    <br />
                    Published: <?php echo($Item->Book->PubDate); ?>
                  </div>
                  <div class='col-md-3'>
                    Average Review:
                    <br />
                    <?php
                      for ($i = 0; $i < 5; $i++)
                      {
                        if ($i < $Item->Book->AvgRating())
                        {
                          echo('<span class="glyphicon glyphicon-star" aria-hidden="true"></span>');
                        } else {
                          echo('<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>');
                        }
                      }
                    ?>
                    <br/>
                    <small>Based on <?php echo($Item->Book->NumRatings()); ?> ratings</small>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <td>
          <div class='row'>
            <div class='col=md-12 align-right'>
              Total: <?php echo($Order-Value()); ?>
            </div>
    */ endforeach;?>      </div>
        </td>
      </tr>
  </table>
<?php else: ?>
  <p>No items.</p>
<?php endif; ?>
