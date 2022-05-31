<?php
if (isset($orders_count))
    $order_count = '<span class="label label-sm label-danger">' . $orders_count . '</span>';
else
    $order_count = '';
if (isset($admin_type) && $admin_type  == 1){
    $sidebar_menu = array(
        'menu' => array('name' => 'Меню сайта ', 'ico' => '<i class="fa fa-list"></i>'),
        'orders' => array('name' => 'Заказы ' . $order_count, 'ico' => '<i class="fa fa-shopping-cart"></i>'),
        'products' => array('name' => 'Товары', 'ico' => '<i class="fa fa-bookmark"></i>',
            'childs' => [
                'products' => ['name' => 'Товары', 'ico' => '<i class="fa fa-list"></i>'],
                'categories' => ['name' => 'Категории', 'ico' => '<i class="fa fa-list"></i>'],
                'brands' => ['name' => 'Бренды', 'ico' => '<i class="fa fa-list"></i>'],
                'features' => ['name' => 'Характеристики', 'ico' => '<i class="fa fa-list"></i>'],
            ]
        ),

        'articles' => array('name' => 'Новости', 'ico' => '<i class="fa fa-calendar-minus-o"></i>'),
        'clients' => array('name' => 'Клиенты', 'ico' => '<i class="fa fa-user"></i>'),
        'gallery' => array('name' => 'Галерея', 'ico' => '<i class="fa fa-photo"></i>'),
        'slider' => array('name' => 'Слайдер', 'ico' => '<i class="fa fa-photo"></i>'),

        'constants' => array('name' => 'Константы', 'ico' => '<i class="fa fa-globe"></i>')
    );
} elseif (isset($admin_type) && $admin_type  == 2){
    $sidebar_menu = array(
        'orders' => array('name' => 'Заказы ' . $order_count, 'ico' => '<i class="fa fa-shopping-cart"></i>'),
        'products' => array('name' => 'Товары', 'ico' => '<i class="fa fa-bookmark"></i>',
            'childs' => [
                'products' => ['name' => 'Товары', 'ico' => '<i class="fa fa-list"></i>'],
                'categories' => ['name' => 'Категории', 'ico' => '<i class="fa fa-list"></i>'],
                'brands' => ['name' => 'Бренды', 'ico' => '<i class="fa fa-list"></i>'],
                'features' => ['name' => 'Характеристики', 'ico' => '<i class="fa fa-list"></i>'],
            ]
        ),
        'articles' => array('name' => 'Новости', 'ico' => '<i class="fa fa-calendar-minus-o"></i>'),
        'clients' => array('name' => 'Клиенты', 'ico' => '<i class="fa fa-user"></i>'),

    );
} else {
    $sidebar_menu = array(
        'menu' => array('name' => 'Меню сайта ', 'ico' => '<i class="fa fa-list"></i>'),
        'orders' => array('name' => 'Заказы ' . $order_count, 'ico' => '<i class="fa fa-shopping-cart"></i>'),
        'products' => array('name' => 'Товары', 'ico' => '<i class="fa fa-bookmark"></i>',
            'childs' => [
                'products' => ['name' => 'Товары', 'ico' => '<i class="fa fa-list"></i>'],
                'categories' => ['name' => 'Категории', 'ico' => '<i class="fa fa-list"></i>'],
                'brands' => ['name' => 'Бренды', 'ico' => '<i class="fa fa-list"></i>'],
                'features' => ['name' => 'Характеристики', 'ico' => '<i class="fa fa-list"></i>'],
            ]
        ),

        'articles' => array('name' => 'Новости', 'ico' => '<i class="fa fa-calendar-minus-o"></i>'),
        'clients' => array('name' => 'Клиенты', 'ico' => '<i class="fa fa-user"></i>'),
        'gallery' => array('name' => 'Галерея', 'ico' => '<i class="fa fa-photo"></i>'),
        'slider' => array('name' => 'Слайдер', 'ico' => '<i class="fa fa-photo"></i>'),

        'constants' => array('name' => 'Константы', 'ico' => '<i class="fa fa-globe"></i>')
    );
}

?>
<!-- BEGIN SIDEBAR MENU -->

<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
    data-slide-speed="200" style="padding-top: 20px">
   <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
    <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
            <span></span>
        </div>
    </li>1
    <!-- END SIDEBAR TOGGLER BUTTON -->
    <?php foreach ($sidebar_menu as $key => $val): ?>
        <?php if (!isset($val['childs'])): ?>
            <li class="nav-item <?= ($key == uri(2)) ? 'start active open' : '' ?>">
                <a href="/backend/<?= $key ?>/" class="nav-link ">
                    <?= $val['ico'] ?>
                    <span class="title"><?= $val['name'] ?></span>
                    <?php if ($key == uri(2)) : ?>
                        <span class="selected"></span>
                    <?php endif; ?>
                </a>
            </li>
        <?php else: ?>
            <?php
            $flag = false;
            foreach ($val['childs'] as $k => $v) {
                if ($k == uri(2)) {
                    $flag = true;
                }
            }
            ?>
            <li class="nav-item <?= ($flag) ? 'start active open' : '' ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <?= $val['ico'] ?>
                    <span class="title"><?= $val['name'] ?></span>
                    <?php if ($flag) : ?>
                        <span class="selected"></span>
                    <?php endif; ?>
                    <span class="arrow <?= ($flag) ? ' open' : '' ?>"></span>
                </a>
                <?php if (!empty($val['childs'])) : ?>
                    <ul class="sub-menu">
                        <?php foreach ($val['childs'] as $k => $v): ?>
                            <?php
                            $status = ($k == uri(2)) ? 'start active open' : '';
                            $link = $k;
                            ?>
                            <li class="nav-item <?= $status ?>">
                                <a href="/backend/<?= $link ?>/" class="nav-link <?= $status ?>">
                                    <?= $v['ico'] ?>
                                    <span class="title"><?= $v['name'] ?></span>
                                    <?php if ($k == uri(2)) : ?>
                                        <span class="selected"></span>
                                    <?php endif; ?>
                                    <?php if (!empty($v['badge']) && isset($v['badge_value'])): ?>
                                        <span class="badge badge-<?= $v['badge'] ?>"><?= $v['badge_value'] ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>
<!-- END SIDEBAR MENU -->
