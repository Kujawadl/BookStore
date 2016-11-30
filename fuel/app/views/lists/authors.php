<?php if (isset($Authors)): ?>
  <table class="table table-condensed table-hover">
  	<tbody>
      <?php foreach ($Authors as $Author): ?>
        <tr>
          <td>
            <a href='/browse/author/<?php echo($Author->id); ?>'>
              <div class='row'>
                <div class='col-md-8'>
                  <h4><?php echo($Author->FName . ' ' .$Author->LName); ?></h4>
                </div>
                <div class='col-md-4'>
                  Known for:
                  <ul>
                    <?php foreach ($Author->TopCategories() as $Category): ?>
                      <li><?php echo($Category['Name']); ?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No results.</p>
<?php endif; ?>
