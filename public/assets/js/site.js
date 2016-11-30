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

  $(".btnRemoveFromCart").click(function() {
    id = $(this).closest(".frmUpdateCart").attr('item');
    title = $(this).closest('tr').find('.bookTitle').text();

    sweetalert(
      {
        title: "Are you sure?",
        text: "Remove " + title + " from cart?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, remove it!",
        closeOnConfirm: true
      },
      function(isConfirm) {
        if (isConfirm) {
          window.location = '/cart/remove/' + id;
        }
      }
    );
  });
});
