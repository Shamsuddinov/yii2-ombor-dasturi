$('select#contragent_id').change(function(){
    alert($(this).children('option:selected').data('id'));
});
