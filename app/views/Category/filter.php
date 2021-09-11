<?php if (!empty($products)): ?>
    <div class="product-one">
        <?php $curr = \phpshop\App::$app->getProperty('currency'); ?>
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 product-left p-left">
                <div class="product-main simpleCart_shelfItem">
                    <a href="product/<?= $product->alias; ?>" class="mask"><img class="img-responsive zoom-img"
                                                                                src="images/<?= $product->img; ?>"
                                                                                alt=""/></a>
                    <div class="product-bottom">
                        <h3><?= $product->title; ?></h3>
                        <h4>
                            <a data-id="<?= $product->id; ?>" class="add-to-cart-link"
                               href="cart/add?id=<?= $product->id; ?>"><i></i></a> <span
                                    class=" item_price"><?= $curr['symbol_left']; ?><?= $product->price * $curr['value']; ?><?= $curr['symbol_right']; ?></span>
                            <?php if ($product->old_price): ?>
                                <small>
                                    <del><?= $curr['symbol_left']; ?><?= $product->old_price * $curr['value']; ?><?= $curr['symbol_right']; ?></del>
                                </small>
                            <?php endif; ?>
                        </h4>
                    </div>
                    <?php if ($product->old_price): ?>
                        <div class="srch">
                            <span><?= round(($product->old_price - $product->price) * 100 / $product->old_price, 1); ?>%</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="clearfix"></div>
        <div class="text-center">
            <?php if ($pagination->countPages > 1): ?>
                <?= $pagination; ?>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <h3>Товаров не найдено</h3>
<?php endif; ?>
