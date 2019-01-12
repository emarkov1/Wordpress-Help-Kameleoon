<?php

    global $hiweb_search_disallow_post_type;
    $post_types = array();
    $post_types_disallow = array_flip($hiweb_search_disallow_post_type);
    $post_ids = array();
    foreach (get_post_types() as $post_type) {
        if (isset($post_types_disallow[$post_type])) continue;
        $post_types[] = $post_type;
    }
    /*$posts = get_posts(array(
            'posts_per_page' => -1,
            'post_status' => 'any',
            'post_type' => $post_types
    ));
    foreach ($posts as $post){
        $post_ids[] = $post->ID;
    }*/


?>
<div id="wpbody" role="main">

    <div id="wpbody-content" aria-label="Main content" tabindex="0">
        <div class="wrap">
            <h1>hiWeb Soft Search ReGenerate Meta-Index</h1>

            <?php if (count($post_types) == 0) : ?>
                <p>...</p>
            <?php else: ?>
                <form id="hiweb_search_tool_form" class="card pressthis">
                    <h3>Select post types for ReGenerate index data...</h3>
                    <p>Finded posts and pages: <span data-count-ids><?php echo count($post_ids) ?></span></p>
                    <?php foreach ($post_types as $post_type): ?>
                            <div><label for="hiweb_search_tool_check_<?php echo $post_type ?>"><input type="checkbox" name="post_type[]" value="<?php echo $post_type ?>" id="hiweb_search_tool_check_<?php echo $post_type ?>"><?php echo $post_type ?></label></div>
                    <?php endforeach; ?>
                    <p></p>
                </form>
                <div class="media-toolbar wp-filter">
                    <div class="progress-bar">
                        <div></div>
                    </div>
                </div>
                <p>
                    <button class="button button-primary" id="hw-search-regenerate-tool-start">Start ReGenerate Post Meta-Index</button>
                </p>
                <script>
					jQuery(document).ready(function(){
                        hw_search_tool.init(<?php echo json_encode($post_ids); ?>, '#hw-search-regenerate-tool-start', '#hiweb_search_tool_form');
					});
				</script>
            <?php endif; ?>

        </div>

        <div class="clear"></div>
    </div><!-- wpbody-content -->
    <div class="clear"></div>
</div>