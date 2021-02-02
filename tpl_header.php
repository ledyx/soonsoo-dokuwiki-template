<?php
// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
?>

<?php
$hasSidebar = page_findnearest($conf['sidebar']);
// $showSidebar = $hasSidebar && ($ACT == 'show');

ob_start();
tpl_toc();
$toc_buffer = ob_get_clean();
?>

<!-- ********** HEADER ********** -->
<nav class="navbar is-fixed-top is-white" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="<?php echo wl() ?>">
            <?php
            // get logo either out of the template images folder or data/media folder
            $logoSize = array();
            $logo = tpl_getMediaFile(array(':wiki:logo.png', ':logo.png', 'images/logo.png'), false, $logoSize);

            // display logo and wiki title in a link to the home page
            echo '<img src="' . $logo . '" class="mr-2" alt="" /> <span class="subtitle">' . $conf['title'] . '</span>';
            ?>
        </a>

        <a role="button" id="navbar-burger" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasic">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasic" class="navbar-menu">

        <div class="navbar-start">
            <div class="navbar-item is-expanded">
                <?php tpl_searchform(); ?>
            </div>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
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
                                if ($page_menu->getLink() == '#dokuwiki__top') {
                                    echo '<a class="button is-white is-small" id="scroll-top-button">'
                                    . '<i class="mr-2">' . inlineSVG($page_menu->getSvg()) . '</i></a>';
                                }
                                else {
                                    echo '<a class="button is-white is-small" href="' . $page_menu->getLink() . '">'
                                    . '<i class="mr-2">' . inlineSVG($page_menu->getSvg()) . '</i></a>';
                                }
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
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    <?php echo $lang['site_tools']; ?>
                </a>

                <div class="navbar-dropdown">
                    <?php
                    // echo (new \dokuwiki\Menu\SiteMenu())->getItems('action ', false);
                    $site_menus = (new \dokuwiki\Menu\SiteMenu())->getItems('action ', false);
                    foreach ($site_menus as $site_menu) {
                        echo '<a class="navbar-item" href="' . $site_menu->getLink() . '">'
                            . '<i class="mr-2">' . inlineSVG($site_menu->getSvg()) . '</i>'
                            . '<span>' . $site_menu->getLabel() . '</span>'
                            . '</a>';
                    }
                    ?>
                </div>
            </div>

            <?php if (empty($_SERVER['REMOTE_USER'])) { ?>
                <div class="navbar-item">
                    <a href="<?php echo wl($ID) . "&do=login&amp;sectok=" ?>" class="button">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        <span>Log in</span>
                    </a>
                </div>
            <?php } else { ?>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        <?php
                        ob_start();
                        tpl_userinfo();
                        $value = ob_get_contents();
                        ob_end_clean();
                        echo str_replace('Logged in as: ', '', $value);
                        ?>
                    </a>

                    <div class="navbar-dropdown is-right">
                        <?php
                        $user_menus = (new \dokuwiki\Menu\UserMenu())->getItems();
                        foreach ($user_menus as $user_menu) {
                            echo '<a class="navbar-item" href="' . $user_menu->getLink() . '">'
                                . '<i class="mr-2">' . inlineSVG($user_menu->getSvg()) . '</i>'
                                . '<span>' . $user_menu->getLabel() . '</span>'
                                . '</a>';
                        }
                        ?>
                    </div>
                </div>

            <?php } ?>


        </div>
    </div>
</nav>