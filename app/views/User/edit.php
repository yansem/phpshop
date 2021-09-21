<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="<?= PATH ?>">Главная</a></li>
                <li><a href="<?= PATH ?>/user/account">Личный кабинет</a></li>
                <li>Редактирование профиля</li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--prdt-starts-->
    <div class="container">
        <div class="prdt-top">
            <div class="col-md-12 prdt-left">
                    <div class="register-top heading">
                        <h2>Редактирование профиля</h2>
                    </div>
                        <form action="user/edit" method="post" data-toggle="validator">
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="login">Логин</label>
                                    <input type="text" class="form-control" name="login" id="login" value="<?=h($_SESSION['user']['login']);?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Пароль</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль, если хотите его изменить">
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="name">Имя</label>
                                    <input type="text" class="form-control" name="name" id="name" value="<?=h($_SESSION['user']['name']);?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?=h($_SESSION['user']['email']);?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="address">Адрес</label>
                                    <input type="text" class="form-control" name="address" id="address" value="<?=h($_SESSION['user']['address']);?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<!--product-end-->