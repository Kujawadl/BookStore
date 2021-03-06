<?php if (isset($Order) and count($Order->Items) > 0): ?>
  <table class="table table-condensed table-hover">
  	<tbody>
      <?php foreach ($Order->Items as $Item): ?>
        <?php $Book = Model_Book::find($Item->Book); ?>
        <tr>
          <td>
            <div class='row'>
              <div class='col-md-6'>
                <h4 class='bookTitle'><?php echo($Book->Title); ?></h4>
              </div>
              <div class='col-md-3'>
                <h5 class='bookPrice'>$<?php echo($Book->Price); ?></h5>
              </div>
              <div class='col-md-3'>
                <form class='frmUpdateCart' item='<?php echo($Book->id); ?>'>
                  Qty:
                  <?php if (isset($Order->Date) && $Order->Date != null): ?>
                    <?php echo($Item->Quantity); ?>
                  <?php else: ?>
                    <input type='number' value='<?php echo($Item->Quantity); ?>' min='0' style='width: 50px;'/>
                    <button class='btn btn-default btn-sm' type='submit'>Update</button>
                    <a class="btnRemoveFromCart" href='#'>
                      <span class='glyphicon glyphicon-remove-sign glyphicon-delete' style='font-size: 1.5em; top: 0.25em;' aria-hidden='true'></span>
                    </a>
                  <?php endif; ?>
                </form>
              </div>
            </div>
            <div class='row'>
              <div class='col-md-12'>
                <div class='row'>
                  <div class='col-md-3'>
                    Author(s):
                    <ul>
                      <?php foreach($Book->Authors as $Author): ?>
                        <li class='bookAuthor'>
                          <?php echo($Author->FName . ' ' . $Author->LName) ?>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                  <div class='col-md-3'>
                    Categories:
                    <ul>
                      <?php foreach($Book->Categories as $Category): ?>
                        <li class='bookCategory'>
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
            <div class='col-md-9'></div>
            <div class='col-md-3'>
              <h2>Total: $<?php echo($Order->Value()); ?></h2>
            </div>
          </div>
        </td>
      </tr>
    </tfoot>
  </table>
<?php else: ?>
  <p>No items.</p>
<?php endif; ?>
