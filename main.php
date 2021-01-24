<?php

/**
 * DokuWiki Default Template 2012
 *
 * @link     https://github.com/ledyx/soonsoo-dokuwiki-template
 * @author   Joohyuk Lee <clarencedglee@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */


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
    <link href="<?php echo tpl_basedir(); ?>assets/css/bulma.min.css" rel="stylesheet">
    <?php tpl_metaheaders() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php // echo tpl_favicon(array('favicon', 'mobile')) 
    ?>
    <?php // tpl_includeFile('meta.html') 
    ?>
</head>

<body>
    <?php include('tpl_header.php') ?>
    <?php include_once('tpl_content.php') ?>
    <?php include('tpl_footer.php') ?>

    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
    <div id="screen__mode" class="no"></div><?php /* helper to detect CSS media query in script.js */ ?>
</body>
</html>