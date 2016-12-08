<?php if (isset($Representative)): ?>
  <tr>
    <td>
      <a href='/admin/representatives/<?php echo($Representative->id); ?>'>
        <div class='row'>
          <div class='col-md-12'>
            <h4><?php echo($Representative->FName . " " . $Representative->LName); ?></h4>
          </div>
        </div>
      </a>
    </td>
  </tr>
<?php endif; ?>
