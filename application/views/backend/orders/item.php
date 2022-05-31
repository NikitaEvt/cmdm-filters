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
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_1_1">
                        <form method="post" enctype="multipart/form-data">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="portlet yellow-crusta box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>Детали заказа
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Заказ:</div>
                                                    <div class="col-md-7 value"> #<?= $item->id ?>
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Статус:</div>
                                                    <div class="col-md-7 value">
                                                        <?
                                                        $status = [
                                                            'new' => 'Новый',
                                                            'progress' => 'В обработке',
                                                            'finished' => 'Закрыт',
                                                            'canceled' => 'Отменён'
                                                        ]
                                                        ?>
                                                        <select name="status" id="status" class="form-control">
                                                            <? foreach ($status as $key => $title) { ?>
                                                                <option value="<?= $key ?>" <?= ($item->status == $key) ? 'selected' : '' ?>><?= $title ?></option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Время заказа:</div>
                                                    <div class="col-md-7 value"><?= date('d.m.Y H:i:s', strtotime($item->added)) ?></div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Общая стоимость</div>
                                                    <div class="col-md-7 value"> <?= $item->total ?> ($)
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="portlet blue-hoki box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>Информация заказчика
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Имя:</div>
                                                    <div class="col-md-7 value"> <?= $item->name ?></div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Фамилия:</div>
                                                    <div class="col-md-7 value"> <?= $item->surname ?></div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Страна:</div>
                                                    <div class="col-md-7 value"> <?= $item->country ?></div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Город:</div>
                                                    <div class="col-md-7 value"> <?= $item->city ?></div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Адрес:</div>
                                                    <div class="col-md-7 value"> <?= $item->street ?></div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Номер дома:</div>
                                                    <div class="col-md-7 value"> <?= $item->house ?></div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Квартира:</div>
                                                    <div class="col-md-7 value"> <?= $item->apartment_number ?></div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> ZIP:</div>
                                                    <div class="col-md-7 value"> <?= $item->zip ?></div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Email:</div>
                                                    <div class="col-md-7 value"> <?= $item->email ?> </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Номер телефона:</div>
                                                    <div class="col-md-7 value"> <?= $item->phone ?> </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Пожелание:</div>
                                                    <div class="col-md-7 value"> <?= $item->mesaj ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="portlet grey-cascade box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>Корзина
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-bordered table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th> Товар</th>
                                                            <th> Цена</th>
                                                            <th width="80"> Кол-во</th>
                                                            <th width="100"> Общая стоимость</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <? foreach ($products as $product) { ?>
                                                            
                                                            <tr>
                                                                <td>
                                                                    <a href="/backend/products/item/<?= $product->product_id ?>"
                                                                       target="_blank"> <?= $product->product->title ?> </a>
                                                                </td>
                                                                <td> <?= $product->price ?> $</td>
                                                                <td><?= $product->qty ?></td>
                                                                <td> <?= $product->total ?> $</td>
                                                            </tr>
                                                        <? } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: center;">
                                <button class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.refund_money').click(function () {
        let prompt = window.prompt("Укажите сумму возврата. Максимальное значение <?= $item->total ?>", '<?= $item->total ?>');
        if(prompt) {
            $.ajax({
                url: '/refund_money/', // путь к обработчику
                type: 'POST', // метод отправки
                data: {order_id: "<?= $item->id ?>", AMOUNT:prompt},
                success: function (data) {
                    if (data == 1){
                        alert('Запрос на возврат денежных средств был оправлен в банк!');
                        location.reload();
                    } else {
                        alert('Ошибка:'+ data);
                    }
                },
                error: function (data) {
                    console.log(data);  // выводим ошибку в консоль
                }
            });
        }
    });
</script>
