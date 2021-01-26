<div>
    <h3 class="toggle"><?php echo $lang['sidebar'] ?></h3>
    <div class="content">
        <div class="group">
            <?php tpl_flush() ?>
            <?php tpl_include_page($conf['sidebar'], true, true) ?>
        </div>
    </div>
</div>