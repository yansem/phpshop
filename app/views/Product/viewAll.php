<?php $curr = \phpshop\App::$app->getProperty('currency'); ?>
<?php if($recentlyViewed): ?>
<div class="latestproducts">
    <div class="product-one">
        <h3>Недавно просмотренные товары:</h3>
        <?php foreach ($recentlyViewed as $item): ?>
            <div class="col-md-4 product-left p-left">
                <div class="product-main simpleCart_shelfItem">
                    <a href="product/<?=$item['alias'];?>" class="mask"><img class="img-responsive zoom-img"
                                                                             src="images/<?=$item['img'];?>" alt=""/></a>
                    <div class="product-bottom">
                        <h3><a href="product/<?=$item['alias'];?>"><?=$item['title'];?></a></h3>
                        <h4><a class="item_add add-to-cart-link" href="cart/add?id=<?=$item['id'];?>" data-id="<?=$item['id'];?>"><i></i></a> <span class=" item_price"><?= $curr['symbol_left']; ?><?= $item['price'] * $curr['value']; ?><?= $curr['symbol_right']; ?></span>
                            <?php if ($item['old_price']): ?>

                                <small><del><?= $curr['symbol_left'] ?><?= $item['old_price'] * $curr['value'] ?><?= $curr['symbol_right'] ?></del></small>

                            <?php endif; ?>
                        </h4>

                    </div>
                    <?php if($item['old_price']): ?>
                        <div class="srch">
                            <span>-<?=round(($item['old_price']-$item['price'])*100/$item['old_price'],1);?>%</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="clearfix"></div>
    </div>
</div>
<?php endif; ?>
