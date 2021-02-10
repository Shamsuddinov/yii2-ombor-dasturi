jQuery(document).ready(function($) {
    $('body').delegate('.show-modal', 'click', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        let title = $(this).attr('title');
        $('#modalBody').load(url);
        $('#modal-header').html(title)
        $('#myModal').modal('show');
    });
});