<?php if (isset($Supplier)): ?>
  <tr>
    <td>
      <a href='/admin/suppliers/<?php echo($Supplier->id); ?>'>
        <div class='row'>
          <div class='col-md-12'>
            <h4><?php echo($Supplier->Name); ?></h4>
          </div>
        </div>
      </a>
    </td>
  </tr>
<?php endif; ?>
