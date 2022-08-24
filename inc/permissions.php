<?php
add_action('init', function() {
    // Fix Media Permissions
    global $wp_post_types;
    $wp_post_types['attachment']->cap->edit_posts = 'manage_files';
    $wp_post_types['attachment']->cap->delete_posts = 'manage_files';
});

add_action('admin_init', function() {
    $admin = get_role('administrator');

    $admin->add_cap('manage_cursos');
    $admin->add_cap('create_cursos');
    $admin->add_cap('edit_cursos');
    $admin->add_cap('delete_cursos');

    $admin->add_cap('manage_modalidade');
    $admin->add_cap('assign_modalidade');

    $admin->add_cap('manage_nivel');
    $admin->add_cap('assign_nivel');

    $admin->add_cap('manage_turno');
    $admin->add_cap('assign_turno');

    $admin->add_cap('manage_unidade');
    $admin->add_cap('assign_unidade');


    $admin->add_cap('manage_oportunidades');
    $admin->add_cap('create_oportunidades');
    $admin->add_cap('edit_oportunidades');
    $admin->add_cap('delete_oportunidades');
});

add_action('after_switch_theme', function() {
    if (!get_role( 'cadastrador_cursos' )) {
        add_role('cadastrador_cursos', __('Cadastrador de Cursos', 'ifrs-estude-theme'), array(
            'read'              => true,
            'upload_files'      => true,
            'manage_files'      => true,

            'create_cursos'     => true,
            'edit_cursos'       => true,
            'delete_cursos'     => true,
            'manage_cursos'     => false,

            'assign_modalidade' => true,
            'assign_nivel'      => true,
            'assign_turno'      => true,
            'assign_unidade'    => true,
        ));
    }

    if (!get_role( 'cadastrador_oportunidades' )) {
        add_role('cadastrador_oportunidades', __('Cadastrador de Oportunidades', 'ifrs-estude-theme'), array(
            'read'                 => true,
            'upload_files'         => true,
            'manage_files'         => true,

            'create_oportunidades' => true,
            'edit_oportunidades'   => true,
            'delete_oportunidades' => true,
            'manage_oportunidades' => false,
        ));
    }
});

add_action('switch_theme', function() {
    if (get_role( 'cadastrador_cursos' )) remove_role( 'cadastrador_cursos' );
    if (get_role( 'cadastrador_oportunidades' )) remove_role( 'cadastrador_oportunidades' );
});
