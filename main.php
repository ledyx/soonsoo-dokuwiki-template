<?php

/**
 * DokuWiki Default Template 2012
 *
 * @link     https://github.com/ledyx/soonsoo-dokuwiki-template
 * @author   Joohyuk Lee <clarencedglee@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */

$hasSidebar = page_findnearest($conf['sidebar']);
// $showSidebar = $hasSidebar && ($ACT == 'show');
?>
<!DOCTYPE html>
<html lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js has-navbar-fixed-top">

<head>
    <meta charset="utf-8" />
    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <script>
        (function(H) {
            H.className = H.className.replace(/\bno-js\b/, 'js')
        })(document.documentElement)
    </script>
    <?php tpl_metaheaders() ?>
    <link href="<?php echo tpl_basedir(); ?>assets/css/bulma.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php // echo tpl_favicon(array('favicon', 'mobile')) 
    ?>
    <?php // tpl_includeFile('meta.html') 
    ?>
</head>

<body>
    <?php include('tpl_header.php') ?>

    <div class="section">
        <div class="columns">
            <?php if ($hasSidebar) : ?>
                <!-- ********** ASIDE ********** -->
                <div id="dokuwiki__aside" class="column is-2">
                    <div class="pad aside include group">
                        <h3 class="toggle"><?php echo $lang['sidebar'] ?></h3>
                        <div class="content">
                            <div class="group">
                                <?php tpl_flush() ?>
                                <?php tpl_includeFile('sidebarheader.html') ?>
                                <?php tpl_include_page($conf['sidebar'], true, true) ?>
                                <?php tpl_includeFile('sidebarfooter.html') ?>
                            </div>
                        </div>
                    </div>
                </div><!-- /aside -->
            <?php endif; ?>


            <div class="column is-10">
                <?php include_once('tpl_content.php') ?>
            </div>
        </div>
    </div>

    <?php include('tpl_footer.php') ?>

    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
    <div id="screen__mode" class="no"></div><?php /* helper to detect CSS media query in script.js */ ?>
</body>
</html>