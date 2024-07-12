$(document).ready(function () {
    $('#fdocumentType').change(function (e) {
        e.preventDefault();
        var selectedOptionText = $(this).find('option:selected').val();
        if (selectedOptionText === 1 || selectedOptionText === 2 || selectedOptionText === 3) {
            $('#institutionFound').show();
        } else {
            $('#institutionFound').hide();
        }
    });
});

