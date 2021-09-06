/* Search */
let products = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: '%QUERY',
        url: path + '/search/typeahead?query=%QUERY'
    }
});

products.initialize();

$("#typeahead").typeahead({
    // hint: false,
    highlight: true
},{
    name: 'products',
    display: 'title',
    limit: 10,
    source: products
});

$('#typeahead').bind('typeahead:select', function(ev, suggestion) {
    // console.log(suggestion);
    window.location = path + '/search/?s=' + encodeURIComponent(suggestion.title);
});

/* Search */

/*Cart*/

$('body').on('click', '.add-to-cart-link', function (e) {
    e.preventDefault();
    let id = $(this).data('id'),
        qty = $('.quantity input').val() ? $('.quantity input').val() : 1,
        mod = $('.available select').val();

    $.ajax({
        url: '/cart/add',
        data: {id: id, qty: qty, mod: mod},
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert('Ошибка! Попробуйте позже');
        }
    });
});

$('#cart .modal-body').on('click', '.del-item', function(){
    let id = $(this).data('id');
    $.ajax({
        url: '/cart/delete',
        data: {id:id},
        type: 'GET',
        success: function (res){
            showCart(res);
        },
        error: function (){
            alert('Ошибка! Попробуйте позже');
        }
    });
})

$('#cart .modal-body').on('click', '.add-item', function(){
    let id = $(this).data('id');
    $.ajax({
        url: '/cart/add',
        data: {id:id, qty:1},
        type: 'GET',
        success: function (res){
            showCart(res);
        },
        error: function (){
            alert('Ошибка! Попробуйте позже');
        }
    });
})

$('#cart .modal-body').on('click', '.minus-item', function(){
    let id = $(this).data('id');
    if($('#qty').text()==='1'){
        $.ajax({
            url: '/cart/delete',
            data: {id:id},
            type: 'GET',
            success: function (res){
                showCart(res);
            },
            error: function (){
                alert('Ошибка! Попробуйте позже');
            }
        });
        return false;
    }
    $.ajax({
        url: '/cart/add',
        data: {id:id, qty:-1},
        type: 'GET',
        success: function (res){
            showCart(res);
        },
        error: function (){
            alert('Ошибка! Попробуйте позже');
        }
    });
})

function showCart(cart){
    if($.trim(cart)==='<h3>Корзина пуста</h3>'){
        $('#setOrder, #clearCart').css('display', 'none');
    }else{
        $('#setOrder, #clearCart').css('display', 'inline-block');
    }
    $('#cart .modal-body').html(cart);
    $('#cart').modal();
    if($('.cart-sum').text()){
        $('.simpleCart_total').html($('.cart-sum').text());
    }else{
        $('.simpleCart_total').html('Empty cart')
    }
}

function getCart(){
    $.ajax({
        url: '/cart/show',
        type: 'GET',
        success: function (res){
            showCart(res);
        },
        error: function (){
            alert('Ошибка! Попробуйте позже');
        }
    });
}

function clearCart(){
    $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function (res){
            showCart(res);
        },
        error: function (){
            alert('Ошибка! Попробуйте позже');
        }
    });
}
/*Cart*/


$('#currency').change(function (){
    window.location = 'currency/change?curr=' + $(this).val();
});
$('.available select').on('change', function (){
    let modId = $(this).val(),
        color = $(this).find('option').filter(':selected').data('title'),
        price = $(this).find('option').filter(':selected').data('price'),
        oldPrice = $(this).find('option').filter(':selected').data('oldprice'),
        basePrice = $('#base-price').data('base');

    if(price){
        $('#base-price').text(symbolLeft + price + symbolRight);
        if(oldPrice){
            let diff = price - basePrice;
            var discount = (oldPrice-basePrice)*100/oldPrice,
                newOldPrice = Math.round((100*price)/(100-discount));
            $('#old-price').text(symbolLeft + newOldPrice + symbolRight);
        }
    }else{
        $('#base-price').text(symbolLeft + basePrice + symbolRight);
    }
})