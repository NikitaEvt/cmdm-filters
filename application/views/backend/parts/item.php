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
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li class="active">
                        <a href="#tab_1_1" data-toggle="tab">Информация</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_1_1">
                        <form method="post" enctype="multipart/form-data">
                            <div class="table-scrollable">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <td>Категория *</td>
                                        <td>
                                            <select name="category_id" id="" class="form-control "
                                                    required>
                                                <option value="1"> - Выбрать категорию -</option>
                                                <?php options_categories_parse($for_list, 0, 0, $item->category_id); ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Выбирите модель</td>
                                        <td>
                                            <select class="form-control" multiple multiple name="model_id[]"
                                                    style="width: 100%">
                                                <?php $select1 = '';
                                                $select2 = '';
                                                $select3 = '';
                                                $select4 = '';
                                                $select5 = '';
                                                foreach ($model_parts as $model_part) {
                                                    if ($model_part->model_id == 'Model S') {
                                                        $select1 = 'selected';
                                                    }
                                                    if ($model_part->model_id == 'Model SR') {
                                                        $select2 = 'selected';
                                                    }
                                                    if ($model_part->model_id == 'Model 3') {
                                                        $select3 = 'selected';
                                                    }
                                                    if ($model_part->model_id == 'Model Y') {
                                                        $select4 = 'selected';
                                                    }
                                                    if ($model_part->model_id == 'Model X') {
                                                        $select5 = 'selected';
                                                    }
                                                } ?>
                                                <option value="Model S" <?= $select1 ?>> Model S</option>
                                                <option value="Model SR" <?= $select2 ?>> Model SR</option>
                                                <option value="Model 3" <?= $select3 ?>> Model 3</option>
                                                <option value="Model Y" <?= $select4 ?>> Model Y</option>
                                                <option value="Model X" <?= $select5 ?>> Model X</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <? foreach ($langs as $lang) { ?>
                                        <tr>
                                            <td>Название <?= $lang ?> *</td>
                                            <td><input type="text" name="title<?= $lang ?>"
                                                       value="<?= $item->{'title' . $lang} ?>" class="form-control"
                                                    <?= $lang == 'EN' ? '' : 'required' ?>></td>
                                        </tr>
                                    <? } ?>
                                    <tr>
                                        <td>Серийный номер</td>
                                        <td><input type="text" name="part_number" value="<?= $item->part_number ?>"
                                                   class="form-control" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cостояние</td>
                                        <td>
                                            <select class="form-control" name="condition">
                                                <option value="1" <?= $item->condition == 1 ? 'selected' : '' ?>>
                                                    Новое
                                                </option>
                                                <option value="2" <?= $item->condition == 2 ? 'selected' : '' ?>>
                                                    Аналог
                                                </option>
                                                <option value="3" <?= $item->condition == 3 ? 'selected' : '' ?>> БУ
                                                </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Цена</td>
                                        <td><input type="text" name="price" class="form-control"
                                                   value="<?= $item->price ?>" required></td>
                                    </tr>
                                    <!--                                    <tr>-->
                                    <!--                                        <td>Цена со скидкой</td>-->
                                    <!--                                        <td><input type="text" name="discount_price" value="-->
                                    <? //=$item->discount_price ?><!--" class="form-control"-->
                                    <!--                                                   required></td>-->
                                    <!--                                    </tr>-->
                                    <tr>
                                        <td>В наличии</td>
                                        <td><select class="form-control" name="on_stock" required>
                                                <option value="1" <?= $item->on_stock == 1 ? 'selected' : '' ?>> В
                                                    наличии
                                                </option>
                                                <option value="0" <?= $item->on_stock == 0 ? 'selected' : '' ?>> Под
                                                    заказ
                                                </option>
                                            </select>
                                        </td>
                                    </tr>

                                    <? foreach ($langs as $lang) { ?>
                                        <tr>
                                            <td width="200">Текст <?= $lang ?></td>
                                            <td>
                                                        <textarea name="text<?= $lang ?>" id="text<?= $lang ?>"
                                                                  cols="30" rows="10"
                                                                  class="form-control ckeditor"><?= $item->{'text' . $lang} ?></textarea>
                                            </td>
                                        </tr>
                                    <? } ?>
                                    <tr>
                                        <td width="200">Изображение</td>
                                        <td>
                                            <input type="file" name="images[]" id="file" class="form-control" multiple>
                                            <div class="note note-warning"
                                                 style="margin-bottom: 0px; margin-top: 10px;">
                                                <p>
                                                    Допустимое разрешение: 1200x800 2мб
                                                </p>
                                            </div>
                                            <?php if (!empty($item->images)):
                                                foreach ($item->images as $image) {
                                                    if (empty($image->img)) continue; ?>
                                                    <?php $src = newthumbs($image->img, 'parts', 250, 250, '250x250x1', 1) ?>
                                                    <div class="mt-element-card mt-element-overlay margin-top-10">
                                                        <div class="col-lg-3 col-md-1">
                                                            <div class="mt-card-item">
                                                                <div class="mt-card-avatar mt-overlay-1">
                                                                    <img src="<?= $src ?>"/>
                                                                    <div class="mt-overlay">
                                                                        <ul class="mt-info">
                                                                            <li>
                                                                                <a class="btn red mine_delete_photo"
                                                                                   data-table="parts_img"
                                                                                   data-path="parts"
                                                                                   data-tb="1"
                                                                                   data-id="<?= $image->id ?>"
                                                                                   href="javascript:;">
                                                                                    <i class="fa fa-ban"></i>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="text" name="image_order[<?= $image->id ?>]"
                                                                   value="<?= $image->sorder ?>"
                                                                   class="form-control image_order"
                                                                   style="text-align: center">
                                                        </div>
                                                    </div>
                                                <? } ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="200">&nbsp;</td>
                                        <td>
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i> Обновить
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
        </div>
    </div>
</div>

