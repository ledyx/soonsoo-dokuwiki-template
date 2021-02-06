<div>
    <?php html_msgarea() ?>

    <div class="has-text-centered mx-6 mt-6">
        <?php tpl_flush() ?>
        <!-- detail start -->
        <?php
        if($ERROR):
            echo '<h1>'.$ERROR.'</h1>';
        else: ?>
            <?php if($REV) echo p_locale_xhtml('showrev');?>

            <?php tpl_img(900,700); ?>

            <div class="card mt-1">
                <div class="card-content">
                    <div class="media-content">
                        <p class="title is-4">
                            <?php echo nl2br(hsc(tpl_img_getTag('simple.title'))); ?>
                        </p>
                    </div>
                </div>
                <div class="content">
                    <?php tpl_img_meta(); ?>
                    <dl>
                        <?php
                            echo '<dt>'.$lang['reference'].':</dt>';
                            $media_usage = ft_mediause($IMG,true);

                            if(count($media_usage) > 0){
                                foreach($media_usage as $path){
                                    echo '<dd>'.html_wikilink($path).'</dd>';
                                }
                            }else{
                                echo '<dd>'.$lang['nothingfound'].'</dd>';
                            }
                            
                        ?>
                    </dl>
                    <p><?php echo $lang['media_acl_warning']; ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!-- detail stop -->
    <?php tpl_flush() ?>
</div>