<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="/<?= ADM_CONTROLLER ?>/menu/">Home</a>
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

<?php if (!empty($objects)) : ?>
    <div class="row">
        <div class="portlet light">
            <div class="portlet-body">
                <form action="<?= $o_path; ?>" method="post">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th width="120"> Дата создания</th>
                                <th width="120"> Обновлён</th>
                                <th width="80"> Статус</th>
                                <th width="60"> Клиент</th>
                                <th width="60"> Номер</th>
                                <th width="60"> Email</th>
                                <th width="60"> Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?$statuses = [
	                            'new' => '<span class="label label-sm label-info"> Новый </span>',
	                            'progress' => '<span class="label label-sm label-warning"> В обработке </span>',
	                            'finished' => '<span class="label label-sm label-danger"> Завершён </span>',
                                'canceled' => '<span class="label label-sm label-danger"> Отменён </span>']
	                             ?>
                            <?php foreach ($objects as $item): ?>
                                <tr style="height: 51px;">
                                    <td class="align-middle">
                                        <span><?=date('d.m.Y H:i:s', strtotime($item->added))?></span>
                                    </td>
                                    <td class="align-middle">
                                        <span><?php if (!empty($item->updated)){?><?=date('d.m.Y H:i:s', strtotime($item->updated))?><?php } ?></span>
                                    </td>
                                    <td class="align-middle"><?=$statuses[$item->status]?></td>
                                    <td class="align-middle"><?=$item->name?></td>
                                    <td class="align-middle"><?=$item->phone?></td>
                                    <td class="align-middle"><?=$item->email?></td>
                                    <td class="align-middle">
                                        <a href="<?= $e_path . $item->id . '/' ?>"
                                           class="btn btn-xs default btn-editable green-stripe">
                                            <i class="fa fa-search"></i> Просмотреть
                                        </a>
                                        <a href="<?= $del_path . $item->id . '/' ?>"
                                           class="btn btn-xs default btn-editable red-stripe mine_delete_row">
                                            <i class="glyphicon glyphicon-remove-circle"></i> Удалить
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
