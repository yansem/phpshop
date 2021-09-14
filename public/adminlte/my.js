CKEDITOR.replace('editor1');

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