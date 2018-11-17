<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php wp_title(); ?></title>
        <?php wp_head(); ?>
    </head>
<body>
    <?php
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
        wp_footer();
    ?>
</body>
</html>
