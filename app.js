

function Formsubmit() {
    var FormDeta = {
        first_name: $("first_name").val(),
        last_name: $("last_name").val(),
        email: $("email").val(),
        password: $("password").val()
    };
    $.ajax({
        url: "backend.php",
        type: "GET",
        dataType: "json",
        data: JSON.stringify(FormDeta),
        contentType: "application/json",
        success: function (response) {
            if (response.message == "success") {
                alert("success");
            }
            else if (response.message == "failed") {
                alert("failed");
            }
            else {
                alert("error");
            }
        },
        error: function (xhr, status, error) {
            $("#response").html("Error: " + error);
        }
    })
}