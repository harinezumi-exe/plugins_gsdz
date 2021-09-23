<?php

function generatePageHTML($args) {
    $elements = $args['elements'];
    $links = $args['links'];

    ob_start(); ?>

    <!-- wp:group -->
    <div class="wp-block-group"><div class="wp-block-group__inner-container">
        <!-- wp:heading -->
        <h2><?php echo $args['title']; ?></h2>
        <!-- /wp:heading -->

        <!-- wp:list {"className":"is-style-tw-arrow"} -->
        <ul class="is-style-tw-arrow">
        <?php    
        foreach ($elements as $index => $value) { ?>
            <li>
                <a rel="noreferrer noopener" href="<?php echo $links[$index]; ?>" target="_blank"><?php echo $elements[$index] ?></a>
            </li>
        <?php } ?>
            
        </ul>
        <!-- /wp:list --></div></div>
    <!-- /wp:group -->

    <?php
    return ob_get_clean();
}