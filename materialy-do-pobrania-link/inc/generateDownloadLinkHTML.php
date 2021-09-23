<?php

function generateDownloadLinkHTML($text, $link) {
    ob_start(); ?>

    <!-- wp:group -->
    <div class="wp-block-group">
        <div class="wp-block-group__inner-container">
            <!-- wp:paragraph {"dropCap":true,"textColor":"primary"} -->
            <p class="has-drop-cap has-primary-color has-text-color">
                <a class="link-no-underline" href="<?php echo($link ? $link : "#") ?>">+ <?php echo $text; ?></a>
            </p>
            <!-- /wp:paragraph -->
        </div>
    </div>

    <?php
    return ob_get_clean();
}