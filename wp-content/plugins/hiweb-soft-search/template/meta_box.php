<?php

    /**
     * @var WP_Post $post
     */

    if ($post instanceof WP_Post):
        $meta = get_post_meta($post->ID, HIWEB_SEARCH_META_NAME, true);
        if (trim($meta) == '') :
            ?><p>No DATA...Please, re-generate index meta-data. <a class="button" href="<?php echo get_admin_url(null, 'tools.php?page=hw-search-simple'); ?>">ReGenerate Tool</a></p><?php
        else:
            ?><p><a class="button" href="<?php echo get_admin_url(null, 'tools.php?page=hw-search-simple'); ?>">ReGenerate Tool</a></p><code><?php echo $meta ?></code><?php
        endif;


    endif;