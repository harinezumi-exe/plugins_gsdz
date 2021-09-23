<?php

function generateListElementHTML($text, $link) {

    ob_start(); ?>

    <!-- wp:group {"className":"tw-mt-0 tw-mb-0"} -->
    <div class="wp-block-group tw-mt-0 tw-mb-0">
        <div class="wp-block-group__inner-container">
            <!-- wp:paragraph {"style":{"color":{"text":"#404b69"},"typography":{"fontSize":22}},"className":"tw-mb-2"} -->
            <p class="tw-mb-2 has-text-color" style="color:#404b69;font-size:22px">
                <a href="<?php echo($link ? $link : "#"); ?>"><?php echo $text; ?></a>
            </p>
            <!-- /wp:paragraph -->
            <!-- wp:separator {"className":"tw-mt-0 tw-mb-0"} -->
            <hr class="wp-block-separator tw-mt-0 tw-mb-0"/>
            <!-- /wp:separator -->
        </div>
    </div>
    <!-- /wp:group -->

    <?php
    return ob_get_clean();
}