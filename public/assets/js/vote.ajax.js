$(document).ready(function() {
    var alert = $('#vote-alert');
    alert.hide();
    $('.vote').on('click', function(event) {
        event.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: $(this).attr('href'),
            type: 'GET',
            data: data,
            success: function(data) {
                if(data.success === true ) {
                    alert.text(data.message).show();
                    alert.addClass('alert-success').removeClass('alert-danger');
                    $('.vote').attr('disabled', true);
                } else {
                    alert.text(data.message).show();
                    $('.vote').attr('disabled', true);
                }
            }
        });
        return false;
    });
});