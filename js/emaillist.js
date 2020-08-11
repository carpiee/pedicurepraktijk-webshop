$(document).ready(function () {
  $("#add_email").click(function (e) {
    e.preventDefault();
    var email = $("#add_email_ip").val();
    $.ajax({
      type: "GET",
      dataType: "JSON",
      url: "./emailLijst/add_email.php",
      data: {
        email: email,
      },

      success: function (data) {
        console.log("email toegevoegd: " + email);
        $("#add_email_ip").val("");
        $("#bedankt").show();
        $("#bedankt").delay(5000).fadeOut(800);
        $("#bedankt h1").html(data);
        if (data != "U email adress is toegevoegd!") {
          $("#bedankt").attr("class", "bg-red-300");
        } else {
        }
      },
    });
    console.log("button");
  });

  $('input[type="text"]').on("keyup input", function () {
    /* Get input value on change */
    var inputVal = $(this).val();
    var resultDropdown = $(".result");
    if (inputVal != " ") {
      $.get("./templates/search.php", {
        term: inputVal,
      }).done(function (data) {
        // Display the returned data in browser
        resultDropdown.html(data);
      });
    }
  });
  // Set search input value on click of result item
  $(document).on("click", ".result p", function () {
    $(this)
      .parents(".search-box")
      .find('input[type="text"]')
      .val($(this).text());
    $(this).parent(".result").empty();
  });
});
