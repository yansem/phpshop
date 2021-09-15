$('.delete').click(function (){
    let res = confirm('Подтвердите действие');
    if(!res) return false;
})

let loc = window.location.protocol + '//' + window.location.host + window.location.pathname;
$('.sidebar-menu a').each(function (){
    if($(this).attr('href') == loc){
        $(this).parent().addClass('active');
        $(this).closest('.treeview').addClass('active');
    }
})

// CKEDITOR.replace('editor1');
$('#editor1').ckeditor();

$('#reset_filter').click(function (){
    $('#filter input[type=radio]').prop('checked', false);
    return false;
})