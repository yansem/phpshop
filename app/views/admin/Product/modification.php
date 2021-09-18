<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Модификации
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/product">Список товаров</a></li>
        <li class="active">Модификации</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <a href="<?=ADMIN;?>/product/modification-add" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>Добавить модификацию</a>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Наименование товара</th>
                                <th>Модификация</th>
                                <th>Цена</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($modification as $k => $mod): ?>
                                <tr>
                                    <td><?=$mod['id'];?></td>
                                    <td><?=$mod['product_title'];?></td>
                                    <td><?=$mod['title'];?></td>
                                    <td><?=$mod['price'];?></td>
                                    <td>
                                        <a href="<?=ADMIN;?>/product/modification-edit?id=<?=$mod['id'];?>"><i class="fa fa-fw fa-pencil"></i></a>
                                        <a class="delete" href="<?=ADMIN;?>/product/modification-delete?id=<?=$mod['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->