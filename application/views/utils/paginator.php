    <?php if (!empty($paginator)) { ?>
        <?php if ($paginator->getNumPages() > 1) { ?>
            <?php if ($paginator->getPrevUrl()) { ?>
                <a href="<?= $paginator->getPrevUrl(); ?>">
                <div class="pagination__arrow pagination__arrow-prev">
                    <svg width="35" height="12" viewBox="0 0 35 12" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.469669 6.53033C0.176777 6.23744 0.176777 5.76256 0.469669 5.46967L5.24264 0.696699C5.53553 0.403806 6.01041 0.403806 6.3033 0.696699C6.59619 0.989593 6.59619 1.46447 6.3033 1.75736L2.06066 6L6.3033 10.2426C6.59619 10.5355 6.59619 11.0104 6.3033 11.3033C6.01041 11.5962 5.53553 11.5962 5.24264 11.3033L0.469669 6.53033ZM35 6.75L1 6.75V5.25L35 5.25V6.75Z"
                              fill="black" fill-opacity="0.3"></path>
                    </svg>
                </div>
                </a>
            <?php } ?>
                <ul class="pagination__list">
                <? foreach ($paginator->getPages() as $page) { ?>
                    <?php if ($page['isCurrent']) { ?>
                        <li class="pagination__item pagination__item-active">
                            <span class="pagination__link pagination__link-active"><?= $page['num'] ?></span>
                        </li>
                    <?php } else { ?>
                        <li class="pagination__item">
                            <a href="<?= $page_url ?>?page=<?= $page['num'] ?>"
                               class="pagination__link"><span><?= $page['num'] ?></span></a>
                        </li>
                    <?php } ?>
                <?php } ?>
                </ul>
            <?php if ($paginator->getNextUrl()) { ?>
                <a href="<?= $paginator->getNextUrl(); ?>" class="">
                <div class="pagination__arrow pagination__arrow-next">
                    <svg width="35" height="12" viewBox="0 0 35 12" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M34.5303 6.53033C34.8232 6.23744 34.8232 5.76256 34.5303 5.46967L29.7574 0.696699C29.4645 0.403806 28.9896 0.403806 28.6967 0.696699C28.4038 0.989592 28.4038 1.46447 28.6967 1.75736L32.9393 6L28.6967 10.2426C28.4038 10.5355 28.4038 11.0104 28.6967 11.3033C28.9896 11.5962 29.4645 11.5962 29.7574 11.3033L34.5303 6.53033ZM0 6.75L34 6.75V5.25L0 5.25L0 6.75Z"
                              fill="black" fill-opacity="0.8"></path>
                    </svg>
                </div>
                </a>
            <?php } ?>
        <?php } ?>
    <?php } ?>