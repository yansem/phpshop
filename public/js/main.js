/*Cart*/

$('body').on('click', '.add-to-cart-link', function (e){
    e.preventDefault();
    let id = $(this).data('id'),
        qty = $('.quantity input').val() ? $('.quantity input').val() : 1,
        mod = $('.available select').val();

    $.ajax({
        url: '/cart/add',
        data: {id:id, qty:qty, mod: mod},
        type: 'GET',
        success: function (res){
            showCart(res);
        },
        error: function (){
            alert('Ошибка! Попробуйте позже');
        }

    })

    function showCart(cart){
        $('#cart .modal-body').html(cart);
        $('#cart').modal();
    }


})

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