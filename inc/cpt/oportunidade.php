<?php
add_action( 'init', function() {
    $labels = array(
        'name'                  => _x( 'Oportunidades', 'Post Type General Name', 'ifrs-ingresso-theme' ),
        'singular_name'         => _x( 'Oportunidade', 'Post Type Singular Name', 'ifrs-ingresso-theme' ),
        'menu_name'             => __( 'Oportunidades', 'ifrs-ingresso-theme' ),
        'name_admin_bar'        => __( 'Oportunidades', 'ifrs-ingresso-theme' ),
        'archives'              => __( 'Arquivo de Oportunidades', 'ifrs-ingresso-theme' ),
        'attributes'            => __( 'Atributos de Oportunidades', 'ifrs-ingresso-theme' ),
        'parent_item_colon'     => __( 'Oportunidade mãe:', 'ifrs-ingresso-theme' ),
        'all_items'             => __( 'Todas as Oportunidades', 'ifrs-ingresso-theme' ),
        'add_new_item'          => __( 'Adicionar Nova Oportunidade', 'ifrs-ingresso-theme' ),
        'add_new'               => __( 'Adicionar Nova', 'ifrs-ingresso-theme' ),
        'new_item'              => __( 'Nova Oportunidade', 'ifrs-ingresso-theme' ),
        'edit_item'             => __( 'Editar Oportunidade', 'ifrs-ingresso-theme' ),
        'update_item'           => __( 'Atualizar Oportunidade', 'ifrs-ingresso-theme' ),
        'view_item'             => __( 'Visualizar Oportunidade', 'ifrs-ingresso-theme' ),
        'view_items'            => __( 'Visualizar Oportunidades', 'ifrs-ingresso-theme' ),
        'search_items'          => __( 'Buscar Oportunidade', 'ifrs-ingresso-theme' ),
        'not_found'             => __( 'Não encontrada', 'ifrs-ingresso-theme' ),
        'not_found_in_trash'    => __( 'Não encontrada na Lixeira', 'ifrs-ingresso-theme' ),
        'featured_image'        => __( 'Imagem Destaque', 'ifrs-ingresso-theme' ),
        'set_featured_image'    => __( 'Definir imagem destaque', 'ifrs-ingresso-theme' ),
        'remove_featured_image' => __( 'Remover imagem destaque', 'ifrs-ingresso-theme' ),
        'use_featured_image'    => __( 'Usar como imagem destaque', 'ifrs-ingresso-theme' ),
        'insert_into_item'      => __( 'Inserir na Oportunidade', 'ifrs-ingresso-theme' ),
        'uploaded_to_this_item' => __( 'Enviado para essa Oportunidade', 'ifrs-ingresso-theme' ),
        'items_list'            => __( 'Lista de Oportunidades', 'ifrs-ingresso-theme' ),
        'items_list_navigation' => __( 'Lista de navegação de Oportunidades', 'ifrs-ingresso-theme' ),
        'filter_items_list'     => __( 'Filtrar lista de Oportunidades', 'ifrs-ingresso-theme' ),
    );

    $capabilities = array(
        // meta caps (don't assign these to roles)
        'edit_post'              => 'edit_oportunidade',
        'read_post'              => 'read',
        'delete_post'            => 'delete_oportunidade',

        // primitive/meta caps
        'create_posts'           => 'create_oportunidades',

        // primitive caps used outside of map_meta_cap()
        'edit_posts'             => 'edit_oportunidades',
        'edit_others_posts'      => 'manage_oportunidades',
        'publish_posts'          => 'create_oportunidades',
        'read_private_posts'     => 'read',

        // primitive caps used inside of map_meta_cap()
        'read'                   => 'read',
        'delete_posts'           => 'delete_oportunidades',
        'delete_private_posts'   => 'manage_oportunidades',
        'delete_published_posts' => 'delete_oportunidades',
        'delete_others_posts'    => 'manage_oportunidades',
        'edit_private_posts'     => 'edit_oportunidades',
        'edit_published_posts'   => 'edit_oportunidades',
    );

    $args = array(
        'label'                 => __( 'Oportunidade', 'ifrs-ingresso-theme' ),
        'description'           => __( 'Oportunidades de ingresso discente', 'ifrs-ingresso-theme' ),
        'labels'                => $labels,
        'supports'              => array( 'title' ),
        'taxonomies'            => array( 'tipo' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 25,
        'menu_icon'             => 'dashicons-book',
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        //'capabilities'          => $capabilities,
        'show_in_rest'          => true,
        'rest_base'             => 'oportunidades',
        'rewrite'               => array( 'slug' => 'oportunidades' ),
    );

    register_post_type( 'oportunidade', $args );
}, 2 );

/* Metaboxes */
add_filter( 'rwmb__oportunidade_cursos_choice_label', function( $label, $field, $post ) {
    $label = $post->post_title;
    $unidades = get_the_terms($post, 'unidade');

    if (!empty($unidades)) {
        $label .= ' [ ';
        foreach ($unidades as $unidade) {
            $label .= $unidade->name;

            if ($unidade !== array_pop($unidades)) {
                $label .= ', ';
            }
        }
        $label .= ' ]';
    }

    return $label;
}, 10, 3);

/* Metaboxes */
add_action( 'rwmb_meta_boxes', function($metaboxes) {
    $prefix = '_oportunidade_';

    /**
     * Cursos
     */
    // $metaboxes[] = array(
    //     'title'      => __( 'Cursos Relacionados', 'ifrs-ingresso-theme' ),
    //     'post_types' => 'oportunidade',
    //     'fields'     => array(
    //         array(
    //             'id'          => $prefix . 'cursos',
    //             'name'        => __( 'Cursos', 'ifrs-ingresso-theme' ),
    //             'desc'        => __( 'Escolha os Cursos participantes dessa Oportunidade.', 'ifrs-ingresso-theme' ),
    //             'type'        => 'post',
    //             'post_type'   => 'curso',
    //             'placeholder' => 'Selecione os Cursos',
    //             'field_type'  => 'select_advanced',
    //             'multiple'    => true,
    //         ),
    //     ),
    // );

    /**
     * Datas
     */
    $metaboxes[] = array(
        'title'      => __( 'Datas', 'ifrs-ingresso-theme' ),
        'post_types' => 'oportunidade',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => array(
            array(
                'type'    => 'heading',
                'name'    => __( 'Isenção da Taxa de Inscrição', 'ifrs-ingresso-theme' ),
                'desc'    => __( 'Preencha com o período para requerimento da isenção. Em caso de inscrição gratuita, deixe em branco.', 'ifrs-ingresso-theme' ),
            ),
            array(
                'name'       => __( 'Início da Isenção', 'ifrs-ingresso-theme' ),
                'id'         => $prefix . 'isencao_inicio',
                'type'       => 'date',
                'timestamp'  => true,
                'size'       => 10,
                'js_options' => array(
                    'dateFormat'      => 'dd-mm-yy',
                ),
            ),
            array(
                'name'       => __( 'Término da Isenção', 'ifrs-ingresso-theme' ),
                'id'         => $prefix . 'isencao_termino',
                'type'       => 'date',
                'timestamp'  => true,
                'size'       => 10,
                'js_options' => array(
                    'dateFormat'      => 'dd-mm-yy',
                ),
            ),
            array(
                'type'    => 'heading',
                'name'    => __( 'Inscrições', 'ifrs-ingresso-theme' ),
                'desc'    => __( 'Preencha com o período para inscrições.', 'ifrs-ingresso-theme' ),
            ),
            array(
                'name'       => __( 'Início das Inscrições', 'ifrs-ingresso-theme' ),
                'id'         => $prefix . 'inscricao_inicio',
                'type'       => 'date',
                'timestamp'  => true,
                'size'       => 10,
                'js_options' => array(
                    'dateFormat'      => 'dd-mm-yy',
                ),
            ),
            array(
                'name'       => __( 'Término das Inscrições', 'ifrs-ingresso-theme' ),
                'id'         => $prefix . 'inscricao_termino',
                'type'       => 'date',
                'timestamp'  => true,
                'size'       => 10,
                'js_options' => array(
                    'dateFormat'      => 'dd-mm-yy',
                ),
            ),
        ),
    );

    /**
     * Requisitos
     */
    $metaboxes[] = array(
        'title'      => __( 'Requisitos Mínimos', 'ifrs-ingresso-theme' ),
        'post_types' => 'oportunidade',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => array(
            array(
                'desc'    => __( 'Recomenda-se que os requisitos sejam elaborados em forma de lista de itens.', 'ifrs-ingresso-theme' ),
                'id'      => $prefix . 'requisitos',
                'type'    => 'wysiwyg',
                'raw'     => false,
                'options' => array(
                    'media_buttons' => false,
                    'teeny'         => true,
                ),
            ),
        ),
    );

    /**
     * Taxonomy Tipo
     */
    $metaboxes[] = array(
        'title'      => __( 'Tipo', 'ifrs-ingresso-theme' ),
        'post_types' => 'oportunidade',
        'context'    => 'side',
        'priority'   => 'low',
        'fields'     => array(
            array(
                'id'              => $prefix . 'tipo_taxonomy',
                'desc'            => __( 'Escolha o Tipo de Oportunidade.', 'ifrs-ingresso-theme' ),
                'type'            => 'taxonomy',
                'taxonomy'        => 'tipo',
                'add_new'         => false,
                'remove_default'  => true,
                'field_type'      => 'checkbox_list',
                'inline'          => false,
                'select_all_none' => false,
            ),
        ),
    );

    /**
     * URL
     */
    $metaboxes[] = array(
        'title'      => __( 'Link', 'ifrs-ingresso-theme' ),
        'post_types' => 'oportunidade',
        'context'    => 'side',
        'priority'   => 'low',
        'fields'     => array(
            array(
                'name' => __( 'Endereço (URL)', 'ifrs-ingresso-theme' ),
                'desc' => __( 'Insira o endereço para acesso a mais informações.', 'ifrs-ingresso-theme' ),
                'id'   => $prefix . 'url',
                'type' => 'text',
            ),
        ),
        'validation' => [
            'rules'  => [
                $prefix . 'url' => [
                    'url' => true,
                ],
            ],
            'messages' => [
                $prefix . 'url' => [
                    'url'  => 'O endereço precisa ser uma URL válida.',
                ],
            ],
        ],
    );

    return $metaboxes;
} );

/* Disable Gutenberg */
add_filter('use_block_editor_for_post_type', function($current_status, $post_type) {
    if ($post_type === 'oportunidade') return false;
    return $current_status;
}, 10, 2);

/* Garbage Collector */
add_action( 'ifrs_oportunidades_trash_hook', function() {
    $limit = new Datetime("now - 7 days");

    $oportunidades = get_posts( array(
        'post_type'      => 'oportunidade',
        'nopaging'       => true,
        'posts_per_page' => -1,
        'meta_key'       => '_oportunidade_inscricao_termino',
        'meta_compare'   => '<',
        'meta_value'     => $limit->format('U'),
    ) );

    foreach ($oportunidades as $oportunidade) {
        wp_trash_post( $oportunidade->ID );
    }
} );

add_action( 'init', function() {
    if ( ! wp_next_scheduled( 'ifrs_oportunidades_trash_hook' ) ) {
        wp_schedule_event( time(), 'daily', 'ifrs_oportunidades_trash_hook' );
    }
}, 99 );
