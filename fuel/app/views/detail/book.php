<?php if (isset($Book)): ?>
  <div class="panel panel-default">
    <div class="panel-heading"><?php echo $Book->Title; ?></div>
    <!-- List group -->
    <ul class="list-group">
      <li class="list-group-item">ISBN: <?php echo $Book->ISBN; ?></li>
      <li class="list-group-item">
        Author(s):
        <ul>
          <?php foreach ($Book->Authors as $Author): ?>
            <li>
              <a href='/Browse/Author/<?php echo $Author->id; ?>'>
                <?php echo $Author->FName . " " . $Author->LName; ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </li>
      <li class="list-group-item">
        Categories:
        <ul>
          <?php foreach ($Book->Categories as $Category): ?>
            <li>
              <a href='/Browse/Category/<?php echo $Category->id ?>'>
                <?php echo $Category->Name; ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </li>
      <li class="list-group-item">Published: <?php echo $Book->PubDate; ?></li>
      <li class="list-group-item">Vestibulum at eros</li>
    </ul>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">Reviews</div>
    <div class="panel-body">
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

    <?php
      // Get all the reviews that have review text.
      // If there are any, choose up to 3 at random to be displayed under
      // the book information.
      $Reviews = $Book->get(
        'Reviews', array(
          'where' => array(
            array('Review', 'Is Not', NULL)
          )
        )
      );
    ?>
    <?php if (count($Reviews) > 0): ?>
      <ul class="list-group">
        <?php
          $Selection = array_rand($Reviews, min(3, count($Reviews)));
          if ( ! is_array($Selection)) { $Selection = array($Selection); }
        ?>
        <?php foreach ($Selection as $Key): ?>
          <?php $Review = $Reviews[$Key]; ?>
          <?php $Customer = Model_Customer::find($Review->Customer); ?>
          <li class="list-group-item">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-md-9">
                    <h3 class="panel-title">
                      <?php echo (substr($Customer->FName, 0, 1) . ". " . $Customer->LName); ?>
                    </h3>
                  </div>
                  <div class="col-md-3">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                      <?php if ($i < $Review->Rating): ?>
                          <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                      <?php else: ?>
                          <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                      <?php endif; ?>
                    <?php endfor; ?>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <?php echo $Review->Review; ?>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
<?php endif; ?>
