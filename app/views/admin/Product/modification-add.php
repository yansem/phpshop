<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Новая модификация
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/product/modification">Модификации</a></li>
        <li class="active">Новая модификация</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/product/modification-add" method="post" data-toggle="validator" id="add">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="product_id">Наименование товара</label>
                            <select name="product_id" class="form-control" id="category_id">
                                <option>Выберите товар</option>
                                <?php foreach($product as $id => $item): ?>
                                    <option value="<?=$id;?>"><?=$item['title'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="code">Наименование модификации</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Наименование модификации" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="value">Цена</label>
                            <input type="text" name="price" class="form-control" id="price" placeholder="Значение" required data-error="Допускаются цифры и десятичная точка" pattern="^[0-9.]{1,}$">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->