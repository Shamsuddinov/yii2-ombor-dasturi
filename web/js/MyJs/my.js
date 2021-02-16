jQuery(document).ready(function($) {
    $('body').delegate('.show-modal', 'click', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        let title = $(this).attr('title');
        $('#modalBody').load(url);
        $('#modal-header').html(title)
        $('#myModal').modal('show');
    });


    $('body').delegate('input', 'blur', function () {
        let val = $(this).val();
        let required = $(this).parent('div').hasClass('required');
        if (val === '' && required === true) {
            $(this).css({'border-color':'red'});
        } else {
            if (val === '' && required === false) {
                $(this).css({'border-color': 'green'});
            } else {
                $(this).css({'border-color': '#ced4da'});
            }
        }
    });
    $('.help-block').css({'color':'red'});

});