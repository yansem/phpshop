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
});

$(".select2").select2({
    placeholder: "Начните вводить наименование товара",
    //minimumInputLength: 2,
    cache: true,
    ajax: {
        url: adminpath + "/product/related-product",
        delay: 250,
        dataType: 'json',
        data: function (params) {
            return {
                q: params.term,
                page: params.page
            };
        },
        processResults: function (data, params) {
            return {
                results: data.items,
            };
        },
    },
});