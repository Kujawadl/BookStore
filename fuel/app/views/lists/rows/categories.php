<?php if (isset($Category)): ?>
  <tr>
    <td>
      <a href='/browse/category/<?php echo($Category->id); ?>'>
        <div class='row'>
          <div class='col-md-12'>
            <h4><?php echo($Category->Name); ?></h4>
          </div>
        </div>
      </a>
    </td>
  </tr>
<?php endif; ?>
