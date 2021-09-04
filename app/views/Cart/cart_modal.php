<?php if(!empty($_SESSION['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th class="fit">Фото</th>
                <th class="fit">Наименование</th>
                <th class="fit">Количество</th>
                <th class="fit">Цена</th>
                <th class="fit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($_SESSION['cart'] as $id=>$item): ?>
                <tr>
                    <td class="fit"><a href="product/<?=$item['alias']; ?>"><img src="images/<?=$item['img']; ?>" alt=""></a></td>
                    <td class="fit"><?= $item['title']; ?></td>
                    <td class="fit"><?= $item['qty']; ?></td>
                    <td class="fit"><?= $_SESSION['cart.currency']['symbol_left'] . $item['price'] . $_SESSION['cart.currency']['symbol_right']; ?></td>
                    <td class="fit"><span data-id="<?= $id; ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td>Итого:</td>
                <td colspan="4" class="text-right cart-qty"><?= $_SESSION['cart.qty']; ?></td>
            </tr>
            <tr>
                <td>На сумму:</td>
                <td colspan="4" class="text-right cart-sum"><?= $_SESSION['cart.currency']['symbol_left'] . $_SESSION['cart.sum'] . $_SESSION['cart.currency']['symbol_right']; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
<h3>Корзина пуста</h3>
<?php endif; ?>
