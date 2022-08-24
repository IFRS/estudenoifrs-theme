<?php
add_action( 'init', function() {
    $labels = array(
        'name'                  => _x( 'Oportunidades', 'Post Type General Name', 'ifrs-estude-theme' ),
        'singular_name'         => _x( 'Oportunidade', 'Post Type Singular Name', 'ifrs-estude-theme' ),
        'menu_name'             => __( 'Oportunidades', 'ifrs-estude-theme' ),
        'name_admin_bar'        => __( 'Oportunidades', 'ifrs-estude-theme' ),
        'archives'              => __( 'Arquivo de Oportunidades', 'ifrs-estude-theme' ),
        'attributes'            => __( 'Atributos de Oportunidades', 'ifrs-estude-theme' ),
        'parent_item_colon'     => __( 'Oportunidade mãe:', 'ifrs-estude-theme' ),
        'all_items'             => __( 'Todas as Oportunidades', 'ifrs-estude-theme' ),
        'add_new_item'          => __( 'Adicionar Nova Oportunidade', 'ifrs-estude-theme' ),
        'add_new'               => __( 'Adicionar Nova', 'ifrs-estude-theme' ),
        'new_item'              => __( 'Nova Oportunidade', 'ifrs-estude-theme' ),
        'edit_item'             => __( 'Editar Oportunidade', 'ifrs-estude-theme' ),
        'update_item'           => __( 'Atualizar Oportunidade', 'ifrs-estude-theme' ),
        'view_item'             => __( 'Visualizar Oportunidade', 'ifrs-estude-theme' ),
        'view_items'            => __( 'Visualizar Oportunidades', 'ifrs-estude-theme' ),
        'search_items'          => __( 'Buscar Oportunidade', 'ifrs-estude-theme' ),
        'not_found'             => __( 'Não encontrada', 'ifrs-estude-theme' ),
        'not_found_in_trash'    => __( 'Não encontrada na Lixeira', 'ifrs-estude-theme' ),
        'featured_image'        => __( 'Imagem Destaque', 'ifrs-estude-theme' ),
        'set_featured_image'    => __( 'Definir imagem destaque', 'ifrs-estude-theme' ),
        'remove_featured_image' => __( 'Remover imagem destaque', 'ifrs-estude-theme' ),
        'use_featured_image'    => __( 'Usar como imagem destaque', 'ifrs-estude-theme' ),
        'insert_into_item'      => __( 'Inserir na Oportunidade', 'ifrs-estude-theme' ),
        'uploaded_to_this_item' => __( 'Enviado para essa Oportunidade', 'ifrs-estude-theme' ),
        'items_list'            => __( 'Lista de Oportunidades', 'ifrs-estude-theme' ),
        'items_list_navigation' => __( 'Lista de navegação de Oportunidades', 'ifrs-estude-theme' ),
        'filter_items_list'     => __( 'Filtrar lista de Oportunidades', 'ifrs-estude-theme' ),
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
        'edit_others_posts'      => 'edit_oportunidades',
        'publish_posts'          => 'create_oportunidades',
        'read_private_posts'     => 'read',

        // primitive caps used inside of map_meta_cap()
        'read'                   => 'read',
        'delete_posts'           => 'delete_oportunidades',
        'delete_private_posts'   => 'manage_oportunidades',
        'delete_published_posts' => 'delete_oportunidades',
        'delete_others_posts'    => 'manage_oportunidades',
        'edit_private_posts'     => 'manage_oportunidades',
        'edit_published_posts'   => 'edit_oportunidades',
    );

    $args = array(
        'label'                 => __( 'Oportunidade', 'ifrs-estude-theme' ),
        'description'           => __( 'Oportunidades de ingresso discente', 'ifrs-estude-theme' ),
        'labels'                => $labels,
        'supports'              => array( 'title' ),
        'taxonomies'            => array(),
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
        'capabilities'          => $capabilities,
        'show_in_rest'          => true,
        'rest_base'             => 'oportunidades',
        'rewrite'               => array( 'slug' => 'inscricoes-abertas' ),
    );

    register_post_type( 'oportunidade', $args );
}, 2 );

/* Metaboxes */
add_filter( 'rwmb__oportunidade_cursos_choice_label', function( $label, $field, $post ) {
    $niveis = get_the_terms($post, 'nivel');
    $modalidades = get_the_terms($post, 'modalidade');

    $label = '<strong>' . $post->post_title . '</strong>';

    $label .= ' ( ';

    if (!empty($niveis)) {
        foreach ($niveis as $nivel) {
            $label .= $nivel->name;

            if ($nivel !== end($niveis)) {
                $label .= ', ';
            }
        }
    }

    if (!empty($modalidades)) {
        $label .= ' - ';
        foreach ($modalidades as $modalidade) {
            $label .= $modalidade->name;

            if ($modalidade !== end($modalidades)) {
                $label .= ' / ';
            }
        }
    }

    $label .= ' )';

    return $label;
}, 10, 3);

