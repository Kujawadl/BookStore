$(document).ready(function() {
  $("#frmSearch").submit(function() {
    if (! $("#txtSearch").val() == "") {
      $("#frmSearch").attr("action", "/browse/search/" + $("#txtSearch").val());
    } else {
      $("#frmSearch").attr("action", "");
    }
  });

  $(".frmUpdateCart").submit(function() {
    id = $(this).attr('item');
    qty = $(this).children('input').val();
    $(this).attr('action', '/cart/update/' + id + '/' + qty);
  });
});
