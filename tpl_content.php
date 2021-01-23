<!-- BREADCRUMBS -->
<?php if ($conf['breadcrumbs'] || $conf['youarehere']) : ?>
    <div class="breadcrumbs">
        <?php if ($conf['youarehere']) : ?>
            <div class="youarehere"><?php tpl_youarehere() ?></div>
        <?php endif ?>
        <?php if ($conf['breadcrumbs']) : ?>
            <div class="trace"><?php tpl_breadcrumbs() ?></div>
        <?php endif ?>
    </div>
<?php endif ?>

<?php
ob_start();
tpl_toc();
$toc = ob_get_clean();
?>

<div class="columns">
    <div class="column">

        <div class="buttons is-right">
            <?php
            $page_menus = (new \dokuwiki\Menu\PageMenu())->getItems();
            foreach ($page_menus as $page_menu) {
                echo '<a class="button is-white is-small" href="' . $page_menu->getLink() . '">'
                    . '<i class="mr-2">' . inlineSVG($page_menu->getSvg()) . '</i></a>';
            }
            ?>
        </div>

        <?php html_msgarea() ?>

        <div>
            <?php tpl_flush() ?>
            <?php tpl_includeFile('pageheader.html') ?>

            <div id="wiki-content">
                <!-- wikipage start -->
                <?php tpl_content(false) ?>
                <!-- wikipage stop -->
            </div>

            <?php tpl_includeFile('pagefooter.html') ?>
        </div>

        <div class="docInfo"><?php tpl_pageinfo() ?></div>

        <?php tpl_flush() ?>
    </div>

    <?php
    if (strlen($toc) > 0) {
    ?>
        <div class="column is-3">
            <?php echo $toc ?>

        </div>
    <?php } ?>

</div>