/* Metaboxes */
add_action( 'rwmb_meta_boxes', function($metaboxes) {
    $prefix = '_oportunidade_';

    /**
     * Datas
     */
    $metaboxes[] = array(
        'title'      => __( 'Datas', 'ifrs-estude-theme' ),
        'post_types' => 'oportunidade',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => array(
            array(
                'type'    => 'heading',
                'name'    => __( 'Isenção da Taxa de Inscrição', 'ifrs-estude-theme' ),
                'desc'    => __( 'Preencha com o período para requerimento da isenção. Em caso de inscrição gratuita, deixe em branco.', 'ifrs-estude-theme' ),
            ),
            array(
                'name'       => __( 'Início da Isenção', 'ifrs-estude-theme' ),
                'id'         => $prefix . 'isencao_inicio',
                'type'       => 'date',
                'timestamp'  => true,
                'size'       => 10,
                'js_options' => array(
                    'dateFormat'      => 'dd/mm/yy',
                ),
            ),
            array(
                'name'       => __( 'Término da Isenção', 'ifrs-estude-theme' ),
                'id'         => $prefix . 'isencao_termino',
                'type'       => 'date',
                'timestamp'  => true,
                'size'       => 10,
                'js_options' => array(
                    'dateFormat'      => 'dd/mm/yy',
                ),
            ),
            array(
                'type'    => 'heading',
                'name'    => __( 'Inscrições', 'ifrs-estude-theme' ),
                'desc'    => __( 'Preencha com o período para inscrições.', 'ifrs-estude-theme' ),
            ),
            array(
                'name'       => __( 'Início das Inscrições', 'ifrs-estude-theme' ),
                'id'         => $prefix . 'inscricao_inicio',
                'type'       => 'date',
                'timestamp'  => true,
                'size'       => 10,
                'js_options' => array(
                    'dateFormat'      => 'dd/mm/yy',
                ),
            ),
            array(
                'name'       => __( 'Término das Inscrições', 'ifrs-estude-theme' ),
                'id'         => $prefix . 'inscricao_termino',
                'type'       => 'date',
                'timestamp'  => true,
                'size'       => 10,
                'js_options' => array(
                    'dateFormat'      => 'dd/mm/yy',
                ),
            ),
        ),
    );

    /**
     * Requisitos
     */
    $metaboxes[] = array(
        'title'      => __( 'Requisitos Mínimos', 'ifrs-estude-theme' ),
        'post_types' => 'oportunidade',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => array(
            array(
                'desc'    => __( 'Recomenda-se que os requisitos sejam elaborados em forma de lista de itens.', 'ifrs-estude-theme' ),
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
     * Cursos
     */
    $unidades = get_terms( array(
        'taxonomy' => 'unidade',
        'hide_empty' => true,
    ) );

    $fields = array();

    foreach ($unidades as $unidade) {
        $fields[] = array(
            'id'          => $prefix . 'cursos',
            'name'        => $unidade->name,
            'type'        => 'post',
            'post_type'   => 'curso',
            'field_type'  => 'checkbox_list',
            'multiple'    => true,
            'query_args'  => array(
                'order'     => 'ASC',
                'orderby'   => 'title',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'unidade',
                        'terms'    => $unidade->term_id,
                    ),
                ),
            ),
        );
    }

    $metaboxes[] = array(
        'title'      => __( 'Cursos Ofertados', 'ifrs-estude-theme' ),
        'post_types' => 'oportunidade',
        'context'    => 'normal',
        'priority'   => 'low',
        'fields'     => $fields,
    );

    /**
     * URL
     */
    $metaboxes[] = array(
        'title'      => __( 'Link', 'ifrs-estude-theme' ),
        'post_types' => 'oportunidade',
        'context'    => 'side',
        'priority'   => 'low',
        'fields'     => array(
            array(
                'name' => __( 'Endereço (URL)', 'ifrs-estude-theme' ),
                'desc' => __( 'Insira o endereço para acesso a mais informações.', 'ifrs-estude-theme' ),
                'id'   => $prefix . 'url',
                'type' => 'text',
            ),
        ),
        'validation' => [
            'rules'  => [
                $prefix . 'url' => [
                    'required'  => true,
                    'url' => true,
                ],
            ],
            'messages' => [
                $prefix . 'url' => [
                    'required'  => 'O endereço precisa ser preenchido.',
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
