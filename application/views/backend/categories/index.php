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


<div class="row">
    <div class="portlet bordered">
        <div class="accordion" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #fff;">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1"><i
                                    class="fa fa-plus"></i> <?= $add ?></a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <form action="<?= $a_path ?>" method="post" enctype="multipart/form-data">
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="tab_1_1">
                                    <div class="table-scrollable">
                                        <table class="table table-bordered table-striped table-hover">
                                            <tbody>
                                            <tr>
                                                <td>Родительская категория</td>
                                                <td>
                                                    <select name="parent_id" id="" class="form-control">
                                                        <option value="0"> - Выбрать категорию - </option>
                                                        <?php options_categories_parse($categories_tree);?>
                                                    </select>
                                                </td>
                                            </tr>
											<? foreach ($langs as $lang) { ?>
                                                <tr>
                                                    <td>Название <?= $lang ?> *</td>
                                                    <td><input type="text" name="title<?= $lang ?>" class="form-control" <?=$lang == 'EN'?'':'required'?>></td>
                                                </tr>
											<? } ?>
                                            <? foreach ($langs as $lang) { ?>
                                                <tr>
                                                    <td>Описание <?= $lang ?></td>
                                                    <td><input type="text" name="desc<?= $lang ?>" class="form-control" ></td>
                                                </tr>
                                            <? } ?>
                                            <tr>
                                                <td width="200">Фото</td>
                                                <td>
                                                    <input type="file" name="img" id="file" class="form-control">
                                                    <div class="note note-warning"
                                                         style="margin-bottom: 0px; margin-top: 10px;">
                                                        <p>
                                                            Допустимые размеры: 450x381 2мб
                                                        </p>
                                                    </div>
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

<?php if (!empty($objects)) : ?>
    <div class="row">
        <div class="portlet light">
            <div class="portlet-body">
                <form action="<?= $o_path; ?>" method="post">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-striped table-hover tree">
                            <thead>
                            <tr>
                                <th> Название</th>
                                <th width="200">Выводить на главной</th>
                                <th width="180"></th>
                                <th width="305"> Действия</th>
                            </tr>
                            </thead>
                            <tbody>
							    <?categories_tree($objects, $e_path, $del_path, 0)?>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn green"><i class="fa fa-check"></i> Обновить порядок</button>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<link rel="stylesheet" href="/static/assets/plugins/treeGrid/css/jquery.treegrid.css">
<script src="/static/assets/plugins/treeGrid/js/jquery.treegrid.js"></script>

<script>
    $(function () {
        $('.tree').treegrid({
            initialState: 'collapsed',
            treeColumn: 0,
        });
    });
    $('#plus_year').click(function(){
        if ($(this).is(':checked')){
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });
</script>

<style>
    tr td:nth-child(1) {
        padding-left: 20px !important;
    }
    td {
        position: relative;
    }
    .treegrid-expander {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
    }

    [class*=treegrid-parent-] {
        display: none;
    }

    [class*=treegrid-parent-] td:nth-child(1) {
        padding-left: 20px;
    }

    .display-inline {
        display: inline-block;
    }
</style>
