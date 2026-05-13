<?php
add_action('after_switch_theme', function() {
    $admin = get_role('administrator');

    $admin->add_cap('manage_modalidades');
    $admin->add_cap('manage_niveis');
    $admin->add_cap('manage_turnos');
    $admin->add_cap('manage_unidades');

    $admin->add_cap('read_private_cursos');
    $admin->add_cap('publish_cursos');
    $admin->add_cap('edit_cursos');
    $admin->add_cap('edit_published_cursos');
    $admin->add_cap('edit_others_cursos');
    $admin->add_cap('edit_private_cursos');
    $admin->add_cap('delete_cursos');
    $admin->add_cap('delete_published_cursos');
    $admin->add_cap('delete_others_cursos');
    $admin->add_cap('delete_private_cursos');

    $admin->add_cap('read_private_oportunidades');
    $admin->add_cap('publish_oportunidades');
    $admin->add_cap('edit_oportunidades');
    $admin->add_cap('edit_published_oportunidades');
    $admin->add_cap('edit_others_oportunidades');
    $admin->add_cap('edit_private_oportunidades');
    $admin->add_cap('delete_oportunidades');
    $admin->add_cap('delete_published_oportunidades');
    $admin->add_cap('delete_others_oportunidades');
    $admin->add_cap('delete_private_oportunidades');

    add_role('cadastrador_conteudo', __('Cadastrador de Conteúdo', 'ifrs-estude-theme'), array(
        'upload_files' => true,
        'read'         => true,

        /* Cursos */
        'read_private_cursos'     => false,
        'publish_cursos'          => true,

        'edit_cursos'             => true,
        'edit_published_cursos'   => true,
        'edit_others_cursos'      => true,
        'edit_private_cursos'     => false,

        'delete_cursos'           => false,
        'delete_published_cursos' => false,
        'delete_others_cursos'    => false,
        'delete_private_cursos'   => false,

        /* Oportunidades */
        'read_private_oportunidades'     => false,
        'publish_oportunidades'          => true,

        'edit_oportunidades'             => true,
        'edit_published_oportunidades'   => true,
        'edit_others_oportunidades'      => true,
        'edit_private_oportunidades'     => false,

        'delete_oportunidades'           => false,
        'delete_published_oportunidades' => false,
        'delete_others_oportunidades'    => false,
        'delete_private_oportunidades'   => false,
    ));
});

add_action('switch_theme', function() {
    if (get_role( 'cadastrador_conteudo' )) remove_role( 'cadastrador_conteudo' );
});
