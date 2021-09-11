<?php if(!empty($_SESSION['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th class="fit text-center">Фото</th>
                <th class="fit text-center">Наименование</th>
                <th class="fit text-center">Количество</th>
                <th class="fit"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></th>
                <th class="fit"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></th>
                <th class="fit">Цена</th>
                <th class="fit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($_SESSION['cart'] as $id=>$item): ?>
                <tr>
                    <td class="fit text-center"><a href="product/<?=$item['alias']; ?>"><img src="images/<?=$item['img']; ?>" alt=""></a></td>
                    <td class="fit text-center"><?= $item['title']; ?></td>
                    <td class="fit text-center" ><input id="qty" data-id="<?= $id; ?>" type="number" class="fit text-center" min="1" value="<?= $item['qty']; ?>"></span></td>
                    <td class="fit"><span data-id="<?= $id; ?>" class="glyphicon glyphicon-plus text-success add-item-m" aria-hidden="true"></span></td>
                    <td class="fit"><span data-id="<?= $id; ?>" class="glyphicon glyphicon-minus text-secondary minus-item-m" aria-hidden="true" data-val="<?= $item['qty']; ?>"></span></td>
                    <td class="fit"><?= $_SESSION['cart.currency']['symbol_left'] . $item['price'] . $_SESSION['cart.currency']['symbol_right']; ?></td>
                    <td class="fit"><span data-id="<?= $id; ?>" class="glyphicon glyphicon-remove text-danger del-item-m" aria-hidden="true"></span></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td>Итого:</td>
                <td colspan="6" class="text-right cart-qty"><?= $_SESSION['cart.qty']; ?></td>
            </tr>
            <tr>
                <td>На сумму:</td>
                <td colspan="6" class="text-right cart-sum"><?= $_SESSION['cart.currency']['symbol_left'] . $_SESSION['cart.sum'] . $_SESSION['cart.currency']['symbol_right']; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
<h3>Корзина пуста</h3>
<?php endif; ?>
