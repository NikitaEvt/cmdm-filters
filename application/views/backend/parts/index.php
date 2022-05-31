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
                            <ul class="nav nav-pills">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab">Информация</a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab">Служебная информация</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="tab_1_1">
                                    <div class="table-scrollable">
                                        <table class="table table-bordered table-striped table-hover">
                                            <tbody>
                                            <tr>
                                                <td>Категория</td>
                                                <td>
                                                    <select name="category_id" id="" class="form-control "
                                                            required>
                                                        <option value="1"> - Выбрать категорию -</option>
                                                        <?php options_categories_parse($for_list);?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Выбирите модель</td>
                                                <td>
                                                    <select class="form-control" multiple multiple name="model_id[]" style="width: 100%">
                                                            <option value="Model S"> Model S </option>
                                                            <option value="Model SR"> Model SR </option>
                                                            <option value="Model 3"> Model 3 </option>
                                                            <option value="Model Y"> Model Y </option>
                                                            <option value="Model X"> Model X </option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <? foreach ($langs as $lang) { ?>
                                                <tr>
                                                    <td>Название <?= $lang ?> *</td>
                                                    <td><input type="text" name="title<?= $lang ?>" class="form-control"
                                                               required></td>
                                                </tr>
                                            <? } ?>
                                            <tr>
                                                <td>Серийный номер</td>
                                                <td><input type="text" name="part_number" class="form-control" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cостояние</td>
                                                <td>
                                                    <select class="form-control" name="condition">
                                                        <option value="1" > Новое </option>
                                                        <option value="2" > Аналог </option>
                                                        <option value="3" > БУ </option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Цена</td>
                                                <td><input type="text" name="price" class="form-control" required></td>
                                            </tr>
<!--                                            <tr>-->
<!--                                                <td>Цена со скидкой</td>-->
<!--                                                <td><input type="text" name="discount_price" class="form-control"-->
<!--                                                           required></td>-->
<!--                                            </tr>-->
                                            <tr>
                                                <td>В наличии</td>
                                                <td>
                                                    <select class="form-control" name="on_stock" required>
                                                        <option value="1" > В наличии </option>
                                                        <option value="0" > Под заказ </option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <? foreach ($langs as $lang) { ?>
                                                <tr>
                                                    <td width="200">Текст <?= $lang ?></td>
                                                    <td>
                                                        <textarea name="text<?= $lang ?>" id="text<?= $lang ?>"
                                                                  cols="30" rows="10"
                                                                  class="form-control ckeditor"></textarea>
                                                    </td>
                                                </tr>
                                            <? } ?>
                                            <tr>
                                                <td width="200">Изображение</td>
                                                <td>
                                                    <input type="file" name="images[]" id="file" multiple
                                                           class="form-control">
                                                    <div class="note note-warning"
                                                         style="margin-bottom: 0px; margin-top: 10px;">
                                                        <p>
                                                            Допустимое разрешение: 1200x800 2мб
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
                                <div class="tab-pane fade" id="tab_1_2">
                                    <div class="table-scrollable">
                                        <table class="table table-bordered table-striped table-hover">
                                            <tbody>
                                            <? foreach ($langs as $lang) { ?>
                                                <tr>
                                                    <td width="200">Заголовок <?= $lang ?></td>
                                                    <td>
                                                        <input type="text" name="seoTitle<?= $lang ?>"
                                                               class="form-control">
                                                    </td>
                                                </tr>
                                            <? } ?>
                                            <? foreach ($langs as $lang) { ?>
                                                <tr>
                                                    <td width="200">Ключевые слова <?= $lang ?></td>
                                                    <td>
                                                        <textarea name="seoKeywords<?= $lang ?>"
                                                                  id="keywords<?= $lang ?>" cols="15" rows="5"
                                                                  class="form-control"></textarea>
                                                    </td>
                                                </tr>
                                            <? } ?>
                                            <? foreach ($langs as $lang) { ?>
                                                <tr>
                                                    <td width="200">Описание <?= $lang ?></td>
                                                    <td>
                                                        <textarea name="seoDesc<?= $lang ?>"
                                                                  id="description<?= $lang ?>" cols="30"
                                                                  rows="10" class="form-control"></textarea>
                                                    </td>
                                                </tr>
                                            <? } ?>
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

