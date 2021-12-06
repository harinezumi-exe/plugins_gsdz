<?php

function generatePageHTML($args) {
    $elements = $args['elements'];
    $text = $args['noLinkElements'];
    $links = $args['links'];
    $id = $args['post_id'];

    update_post_meta( $id, "_wp_page_template", "tw-no-title.php");
    $post = get_post( $id, ARRAY_A);
    $postNew = array_replace($post, array("post_parent" => 95));
    wp_update_post($postNew);

    ob_start(); ?>

    <div class="wp-block-group"><div class="wp-block-group__inner-container">
        <h2><?php echo $args['title']; ?></h2>

        <ul class="is-style-tw-arrow">
        <?php    
        foreach ($elements as $index => $value) { ?>
            <li>
                <a rel="noreferrer noopener" href="<?php echo $links[$index]; ?>" target="_blank"><?php echo $elements[$index]; ?></a>
            </li>
        <?php } ?>
            
        </ul>
        </div>
    </div>
    

    <?php
    return ob_get_clean();
}