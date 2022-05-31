<div class="header__language">
    <?php if (!empty($langs_array)) : ?>
        <?php foreach ($langs_array as $lang => $link): ?>
            <?php
            $langLink = $protocol . $host . '/' . \strtolower($lang);
            $langLink .= (isset($page_uri)) ? '/' . $page_uri : '';
            if (is_array($link)) {
                foreach ($link as $item) {
                    $langLink .= (!empty($item)) ? '/' . $item : '';
                }
            } else {
                $langLink .= (!empty($link)) ? '/' . $link : '';
            }
            $data_link_without_get = $langLink;
            $langLink .= (!empty($get_data)) ? '?' . $get_data : '';
            ?>
            <div class="header__lang <?= uri(1) == $lang || $_SESSION['lang'] == $lang ? 'header__lang-active' : '' ?>">
                <a href="javascript:;" data-link="<?= $data_link_without_get ?>"
                   title="<?= $lang ?>"
                   class="header__choose <?= uri(1) == $lang || $_SESSION['lang'] == $lang ? 'active' : '' ?>"
                   onclick="changeLangue(this)">
                    <?= $lang_title[$lang] ?>
                </a>
            </div>
            <?php endforeach; ?>
    <?php endif; ?>
</div>