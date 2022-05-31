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
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="on_stock" value="999" class="form-control" >
                <div class="panel-body">
                    <ul class="nav nav-pills">
                        <ul class="nav nav-pills">
                            <li class="active">
                                <a href="#tab_1_1" data-toggle="tab">Общая информация</a>
                            </li>
                            <li class="">
                                <a href="#tab_1_2" data-toggle="tab">Характеристики</a>
                            </li>
                            <li>
                                <a href="#tab_1_3" data-toggle="tab">Служебная информация</a>
                            </li>
                        </ul>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_1_1">
                            <div class="table-scrollable">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <td>Модель</td>
                                        <td>
                                            <select name="model_id" id="" class="form-control">
                                                <option value="0"> - Выбрать Модель - </option>
                                                <?php foreach ($models as $model) {?>
                                                    <option value="<?=$model->id?>" <?= $model->id == $item->model_id?'selected':''?>> <?=$model->title?> </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                        <tr>
                                            <td>Заголовок *</td>
                                            <td>
                                                <input type="text" name="titleRU" value="<?=$item->titleRU?>" class="form-control">
                                            </td>
                                        </tr>
<!--                                    --><?// foreach ($langs as $lang) { ?>
<!--                                        <tr>-->
<!--                                            <td width="200">Описание --><?//= $lang ?><!--</td>-->
<!--                                            <td>-->
<!--                                                        <textarea name="desc--><?//= $lang ?><!--" id="desc--><?//= $lang ?><!--"-->
<!--                                                                  cols="15" rows="5"-->
<!--                                                                  class="form-control">--><?//=$item->{'desc'.$lang}?><!--</textarea>-->
<!--                                            </td>-->
<!--                                        </tr>-->
<!--                                    --><?// } ?>
                                    <? foreach ($langs as $lang) { ?>
                                        <tr>
                                            <td width="200">Текст <?= $lang ?></td>
                                            <td>
                                                        <textarea name="text<?= $lang ?>" id="text<?= $lang ?>"
                                                                  cols="30" rows="10"
                                                                  class="form-control ckeditor"><?=$item->{'text'.$lang}?></textarea>
                                            </td>
                                        </tr>
                                    <? } ?>
                                    <tr>
                                        <td>Цена</td>
                                        <td><input type="text" name="price" class="form-control" value="<?=$item->price?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Цена со скидкой</td>
                                        <td><input type="text" name="discount_price" class="form-control" value="<?=$item->discount_price?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Батерея</td>
                                        <td><input type="text" name="battery" class="form-control" value="<?=$item->battery?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Запас хода</td>
                                        <td><input type="text" name="travel" class="form-control" value="<?=$item->travel?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Разгон</td>
                                        <td><input type="text" name="acceleration" class="form-control" value="<?=$item->acceleration?>"></td>
                                    </tr>
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
                                                    <?php $src = newthumbs($image->img, 'auto', 250, 250, '250x250x1', 1) ?>
                                                    <div class="mt-element-card mt-element-overlay margin-top-10">
                                                        <div class="col-lg-3 col-md-1">
                                                            <div class="mt-card-item">
                                                                <div class="mt-card-avatar mt-overlay-1">
                                                                    <img src="<?= $src ?>"/>
                                                                    <div class="mt-overlay">
                                                                        <ul class="mt-info">
                                                                            <li>
                                                                                <a class="btn red mine_delete_photo"
                                                                                   data-table="auto_img"
                                                                                   data-path="auto"
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
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i> Сохранить
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
                                    <tr>
                                        <td width="200">Тип продукта *</td>
                                        <td>
                                            <select name="type_id" class="form-control" style="width: 250px;"
                                                    id="auto-features">
                                                <option value="">--Без тип продукта--</option>
                                                <?php if (!empty($auto_types)) { ?>
                                                    <?php foreach ($auto_types as $type) { ?>
                                                        <option value="<?= $type->id ?>" <?= $item->type_id == $type->id ? 'selected' : '' ?>><?= $type->nameRU ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div style="padding: 15px;" id="caracteristics_list">
                                    <?php if (!empty($caracteristics_list)) { ?>
                                        <?php foreach ($caracteristics_list as $element) { ?>
                                            <?php if (!empty($element['feature_values'])) { ?>
                                                <div class="col-md-3"
                                                     style="height: 120px; overflow-y: scroll;margin-bottom: 15px;">
                                                    <div style="padding: 10px; border-radius: 5px;background-color: #8080801a; width: 100%;">
                                                        <p style="padding: 0px; margin: 0px;"><b>
                                                                <?= $element['feature_name'] ?>
                                                                (<?= count($element['feature_values']) ?>)</b></p>
                                                        <?php foreach ($element['feature_values'] as $value) { ?>
                                                            <?php
                                                            $checked = '';
                                                            if (!empty($selected_features)) {
                                                                foreach ($selected_features as $check) {
                                                                    if ($check->feature_id == $element['feature_id'] && $check->feature_value_id == $value['value_id']) {
                                                                        $checked = 'checked';
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            ?>

                                                            <?php if ($element['feature_type'] == 11) { ?>
                                                                <input id="<?= $element['feature_id'] ?>-<?= $value['value_id'] ?>"
                                                                       type="radio"
                                                                       name="radio_feature[<?= $element['feature_id'] ?>]"
                                                                       value="<?= $value['value_id'] ?>"
                                                                    <?= $checked ?>
                                                                >
                                                                <label for="<?= $element['feature_id'] ?>-<?= $value['value_id'] ?>"><?= $value['value_name'] ?></label>
                                                                <br>
                                                            <?php } elseif ($element['feature_type'] == 3) {  // dump($value)?>
                                                                <div style="overflow: hidden; width: 100%;margin-bottom: 5px;">
                                                                    <input id="<?= $element['feature_id'] ?>-<?= $value['value_id'] ?>"
                                                                           type="checkbox"
                                                                           name="features[<?= $element['feature_id'] ?>][][<?= $value['value_id'] ?>]"
                                                                           value="<?= $value['value_id'] ?>"
                                                                        <?= $checked ?>
                                                                           style="float: left; margin-right: 5px;"
                                                                    >
                                                                    <label for="<?= $element['feature_id'] ?>-<?= $value['value_id'] ?>"> </label>
                                                                    <div style="background-color: <?= $value['color'] ?>; width: 15px; height: 15px; border-radius: 15px;float: left;margin-top: 3px;">
                                                                        <span style="margin-left: 20px;"><? //= $value['value_name'] ?></span>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                <input id="<?= $element['feature_id'] ?>-<?= $value['value_id'] ?>"
                                                                       type="checkbox"
                                                                       name="features[<?= $element['feature_id'] ?>][][<?= $value['value_id'] ?>]"
                                                                       value="<?= $value['value_id'] ?>"
                                                                    <?= $checked ?>
                                                                >
                                                                <label for="<?= $element['feature_id'] ?>-<?= $value['value_id'] ?>"><?= $value['value_name'] ?></label>
                                                                <br>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <br>
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i>
                                                Изменить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_1_3">
                            <div class="table-scrollable">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                    <? foreach ($langs as $lang) { ?>
                                        <tr>
                                            <td width="200">Заголовок <?= $lang ?></td>
                                            <td>
                                                <input type="text" value="<?= $item->{'seoTitle' . $lang} ?>"
                                                       name="seoTitle<?= $lang ?>" class="form-control">
                                            </td>
                                        </tr>
                                    <? } ?>
                                    <? foreach ($langs as $lang) { ?>
                                        <tr>
                                            <td width="200">Ключевые слова <?= $lang ?></td>
                                            <td>
                                                <textarea name="seoKeywords<?= $lang ?>" id="seoKeywords<?= $lang ?>"
                                                          cols="30" rows="10"
                                                          class="form-control"><?= $item->{'seoKeywords' . $lang} ?></textarea>
                                            </td>
                                        </tr>
                                    <? } ?>
                                    <? foreach ($langs as $lang) { ?>
                                        <tr>
                                            <td width="200">Описание <?= $lang ?></td>
                                            <td>
                                                <textarea name="seoDesc<?= $lang ?>" id="seoDesc<?= $lang ?>" cols="30"
                                                          rows="10"
                                                          class="form-control"><?= $item->{'seoDesc' . $lang} ?></textarea>
                                            </td>
                                        </tr>
                                    <? } ?>
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

<link rel="stylesheet" href="/assets/plugins/jquery-minicolors/jquery.minicolors.css">
<script src="/assets/plugins/jquery-minicolors/jquery.minicolors.min.js"></script>

<script>
    $(function () {
        $('.minicolors-input').minicolors({});
    })
    $('#auto-features').on('change', function () {
        var  type_id = $("select[name='type_id']").val();
        $.ajax({
            url: '/backend/auto/auto_features/', // путь к обработчику
            type: 'POST', // метод отправки
            data: {type_id: type_id, id: "<?=$item->id?>"},
            success: function (data) {
                console.log("УСПЕХ"); // выводим сообщение в консоль
                $("#caracteristics_list").html(data);
            },
            error: function (data) {
                console.log(data); // выводим ошибку в консоль
            }
        });
        return false;
    });
</script>