$('#loader').hide()
$('#submit').click(function() {
    $('#loader').show()
    var id = $('#userid').val();
    var pwd = $('#pwd').val();
    var data = { 'uid': id, 'pwd': pwd }

    console.log("This is captured data = ", data)
    $('#invalidlogin').empty()

    $.ajax({
        url: 'http://localhost/hrms/api/login.php',
        type: 'POST',
        data: { "uid": id, "pwd": pwd },

        success: function(para) {
            $('#loader').hide()
            var errtxt = '<p style="color: red">Invalid Login Details..!!</p>'
            console.log("This is the path to reditect = ", para)

            if (para != "404") {
                var result = "http://localhost/hrms/" + para + "dash.php"
                document.location.replace(result)
            } else {
                var errtxt = '<p style="color: red">Invalid Login Details..!!</p>'
                $('#invalidlogin').hide()
                $('#invalidlogin').append(errtxt)
                $('#invalidlogin').fadeIn(1000)
            }

        },
    });
});