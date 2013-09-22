$('#form-buttons').hide();

$("#browse").click(function () {
    $('#multiple-files').show('');
    $("#multiple-files").click();
});

$('#multiple-files').on('change', function() {
    $('#form-buttons').show();
    $('#notifications').hide();
    $('#files').html('');
    for (var i = 0; i < this.files.length; i++) {
        $('#files').append('<div class="alert alert-info">Nazwa pliku: <b>' + this.files[i].name + '</b></div>');
    }
});

$('#reset').on('click', function() {
    $('#files').html('');
    $('#form-buttons').hide();
});