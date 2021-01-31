<?php
$hasSidebar = page_findnearest($conf['sidebar']);
// $showSidebar = $hasSidebar && ($ACT == 'show');

ob_start();
tpl_toc();
$toc_buffer = ob_get_clean();
?>

<div class="content-start mt-1">
    <div class="columns is-mobile mt-1">
        <?php if ($hasSidebar) : ?>
            <div class="column mx-3 scrollable scrollable-desktop menu-container <?php if (strlen($toc_buffer) > 0) : ?>
                    is-hidden-touch
                <?php else : ?>
                    is-hidden-mobile
                <?php endif; ?>">
                <div class="sidebar">
                    <?php include('tpl_sidebar.php') ?>
                </div>
            </div>
        <?php else : ?>
            <a class="button is-small" href="<?php echo wl('sidebar') . '&do=edit' ?>">Edit Sidebar</a>
        <?php endif; ?>

        <div id="wiki-content" class="column scrollable scrollable-desktop is-full-mobile
        <?php if (strlen($toc_buffer) > 0) : ?>
            is-three-quarters-tablet is-two-thirds-desktop
        <?php else : ?>
            is-three-quarters-tablet is-four-fifths-desktop
        <?php endif; ?>">

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

            <div class="columns is-vcentered is-mobile mt-1">
                <div class="column is-2 has-text-left is-hidden-desktop">
                    <?php if ($hasSidebar) : ?>
                        <button class="button" onclick="toggleMobileMenu('mobile-sidebar', true)">
                            <i class="fas fa-sitemap"></i>
                        </button>
                    <?php endif; ?>
                </div>
                <div class="column">
                    <div class="buttons is-centered">
                        <?php
                        $page_menus = (new \dokuwiki\Menu\PageMenu())->getItems();
                        foreach ($page_menus as $page_menu) {
                            echo '<a class="button is-white is-small" href="' . $page_menu->getLink() . '">'
                                . '<i class="mr-2">' . inlineSVG($page_menu->getSvg()) . '</i></a>';
                        }
                        ?>
                    </div>
                </div>
                <div class="column is-2 has-text-right is-hidden-tablet">
                    <?php
                    if (strlen($toc_buffer) > 0) :
                    ?>
                        <button class="button" onclick="toggleMobileMenu('mobile-toc', true)">
                            <i class="fas fa-list"></i>
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <?php html_msgarea() ?>

            <div>
                <?php tpl_flush() ?>

                <div class="mx-1">
                    <!-- wikipage start -->
                    <?php tpl_content(false) ?>
                    <!-- wikipage stop -->
                </div>
            </div>

            <div class="docInfo"><?php tpl_pageinfo() ?></div>
            <?php tpl_flush() ?>
            <?php include('tpl_footer.php') ?>
        </div>

        <?php
        if (strlen($toc_buffer) > 0) :
        ?>
            <div class="column is-hidden-mobile scrollable scrollable-desktop menu-container">
                <div>
                    <?php tpl_toc(); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
    <?php include_once('tpl_content.php') ?>
</div>


<div id="mobile-sidebar" class="mobile-menu is-hidden">
    <div class="mb-2">
        <button class="button mobile-menu-close is-danger is-fullwidth" onclick="toggleMobileMenu('mobile-sidebar', false)">
            <i class="fas fa-times fa-lg"></i>
        </button>
    </div>

    <div class="mt-6 scrollable scrollable-mobile has-text-centered">
        <?php include('tpl_sidebar.php') ?>
    </div>
</div>

<div id="mobile-toc" class="mobile-menu is-hidden">
    <div class="mb-2">
        <button class="button mobile-menu-close is-danger is-fullwidth" onclick="toggleMobileMenu('mobile-toc', false)">
            <i class="fas fa-times fa-lg"></i>
        </button>
    </div>

    <div class="mt-6 scrollable scrollable-mobile has-text-centered">
        <?php tpl_toc(); ?>
    </div>
</div>