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

  $(".delete").click(function() {
    action = $(this).attr('action');
    confirmation = $(this).attr('confirmation');
    redirect = $(this).attr('redirect');
    swal(
      {
        title: "Are you sure?",
        text: confirmation,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: true
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            type: "POST",
            url: action,
            success: function() {
              window.location = redirect;
            },
            error: function(xhr, status, error) {
              alert("An error occurred while attempting to delete this item: " + error);
              console.log(xhr);
              console.log(status);
              console.log(error);
            }
          })

        }
      }
    )
  })

  // Enable syntax highlighting on all pre and code elements with class highlight
  $('pre.hljs, code.hljs').each(function(i, block) {
    // Create a worker thread for each element
    var worker = new Worker(
      URL.createObjectURL(
        new Blob(
          [
            "onmessage = function(event) { \
              importScripts('http://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js'); \
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

  $('.edit').each(function() {
    url = $(this).attr('action');
    name = $(this).attr('name');
    $(this).editable(url, {
      submit:  'OK',
      tooltip: 'Click to edit',
      name:    name,
      onerror: function (settings, original, xhr) {
        console.log(xhr.status);
        console.log(xhr.responseText);
      }
    })
  })
});
