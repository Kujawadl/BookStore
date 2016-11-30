$(document).ready(function() {
  $("#txtSearch").keyup(function() {
    if (! $("#txtSearch").val() == "") {
      $("#frmSearch").attr("action", "/browse/search/" + $("#txtSearch").val());
    }
  })
});
