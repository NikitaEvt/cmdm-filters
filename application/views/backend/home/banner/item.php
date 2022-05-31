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
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_1_1">
                            <div class="table-scrollable">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                    <? foreach ($langs as $lang) { ?>
                                        <tr>
                                            <td>Заголовок <?=$lang?>*</td>
                                            <td>
                                                <input type="text" name="title<?=$lang?>" value="<?=$item->{'title'.$lang}?>" class="form-control">
                                            </td>
                                        </tr>
                                    <? } ?>

                                    <? foreach ($langs as $lang) { ?>
                                        <tr>
                                            <td>Подзаголовк <?=$lang?></td>
                                            <td>
                                                <input type="text" name="subtitle<?=$lang?>" value="<?=$item->{'subtitle'.$lang}?>" class="form-control">
                                            </td>
                                        </tr>
                                    <? } ?>
                                    <? foreach ($langs as $lang) { ?>
                                        <tr>
                                            <td>Ссылка <?=$lang?></td>
                                            <td><input type="text" name="url<?=$lang?>" value="<?=$item->{'url'.$lang}?>" class="form-control"></td>
                                        </tr>
                                    <? } ?>
                                    <?foreach ($langs as $lang) {?>
                                    <tr>
                                        <td width="200">Изображение <?=$lang?>*</td>
                                        <td>
                                            <input type="file" name="img<?=$lang?>" id="file" class="form-control" >
                                            <div class="note note-warning" style="margin-bottom: 0px; margin-top: 10px;">
                                                <p>
                                                    Допустимое разрешение: 954x410 2мб
                                                </p>
                                            </div>
                                            <?php if (!empty($item->{'img'.$lang})): ?>
                                                <?php $src = newthumbs($item->{'img'.$lang}, $table, 250, 250, '250x250x1', 1) ?>
                                                <br>
                                                <div class="mt-element-card mt-element-overlay">
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="mt-card-item">
                                                            <div class="mt-card-avatar mt-overlay-1">
                                                                <img src="<?= $src ?>"/>
                                                                <div class="mt-overlay">
                                                                    <ul class="mt-info">
                                                                        <li>
                                                                            <a class="btn red mine_delete_photo"
                                                                               data-table="<?=$table?>"
                                                                               data-id="<?= $item->id ?>"
                                                                               data-column="img<?= $lang ?>"
                                                                               href="javascript:;">
                                                                                <i class="fa fa-ban"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?}?>
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
</script>