<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <?= $breadcrumbs; ?>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--start-single-->
<div class="single contact">
    <div class="container">
        <div class="single-main">
            <div class="col-md-9 single-main-left">
                <div class="sngl-top">
                    <?php if($gallery): ?>
                    <div class="col-md-5 single-top-left">
                        <div class="flexslider">
                            <ul class="slides">
                                <?php foreach ($gallery as $item): ?>
                                <li data-thumb="images/<?=$item->img;?>">
                                    <div class="thumb-image"><img src="images/<?=$item->img;?>" data-imagezoom="true"
                                                                  class="img-responsive" alt=""/></div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                        <!-- FlexSlider -->
                    <?php else: ?>
                    <div class="col-md-3 single-top-left">
                        <img src="images/<?=$product->img;?>" alt="">
                    </div>
                    <?php endif; ?>
                    <?php
                    $curr = \phpshop\App::$app->getProperty('currency');
                    $cats = \phpshop\App::$app->getProperty('cats');
                    ?>
                    <div class="col-md-7 single-top-right">
                        <div class="single-para simpleCart_shelfItem">
                            <h2><?= $product->title ?></h2>
                            <div class="star-on">
                                <ul class="star-footer">
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                </ul>
                                <div class="review">
                                    <a href="#"> 1 customer review </a>

                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <h5 class="item_price" id="base-price"
                                data-base="<?= $product->price * $curr['value']; ?>"><?= $curr['symbol_left']; ?><?= $product->price * $curr['value']; ?><?= $curr['symbol_right']; ?></h5>
                            <?php if ($product->old_price): ?>

                                <del id="old-price"><?= $curr['symbol_left'] ?><?= $product->old_price * $curr['value'] ?><?= $curr['symbol_right'] ?></del>

                            <?php endif; ?>
                            <p><?= $product->content; ?></p>
                            <div class="available">
                                <ul>
                                    <?php if ($mods): ?>
                                        <li>Color
                                            <select>
                                                <option>Выбрать цвет</option>
                                                <?php foreach ($mods as $mod): ?>
                                                    <option data-title="<?= $mod->title; ?>"
                                                            data-price="<?= $mod->price * $curr['value']; ?>"
                                                            <?php if ($product->old_price): ?>
                                                            data-oldprice="<?= $product->old_price * $curr['value'] ?>"
                                                            <?php endif; ?>
                                                            value="<?= $mod->id; ?>"><?= $mod->title; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </li>
                                    <?php endif; ?>
                                    <div class="clearfix"></div>
                                </ul>
                            </div>
                            <ul class="tag-men">
                                <li><span>Category</span>
                                    <span>:<a href="category/<?= $cats[$product->category_id]['alias']; ?>"><?= $cats[$product->category_id]['title']; ?></a></span>
                                </li>
                            </ul>
                            <div class="quantity">
                                <input type="number" size="4" value="1" name="quantity" step="1" min="1">
                            </div>
                            <a id="productAdd" data-id="<?=$product->id;?>" href="cart/add?id=<?=$product->id;?>" class="add-cart item_add add-to-cart-link">Добавить в корзину</a>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="tabs">
                    <ul class="menu_drop">
                        <li class="item1"><a href="#"><img src="images/arrow.png" alt="">Описание</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing
                                        elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item2"><a href="#"><img src="images/arrow.png" alt="">Дополнительная информация</a>
                            <ul>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item3"><a href="#"><img src="images/arrow.png" alt="">Отзывы</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing
                                        elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item4"><a href="#"><img src="images/arrow.png" alt="">Полезные ссылки</a>
                            <ul>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item5"><a href="#"><img src="images/arrow.png" alt="">Сделать подарок</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing
                                        elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <?php if($related): ?>
                <div class="latestproducts">
                    <div class="product-one">
                        <h3>С этим товаром также покупают:</h3>
                        <?php foreach ($related as $item): ?>
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
                <?php if($recentlyViewed): ?>
                    <div class="latestproducts">
                        <h3 class="product-one">
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
                            <h3><a href="product/related">Все просмотренные товары</a></h3>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--end-single-->