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
            <a href="<?= $parent_url ?>"><?= $parent_title ?></a>
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
<div class="row">
    <div class="portlet light">
        <div class="portlet-body">
            <form method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <ul class="nav nav-pills">
                        <li class="active">
                            <a href="#tab_1_1" data-toggle="tab">Общая информация</a>
                        </li>
                        <li>
                            <a href="#tab_1_2" data-toggle="tab">Адрес</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_1_1">
                            <div class="table-scrollable">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <td width="200">Имя Клиента</td>
                                        <td>
                                            <input type="text" name="name" class="form-control" value="<?=$item->name?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">Email</td>
                                        <td>
                                            <input type="email" name="email" class="form-control" value="<?=$item->email?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">Изменить пароль</td>
                                        <td>
                                            <input type="password"
                                                   name="password"
                                                   class="form-control"  minlength="8" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">&nbsp;</td>
                                        <td>
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i> Изменить
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="tab_1_2">
                            <div class="table-scrollable">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                    <input type="hidden" name="addres[client_id]"  value="<?=$item->id?>" >
                                    <tr>
                                        <td width="200">Адрес</td>
                                        <td>
                                            <input type="text" name="addres[address]" class="form-control" value="<?=$addres->address?>" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">Дом</td>
                                        <td>
                                            <input type="text" name="addres[home]" class="form-control" value="<?=$addres->home?>" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">Квартира</td>
                                        <td>
                                            <input type="text" name="addres[appart]" class="form-control" value="<?=$addres->appart?>" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">Этаж</td>
                                        <td>
                                            <input type="text" name="addres[entrance]" class="form-control" value="<?=$addres->entrance?>" >
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="200">&nbsp;</td>
                                        <td>
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i> Изменить
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
