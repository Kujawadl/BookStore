$(document).ready(function() {

  // Enable navbar search
  $("#frmSearch").submit(function() {
    if (! $("#txtSearch").val() == "") {
      $("#frmSearch").attr("action", "/browse/search/" + $("#txtSearch").val());
    } else {
      $("#frmSearch").attr("action", "");
    }
  });

  // Enable update quantity button
  $(".frmUpdateCart").submit(function() {
    id = $(this).attr('item');
    qty = $(this).children('input').val();
    $(this).attr('action', '/cart/update/' + id + '/' + qty);
  });

  // Enable remove from cart button, with sweetalert to confirm action
  $(".btnRemoveFromCart").click(function() {
    id = $(this).closest(".frmUpdateCart").attr('item');
    title = $(this).closest('tr').find('.bookTitle').text();

    swal(
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

  // Enable syntax highlighting on all pre and code elements with class highlight
  $('pre.hljs, code.hljs').each(function(i, block) {
    // Create a worker thread for each element
    var worker = new Worker(
      URL.createObjectURL(
        new Blob(
          [
            "onmessage = function(event) { \
              importScripts('/public/assets/js/highlighter.js'); \
              var result = self.hljs.highlightAuto(event.data); \
              postMessage(result.value); \
            }"
          ],
          {
            "type": "text\/plain"
          }
        )
      )
    );
    // When the worker returns, update the element's html content
    worker.onmessage = function(event) {
      $(block).html(event.data);
    }
    // Start the worker
    worker.postMessage($(block).text());
  });
});
