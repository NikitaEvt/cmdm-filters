<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="/<?= ADM_CONTROLLER ?>/menu/">Главная</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><?= $title ?></span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"><?= $title ?></h1>
<!-- END PAGE TITLE-->

<?php // Отображаем сообщения пользователю ?>
<?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-block alert-success fade in">
        <button type="button" class="close" data-dismiss="alert"></button>
        <?= $_SESSION['success']; ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>
<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-block alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert"></button>
        <?php foreach ($_SESSION['error'] as $error) : ?>
            <?= $error ?>
            <br/>
        <?php endforeach; ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php if (isset($admin_type) && $admin_type  == 1){ ?>
    <div class="row">
        <div class="portlet bordered">
            <div class="accordion" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #fff;">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1"><i
                                        class="fa <?= $i_icon ?>"></i> <?= $add ?></a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse <?= $accordion_status ?>"
                         aria-expanded="<?= $aria_expanded ?>">
                        <form action="<?= $a_path ?>" method="post" enctype="multipart/form-data">
                            <div class="panel-body">
                                <ul class="nav nav-pills">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Общая информация</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="tab_1_1">
                                        <div class="table-scrollable">
                                            <table class="table table-bordered table-striped table-hover">
                                                <tbody>
                                                <tr>
                                                    <td width="200">Логин *</td>
                                                    <td>
                                                        <input type="text" name="login"
                                                               class="form-control" <?= $login_value ?> required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="200">Пароль *</td>
                                                    <td>
                                                        <input type="password" name="password" class="form-control"
                                                               autocomplete="off" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="200">Подтвердите Пароль *</td>
                                                    <td>
                                                        <input type="password" name="passwordCheck" class="form-control"
                                                               autocomplete="off" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="200">&nbsp;</td>
                                                    <td>
                                                        <button type="submit" class="btn green"><i class="fa fa-check"></i>
                                                            Добавить
                                                        </button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php if (!empty($admins)) : ?>
    <div class="row">
        <div class="portlet light">
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th> Login</th>
                            <th width="260"> Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($admins as $admin): ?>
                            <tr>
                                <td>
                                    <?= $admin->login ?>
                                </td>
                                <td>
                                    <?php if ($admin->admin_type != 1): ?>
                                        <a href="<?= $del_path . $admin->id . '/' ?>"
                                           class="btn btn-xs default btn-editable red-stripe mine_delete_row">
                                            <i class="glyphicon glyphicon-remove-circle"></i> Удалить
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php } ?>
<?php // Отображаем сообщения пользователю по блоку с паролями ?>
<?php if (isset($_SESSION['error_passwords'])) : ?>
    <div class="alert alert-block alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert"></button>
        <?php foreach ($_SESSION['error_passwords'] as $error) : ?>
            <?= $error ?>
            <br/>
        <?php endforeach; ?>
    </div>
    <?php unset($_SESSION['error_passwords']); ?>
<?php endif; ?>

<div class="row">
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-lock"></i>
                <span class="caption-subject bold uppercase"> Смена пароля</span>
            </div>
        </div>
        <div class="portlet-body">
            <form action="<?= $chp_path ?>" method="post" enctype="multipart/form-data">
                <div class="table-scrollable">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                        <tr>
                            <td width="300">Старый пароль *</td>
                            <td>
                                <input type="password" name="old_password"
                                       class="form-control" <?= $login_value ?> autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <td width="300">Новый Пароль *</td>
                            <td>
                                <input type="password" name="password" class="form-control"
                                       autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <td width="300">Подтвердите новый Пароль *</td>
                            <td>
                                <input type="password" name="passwordCheck" class="form-control"
                                       autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <td width="300">&nbsp;</td>
                            <td>
                                <button type="submit" class="btn green"><i class="fa fa-check"></i>
                                    Изменить пароль
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>


