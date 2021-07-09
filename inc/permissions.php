<?php
add_action('init', function() {
    // Fix Media Permissions
    global $wp_post_types;
    $wp_post_types['attachment']->cap->edit_posts = 'manage_files';
    $wp_post_types['attachment']->cap->delete_posts = 'manage_files';
});

add_action('after_switch_theme', function() {
    if (!get_role( 'cadastrador_oportunidades' )) {
        add_role('cadastrador_oportunidades', __('Cadastrador de Oportunidades', 'ifrs-ingresso-theme'), array(
            'read'              => true,
            'upload_files'      => true,
            'manage_files'      => true,

            'create_oportunidades'     => true,
            'edit_oportunidades'       => true,
            'delete_oportunidades'     => true,
            'manage_oportunidades'     => false,

            'assign_tipo'        => true,
            'assign_unidade'      => true
        ));
    }
});

add_action('switch_theme', function() {
    if (get_role( 'cadastrador_oportunidades' )) {
        remove_role( 'cadastrador_oportunidades' );
    }
});
