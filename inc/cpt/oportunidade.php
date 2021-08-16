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
add_action( 'cmb2_admin_init', function() {
    $prefix = '_oportunidade_';

    /**
     * Taxonomy Tipo Metabox
     */
    $tipo_metabox = new_cmb2_box( array(
        'id'           => $prefix . 'tipo_taxonomy_metabox',
        'title'        => __( 'Tipo', 'ifrs-ingresso-theme' ),
        'object_types' => array( 'oportunidade' ),
        'context'      => 'side',
        'priority'     => 'low',
        'show_names'   => false,
    ) );

    $tipo_metabox->add_field( array(
        'id'                => $prefix . 'tipo_taxonomy',
        'taxonomy'          => 'tipo',
        'type'              => 'taxonomy_radio',
        'show_option_none'  => false,
        'text'              => array(
            'no_terms_text' => __( 'Ops! Nenhum Tipo de Seleção encontrado. Por favor, crie algum Tipo antes de cadastrar essa Oportunidade.', 'ifrs-ingresso-theme')
        ),
        'remove_default'    => 'true',
        'attributes' => array(
            'required' => 'required',
        ),
    ) );

    /**
     * Datas Metabox
     */
    $datas = new_cmb2_box( array(
        'id'            => $prefix . 'datas_metabox',
        'title'         => __( 'Datas', 'ifrs-ingresso-theme' ),
        'object_types'  => array( 'oportunidade' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
    ) );

    /* Isenção */
    $datas->add_field( array(
        'name'    => __( 'Isenção da Taxa de Inscrição', 'ifrs-ingresso-theme' ),
        'desc'    => __( 'Preencha com o período para requerimento da isenção. Em caso de inscrição gratuita, deixe em branco.', 'ifrs-ingresso-theme' ),
        'id'      => $prefix . 'isencao_title',
        'type'    => 'title',
    ) );

    $datas->add_field( array(
        'name'    => __( 'Início da Isenção', 'ifrs-ingresso-theme' ),
        'id'      => $prefix . 'isencao_inicio',
        'type'    => 'text_date_timestamp',
        'date_format' => 'd/m/Y',
    ) );

    $datas->add_field( array(
        'name'    => __( 'Término da Isenção', 'ifrs-ingresso-theme' ),
        'id'      => $prefix . 'isencao_termino',
        'type'    => 'text_date_timestamp',
        'date_format' => 'd/m/Y',
    ) );

    /* Inscrição */
    $datas->add_field( array(
        'name'    => __( 'Inscrições', 'ifrs-ingresso-theme' ),
        'desc'    => __( 'Preencha com o período para inscrições.', 'ifrs-ingresso-theme' ),
        'id'      => $prefix . 'inscricao_title',
        'type'    => 'title',
    ) );

    $datas->add_field( array(
        'name'    => __( 'Início das Inscrições', 'ifrs-ingresso-theme' ),
        'id'      => $prefix . 'inscricao_inicio',
        'type'    => 'text_date_timestamp',
        'date_format' => 'd/m/Y',
        'attributes' => array(
            'required' => 'required',
        ),
    ) );

    $datas->add_field( array(
        'name'    => __( 'Término das Inscrições', 'ifrs-ingresso-theme' ),
        'id'      => $prefix . 'inscricao_termino',
        'type'    => 'text_date_timestamp',
        'date_format' => 'd/m/Y',
        'attributes' => array(
            'required' => 'required',
        ),
    ) );

    /**
     * Requisitos Metabox
     */
    $requisitos = new_cmb2_box( array(
        'id'            => $prefix . 'requisitos_metabox',
        'title'         => __( 'Requisitos Mínimos', 'ifrs-ingresso-theme' ),
        'object_types'  => array( 'oportunidade' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => false,
    ) );

    $requisitos->add_field( array(
        'name'    => __( 'Requisitos', 'ifrs-ingresso-theme' ),
        'desc'    => __( 'Recomenda-se que os requisitos sejam elaborados em forma de lista de itens.', 'ifrs-ingresso-theme' ),
        'id'      => $prefix . 'requisitos',
        'type'    => 'wysiwyg',
        'options' => array(
            'media_buttons' => false,
            'teeny'         => true,
        ),
    ) );

    /**
     * Cursos Metabox
     */
    /* function ifrs_ingresso_get_cursos() {
        $posts = get_posts( array(
            'post_type'      => 'curso',
            'posts_per_page' => -1,
        ) );

        $post_options = array();

        if ( $posts ) {
            foreach ( $posts as $post ) {
                $label = $post->post_title;
                $unidades = wp_get_post_terms($post->ID, 'unidade', array('fields' => 'id=>name'));

                if (!empty($unidades)) {
                    $label .= ' [ ';
                    foreach ($unidades as $unidade) {
                        $label .= $unidade;

                        if ($unidade !== array_pop($unidades)) {
                            $label .= ', ';
                        }
                    }
                    $label .= ' ]';
                }

                $post_options[ $post->ID ] = $label;
            }
        }

        return $post_options;
    }
    $cursos = new_cmb2_box( array(
        'id'            => $prefix . 'cursos_metabox',
        'title'         => __( 'Cursos Relacionados', 'ifrs-ingresso-theme' ),
        'object_types'  => array( 'oportunidade' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => false,
    ) );

    $cursos->add_field( array(
        'name'              => __( 'Cursos', 'ifrs-ingresso-theme' ),
        'id'                => $prefix . 'cursos',
        'type'              => 'multicheck',
        'select_all_button' => false,
        'options_cb'        => 'ifrs_ingresso_get_cursos',
    ) ); */

    /**
     * URL Metabox
     */
    $url = new_cmb2_box( array(
        'id'            => $prefix . 'url_metabox',
        'title'         => __( 'Link', 'ifrs-ingresso-theme' ),
        'object_types'  => array( 'oportunidade' ),
        'context'       => 'side',
        'priority'      => 'low',
        'show_names'    => true,
    ) );

    $url->add_field( array(
        'name'      => __( 'Endereço (URL)', 'ifrs-ingresso-theme' ),
        'desc'      => __( 'Insira o endereço para acesso a mais informações.', 'ifrs-ingresso-theme' ),
        'id'        => $prefix . 'url',
        'type'      => 'text_url',
        'protocols' => array( 'http', 'https' ),
        'attributes' => array(
            'type'     => 'url',
            'required' => 'required',
        ),
    ) );
}, 5 );

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
