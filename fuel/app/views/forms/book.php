<?php
  if ( ! isset($Book))
  {
    $Book = Model_Book::forge();
    $action = "/admin/books/new";
  } else {
    $action = "/admin/books/" . $Book->id;
  }

  $Authors = Model_Author::find('all', array('order_by' => array('FName', 'LName')));
  $Categories = Model_Category::find('all', array('order_by' => array('Name')));
  $Suppliers = Model_Supplier::find('all', array('order_by' => array('Name')));
?>
<form id='frmBook'>
<!--
Title
Price
Authors
Categories
ISBN
PubDate
Supplier
-->
<div class="form-group">
  <label for="txtTitle">Title</label>
  <input id="txtTitle" type="text" class="form-control">
</div>

<div class="form-group">
  <label for="numPrice">Price</label>
  <input id="numPrice" type="number" min="0.01" step="0.01" class="form-control">
</div>

<div class="form-group">
  <label for="lstAuthors">Authors</label>
  <select multiple id="lstAuthors" class="form-control">
    <?php foreach ($Authors as $Author): ?>
      <option value="<?php echo $Author->id; ?>">
        <?php echo $Author->FName . " " . $Author->LName; ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

<div class="form-group">
  <label for="lstCategories">Categories</label>
  <select multiple id="lstCategories" class="form-control">
    <?php foreach ($Categories as $Category): ?>
      <option value="<?php echo $Category->id; ?>">
        <?php echo $Category->Name; ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

<div class="form-group">
  <label for="txtISBN">ISBN</label>
  <input id="txtISBN" type="text" class="form-control">
</div>

<div class="form-group">
  <label for="txtDate">Publication Date</label>
  <input id="txtDate" type="date" class="form-control">
</div>

<div class="form-group">
  <label for="ddlSupplier">Supplier</label>
  <select id="ddlSupplier" class="form-control">
    <?php foreach ($Suppliers as $Supplier): ?>
      <option value="<?php echo $Supplier->id; ?>">
        <?php echo $Supplier->Name; ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

<div class="btn-group">
  <input type="submit" class="btn btn-success" value="<?php echo ($Book->id > 0 ? 'Update' : 'Create'); ?>"></button>
</div>
</form>

<script>
$(document).ready(function() {
  $("#frmBook").submit(function(event) {

    var formData = {
      Title: $("#txtTitle").val(),
      Price: $("#numPrice").val(),
      Authors: $("#lstAuthors :selected").val(),
      Categories: $("#lstCategories :selected").val(),
      ISBN: $("#txtISBN").val(),
      PubDate: $("#txtDate").val(),
      Supplier: $("#ddlSupplier :selected").val()
    };

    $.ajax({
      type:     'POST',
      url:      '<?php echo $action; ?>',
      data:     formData,
      success:  function(result, status, xhr) {
        console.log(result);
        console.log(status);
        console.log(xhr);
        window.location = result.url;
      },
      error:    function(xhr, status, error) {
        console.log(xhr);
        console.log(status);
        console.log(error);
        swal(
          "There was a problem processing the request: " + error);
      }
    });

    event.preventDefault();
  });
});
</script>
