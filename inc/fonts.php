<?php
add_action('wp_head', function() {
    $fonts_file = esc_url( get_parent_theme_file_uri( '/css/fonts.css' ) );
?>
    <link rel="preload" href="<?php echo esc_url( get_parent_theme_file_uri( '/fonts/opensans/open-sans-v20-latin-regular.woff2' ) ); ?>" as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload" href="<?php echo $fonts_file; ?>" as="style"/>
    <link rel="stylesheet" href="<?php echo $fonts_file; ?>" media="print" onload="this.media='all'"/>
    <noscript>
        <link rel="stylesheet" href="<?php echo $fonts_file; ?>"/>
    </noscript>
<?php
}, 1);
