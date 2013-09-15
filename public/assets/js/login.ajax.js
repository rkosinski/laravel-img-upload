$(document).ready(function() {
    $('#login-alert').hide();
    $('#login-form').on('submit', function(event) {
        event.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: data,
            success: function(data) {
                if(data.success === true ) {
                    location.href = data.redirect;
                } else {
                    $('#login-alert').text(data.message).show();
                }
            }
        });
        return false;
    });
});