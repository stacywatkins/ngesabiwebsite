/**
 * Created by jpmeyer on 2017/08/16.
 */
function sendEmail() {
    var data = {
        name: $("#name").val(),
        email: $("#email").val(),
        message: $("#message").val()
    };

    var url = 'http://ngesabi.co.za/php/mail.php';

    $("#sendMailButton").hide();
    $("#sendingMail").show();
    $.post(url, data)
        .done(function(data) {
            $("#sendingMail").show();
            data = JSON.parse(data);
            console.log(data);
            if (data.status === 200) {
                $("#modal1").modal('hide');
                $("#thankyoumodal").modal('show');
            } else {
                if (data.status === 400) {
                    $.each(data.errors, function(error, value) {
                        console.log(error);
                    });
                }
            }
        })
        .always(function() {
            $("#sendMailButton").show();
            $("#sendingMail").hide();
        });
}