<?php if (isset($Order)): ?>
  <table class="table table-condensed table-hover">
  	<tbody>
      <?php foreach ($Order->Items as $Item): ?>
        <?php $Book = Model_Book::find($Item->Book); ?>
        <tr>
          <td>
            <div class='row'>
              <div class='col-md-6'>
                <h4><?php echo($Book->Title); ?></h4>
              </div>
              <div class='col-md-3'>
                <h5>$<?php echo($Book->Price); ?></h5>
              </div>
              <div class='col-md-3'>
                <form item='<?php echo($Book->id); ?>'>
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
                      <?php foreach($Book->Authors as $Author): ?>
                        <li>
                          <?php echo($Author->FName . ' ' . $Author->LName) ?>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                  <div class='col-md-3'>
                    Categories:
                    <ul>
                      <?php foreach($Book->Categories as $Category): ?>
                        <li>
                          <?php echo($Category->Name); ?>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                  <div class='col-md-3'>
                    ISBN: <?php echo($Book->ISBN); ?>
                    <br />
                    Published: <?php echo($Book->PubDate); ?>
                  </div>
                  <div class='col-md-3'>
                    Average Review:
                    <br />
                    <?php
                      for ($i = 0; $i < 5; $i++)
                      {
                        if ($i < $Book->AvgRating())
                        {
                          echo('<span class="glyphicon glyphicon-star" aria-hidden="true"></span>');
                        } else {
                          echo('<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>');
                        }
                      }
                    ?>
                    <br/>
                    <small>Based on <?php echo($Book->NumRatings()); ?> ratings</small>
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
              Total: <?php echo($Order->Value()); ?>
            </div>
          </div>
        </td>
      </tr>
  </table>
<?php else: ?>
  <p>No items.</p>
<?php endif; ?>
