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
            <div class="column scrollable scrollable-desktop menu-container <?php if (strlen($toc_buffer) > 0) : ?>
                    is-hidden-touch
                <?php else : ?>
                    is-hidden-mobile
                <?php endif; ?>">
                <div class="sidebar pl-2">
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
        <div class="float-menu">
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

            
        </div>

        <div>
            <?php tpl_flush() ?>

            <div>
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
            <div id="desktop-toc">
                <?php tpl_toc(); ?>
            </div>
        </div>
    <?php endif; ?>

    </div>
    <?php include_once('tpl_content.php') ?>
</div>


<div id="mobile-sidebar" class="mobile-menu sidebar is-hidden">
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