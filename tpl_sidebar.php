<div>
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