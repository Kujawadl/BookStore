<?php if (isset($Customer)): ?>
  <tr>
    <td>
      <a href='/admin/customers/<?php echo($Customer->id); ?>'>
        <div class='row'>
          <div class='col-md-12'>
            <h4><?php echo($Customer->FName . " " . $Customer->LName); ?></h4>
          </div>
        </div>
      </a>
    </td>
  </tr>
<?php endif; ?>
