<?php
add_action( 'init', function() {
    add_post_type_support( 'page', 'excerpt' );
}, 999 );

add_filter( 'excerpt_length', function($length) {
    return 20;
}, 999 );