<div class="row">
    <div class="col-md-3">
        <div class="portlet light">
            <div class="portlet-body">
                <div id="jstree">
                    <ul>
                        <li>
                            <span>Все товары</span>
                        </li>
                    </ul>
                    <? jstree($categories) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="portlet light">
            <div class="portlet-body" id="load">
                <div class="col-md-12">
                    <form action="/backend/parts/" method="get" enctype="text/plain">
                        <div class="margin-bottom-5" style="text-align: right;">
                            Пойск продукта
                            <input type="text" style="width: 240px; padding-top: 1px; display: inline-block;"
                                   class="form-control form-filter input-sm" name="query" value="">
                            <button class="btn btn-sm btn-success filter-submit margin-bottom">
                                <i class="fa fa-search"></i> Искать
                            </button>
                            <a href="/backend/parts/" class="btn btn-sm btn-default filter-cancel">
                                <i class="fa fa-times"></i> Cбросить</a>
                        </div>
                    </form>
                </div>
                <form action="<?= $o_path; ?>" method="post" id="products">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-striped table-hover">
                            <tr>
                                <td width="50"><i class="fa fa-arrows"></i></td>
                                <td>Название</td>
                                <td width="180">Артикул</td>
                                <td width="60">Хиты продаж</td>
                                <td width="60"><i class="fa fa-eye"></i></td>
                                <td>Действия</td>
                            </tr>
                            <? foreach ($objects as $object) { ?>
                                <tr>
                                    <td>
                                        <input style="width:50px;margin-left: 0;margin-right: 15px;" type="text"
                                               onkeyup="this.value=this.value.replace(/[^\d]/,\'\')" min="1"
                                               class="form-control text-center sorder" value="<?= $object->sorder ?>"
                                               name="so[<?= $object->id ?>]">
                                    </td>
                                    <td><a href="<?= $e_path . $object->id . '/' ?>"><?= $object->titleRU ?></a></td>
                                    <td><?= $object->part_number ?></td>
                                    <td class="align-middle">
                                        <?php $cmod = (!empty($object->best)) ? 'checked' : '' ?>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" <?= $cmod ?> value="<?= $object->id ?>"
                                                   data-col="best" data-table="<?= $table ?>"
                                                   class="mine_change_check">&nbsp;
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="align-middle">
                                        <?php $cmod = (!empty($object->isShown)) ? 'checked' : '' ?>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" <?= $cmod ?> value="<?= $object->id ?>"
                                                   data-col="isShown" data-table="<?= $table ?>"
                                                   class="mine_change_check">&nbsp;
                                            <span></span>
                                        </label>
                                    </td>
                                    <td width="120" class="align-middle">
                                        <a href="<?= $e_path . $object->id . '/' ?>"
                                           class="btn btn-xs default btn-editable green-stripe">
                                            <i class="glyphicon glyphicon-edit"></i>
                                        </a>
                                        <a href="<?= $del_path . $object->id . '/' ?>"
                                           class="btn btn-xs default btn-editable red-stripe mine_delete_row">
                                            <i class="glyphicon glyphicon-remove-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                            <? } ?>
                        </table>
                    </div>
                    <button type="submit" class="btn green"><i class="fa fa-check"></i> Обновить порядок</button>
                </form>
                <div id="paginator" style="margin-top: 20px;"></div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="/assets/plugins/jstree/themes/default/style.min.css">
<script src="/assets/plugins/jstree/jstree.min.js"></script>

<link rel="stylesheet" href="/assets/plugins/pagination/simplePagination.css">
<script src="/assets/plugins/pagination/jquery.simplePagination.js"></script>

<script>
    $(function () {
        $('#jstree').on('select_node.jstree', function (e, data) {
            location.href = '?cat=' + data.node.data.id;
        }).jstree();

        $('#paginator').pagination({
            items: <?=$count?>,
            itemsOnPage: 40,
            hrefTextPrefix: '?cat=<?=isset($_GET['cat']) ? $_GET['cat'] : ''?>&page=',
            cssStyle: 'light-theme',
            currentPage: <?=isset($_GET['page']) ? $_GET['page'] : 1?>
        });
    });

    $('body').on('keyup', 'input[name="price"]', function() {
        $(this).val($(this).val().replace(',', '.'));
    });
    $('body').on('keyup', 'input[name="old_price"]', function() {
        $(this).val($(this).val().replace(',', '.'));
    });



</script>

<style>
    .jstree-themeicon-custom {
        color: #ffac00
    }
</style>
