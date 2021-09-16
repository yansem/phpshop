<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Группы фильтров
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Группы фильтров</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <a href="<?=ADMIN;?>/filter/group-add" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>Добавить группу</a>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($attrs_group as $item): ?>
                            <tr>
                                    <td><?=$item->title;?></td>
                                    <td>
                                        <a href="<?=ADMIN;?>/filter/group-edit?id=<?=$item->id;?>"><i class="fa fa-fw fa-eye"></i></a>
                                        <a class="delete" href="<?=ADMIN;?>/filter/group-delete?id=<?=$item->id;?>"><i class="fa fa-fw fa-close text-danger"></i></a>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->