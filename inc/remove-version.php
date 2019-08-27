<?php
remove_action('wp_head', 'wp_generator');

function remove_version() {
    return '';
}
add_filter('the_generator', 'remove_version');
