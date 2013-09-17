$(document).ready(function() {
    $('#vote-alert').hide();
    $('.vote').on('click', function(event) {
        event.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: $(this).attr('href'),
            type: 'GET',
            data: data,
            success: function(data) {
                if(data.success === true ) {
                    $('.vote').attr('disabled', true);
                } else {
                    $('#vote-alert').text(data.message).show();
                }
            }
        });
        return false;
    });
});