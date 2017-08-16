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

    $.post(url, data)
        .done(function(data) {
            if (data.status === 200) {
                $("#modal1").modal('close');
            } else {
                if (data.status === 400) {
                    $.each(data.errors, function(error, value) {
                        console.log(error);
                    });
                }
            }
        })
}