$('#cart .modal-body').on('click', '.delete', function(){
    let res = confirm('Подтвердите действие');
    if(!res) return false;
});
$('body').on('click', '.delete', function(){
    let res = confirm('Подтвердите действие');
    if(!res) return false;
})

/* Filters */
$('body').on('change', '.w_sidebar input', function(){
    let checked = $('.w_sidebar input:checked');
    let data = '';
    checked.each(function (){
        data += this.value + ',';
    })
    if(data){
        $.ajax({
            url:location.href,
            data: {filter:data},
            type: 'GET',
            beforeSend: function (){
                $('.preloader').fadeIn(300, function (){
                    $('.product-one').hide();
                })
            },
            success: function (res){
                $('.preloader').delay(500).fadeOut('slow', function (){
                    $('.product-one').html(res).fadeIn();
                    let url = location.search.replace(/filter(.+?)(&|$)/g, ''); //$2
                    let newURL = location.pathname + url + (location.search ? "&" : "?") + "filter=" + data;
                    newURL = newURL.replace('&&', '&');
                    newURL = newURL.replace('?&', '?');
                    history.pushState({}, '', newURL);
                })
            },
            error: function (){
                alert('Ошибка!');
            }
        })

    }else{
        window.location = location.pathname;
    }
})


/* Search */
let products = new Bloodhound({  // products получит данные запроса
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: '%QUERY', // маркер, который будет заменен поисковым запросом
        url: path + '/search/typeahead?query=%QUERY'
    }
});

products.initialize();

$("#typeahead").typeahead({
    // hint: false,
    highlight: true
},{
    name: 'products',
    display: 'title', // что будет показываться
    limit: 10, // количество результатов
    source: products // источник данных
});

$('#typeahead').bind('typeahead:select', function(ev, suggestion) { // suggestion - объект (id,title)
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

$('#cart .modal-body').on('focusin', '#qty', function(){
    let id = ($(this).data('id'));
    let mod = null;
    let oldQty = $(this).val();
    let newQty = null;
    if(typeof id === 'string'){
        mod = id.split('-')[1];
    }
    $(this).blur(function(e){
        newQty = $(this).val();
        e.stopImmediatePropagation();
        $.ajax({
            url: '/cart/addNew',
            data: {id:id, oldQty:oldQty, qty:newQty, mod:mod, new:'new'},
            type: 'GET',
            success: function (res){
                showCart(res);
            },
            error: function (){
                alert('Ошибка! Попробуйте позже');
            }
        });
    })
})

$('body').on('focusin', '#qty', function(){
    let id = ($(this).data('id'));
    let mod = null;
    let oldQty = $(this).val();
    let newQty = null;
    if(typeof id === 'string'){
        mod = id.split('-')[1];
    }
    $(this).blur(function(e){
        newQty = $(this).val();
        e.stopImmediatePropagation();
        $.ajax({
            url: '/cart/addNew',
            data: {id:id, oldQty:oldQty, qty:newQty, mod:mod, new:'new', source:'order'},
            type: 'GET',
            success: function (res){
                showOrder(res);
            },
            error: function (){
                alert('Ошибка! Попробуйте позже');
            }
        });
    })
})

$('#cart .modal-body').on('click', '.del-item-m', function(){
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

$('#cart .modal-body').on('click', '.add-item-m', function(){
    let id = ($(this).data('id'));
    let mod = null;
    if(typeof id === 'string'){
        mod = id.split('-')[1];
    }
    $.ajax({
        url: '/cart/add',
        data: {id:id, qty:1, mod:mod},
        type: 'GET',
        success: function (res){
            showCart(res);
        },
        error: function (){
            alert('Ошибка! Попробуйте позже');
        }
    });
})

$('#cart .modal-body').on('click', '.minus-item-m', function(){
    let id = $(this).data('id');
    let mod = null;
    if(typeof id === 'string'){
        mod = id.split('-')[1];
    }
    if($(this).data('val')===1){
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
        data: {id:id, qty:-1, mod:mod},
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
    if($('#cart .cart-sum').text()){
        $('.simpleCart_total').html($('#cart .cart-sum').text());
    }else{
        $('.simpleCart_total').html('Корзина пуста')
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

/*Order*/

$('body').on('click', '.del-item', function(){
    let id = $(this).data('id');
    // console.log(id);
    // return true;
    $.ajax({
        url: '/cart/delete',
        data: {id:id, source:'order'},
        type: 'GET',
        success: function (res){
            showOrder(res);
        },
        error: function (){
            alert('Ошибка! Попробуйте позже');
        }
    });
})

$('body').on('click', '.add-item', function(){
    let id = ($(this).data('id'));
    let mod = null;
    if(typeof id === 'string'){
        mod = id.split('-')[1];
    }
    $.ajax({
        url: '/cart/add',
        data: {id:id, qty:1, mod:mod, source:'order'},
        type: 'GET',
        success: function (res){
            showOrder(res);
        },
        error: function (){
            alert('Ошибка! Попробуйте позже');
        }
    });
})

$('body').on('click', '.minus-item', function(){
    let id = $(this).data('id');
    let mod = null;
    if(typeof id === 'string'){
        mod = id.split('-')[1];
    }
    if($(this).data('val')===1){
        $.ajax({
            url: '/cart/delete',
            data: {id:id, source:'order'},
            type: 'GET',
            success: function (res){
                showOrder(res);
            },
            error: function (){
                alert('Ошибка! Попробуйте позже');
            }
        });
        return false;
    }
    $.ajax({
        url: '/cart/add',
        data: {id:id, qty:-1, mod:mod, source:'order'},
        type: 'GET',
        success: function (res){
            showOrder(res);
        },
        error: function (){
            alert('Ошибка! Попробуйте позже');
        }
    });
})

function showOrder(cart){
    $('.content').html(cart);
    if($('.cart-sum').text()){
        $('.simpleCart_total').html($('.cart-sum').text());
    }else{
        $('.simpleCart_total').html('Корзина пуста')
    }
}

/*Order*/

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