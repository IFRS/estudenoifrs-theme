<?php

function ingresso_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init', 'ingresso_add_excerpts_to_pages', 999 );
