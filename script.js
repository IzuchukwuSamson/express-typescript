$(document).ready(function () {
  // $("table").DataTable();

  showAllUsers();

  function showAllUsers() {
    $.ajax({
      url: "action.php",
      type: "POST",
      data: {
        action: "view",
      },
      success: function (response) {
        // console.log(response);
        $("#showUser").html(response);
        $("table").DataTable({
          order: [0, "desc"],
        });
      },
    });
  }

  // Insert Ajax Request
  $("#insert").click(function (e) {
    if ($("#form-data")[0].checkValidity()) {
      e.preventDefault();

      $.ajax({
        url: "action.php",
        type: "POST",
        data: $("#form-data").serialize() + "&action=insert",
        success: function (response) {
          console.log(response);
        },
      });
    }
  });
});

//   $("#insert").on("click", function () {
//     var $this = $(this); //submit button selector using ID
//     var $caption = $this.html(); // We store the html content of the submit button
//     var form = "#form-data"; //defined the #form ID
//     var formData = $(form).serializeArray() + "&action=insert"; //serialize the form into array
//     // var route = $(form).attr("action"); //get the route using attribute action

//     // Ajax config
//     $.ajax({
//       type: "POST", //we are using POST method to submit the data to the server side
//       url: "action.php", // get the route value
//       data: formData, // our serialized array data for server side
//       beforeSend: function () {
//         //We add this before send to disable the button once we submit it so that we prevent the multiple click
//         $this.attr("disabled", true).html("Processing...");
//       },
//       success: function (response) {
//         //once the request successfully process to the server side it will return result here
//         $this.attr("disabled", false).html($caption);

//         // Reload lists of employees
//         showAllUsers();

//         // We will display the result using alert
//         Swal.fire({
//           icon: "success",
//           title: "Success.",
//           text: response,
//         });

//         // Reset form
//         resetForm(form);
//       },
//       error: function (XMLHttpRequest, textStatus, errorThrown) {
//         // You can put something here if there is an error from submitted request
//       },
//     });
//   });
// });

function resetForm(selector) {
  $(selector)[0].reset();
}

// $(document).ready(function () {
// Get all employee records
// all();

// Submit form using AJAX To Save Data
// save();

// Get the data and view to modal
// get();

// Updating the data
// update();

// Delete record via ajax
// del();
// });
