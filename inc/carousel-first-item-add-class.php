<?php
add_action('init', function() {
    global $wp_registered_sidebars, $wp_registered_widgets;

    $sidebars = wp_get_sidebars_widgets();

    if ( empty( $sidebars ) ) {
        return;
    }

    if (!empty($sidebars['area-carousel']) && count($sidebars['area-carousel']) > 0) {
        $wp_registered_widgets[$sidebars['area-carousel'][0]]['classname'] .= ' active';
    }
}, 99);
