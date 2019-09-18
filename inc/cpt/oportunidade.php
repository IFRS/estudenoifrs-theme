<?php
if ( ! function_exists('ingresso_oportunidade_post_type') ) {
    function ingresso_oportunidade_post_type() {
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
            'delete_posts'           => 'manage_oportunidades',
            'delete_private_posts'   => 'manage_oportunidades',
            'delete_published_posts' => 'manage_oportunidades',
            'delete_others_posts'    => 'manage_oportunidades',
            'edit_private_posts'     => 'edit_oportunidades',
            'edit_published_posts'   => 'edit_oportunidades',
        );

        $args = array(
            'label'                 => __( 'Oportunidade', 'ifrs-ingresso-theme' ),
            'description'           => __( 'Oportunidades de ingresso discente', 'ifrs-ingresso-theme' ),
            'labels'                => $labels,
            'supports'              => array( 'title' ),
            'taxonomies'            => array( 'forma', 'unidade' ),
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
            'rewrite'               => array('slug' => 'oportunidades'),
        );

        register_post_type( 'oportunidade', $args );
    }

    add_action( 'init', 'ingresso_oportunidade_post_type', 0 );
}

/* Metaboxes */
function ingresso_oportunidade_metaboxes() {
    $prefix = '_oportunidade_';

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
	 * Taxonomy Forma Metabox
	 */
    $forma_metabox = new_cmb2_box( array(
		'id'           => $prefix . 'forma_taxonomy_metabox',
		'title'        => __( 'Forma de Ingresso', 'ifrs-ingresso-theme' ),
		'object_types' => array( 'oportunidade' ),
		'context'      => 'side',
		'priority'     => 'low',
		'show_names'   => false,
    ) );

    $forma_metabox->add_field( array(
        'id'                => $prefix . 'forma_taxonomy',
        'taxonomy'          => 'forma',
        'type'              => 'taxonomy_radio',
        'show_option_none'  => false,
        'text'              => array(
            'no_terms_text' => __( 'Ops! Nenhuma Forma de Ingresso encontrada. Por favor, crie alguma Forma de Ingresso antes de cadastrar essa Oportunidade.', 'ifrs-ingresso-theme')
        ),
        'remove_default'    => 'true',
        'attributes' => array(
            'required' => 'required',
        ),
    ) );

    /**
	 * Taxonomy Unidade Metabox
	 */
    $unidade_metabox = new_cmb2_box( array(
		'id'           => $prefix . 'unidade_taxonomy_metabox',
		'title'        => __( 'Unidades', 'ifrs-ingresso-theme' ),
		'object_types' => array( 'oportunidade' ),
		'context'      => 'side',
		'priority'     => 'low',
		'show_names'   => false,
    ) );

    $unidade_metabox->add_field( array(
        'id'                => $prefix . 'unidade_taxonomy',
        'taxonomy'          => 'unidade',
        'type'              => 'taxonomy_multicheck',
        'show_option_none'  => false,
        'text'              => array(
            'no_terms_text' => __( 'Ops! Nenhuma Unidade encontrada. Por favor, crie alguma Unidade antes de cadastrar essa Oportunidade.', 'ifrs-ingresso-theme')
        ),
        'remove_default'    => 'true',
        'select_all_button' => false,
    ) );

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
}

add_action( 'cmb2_admin_init', 'ingresso_oportunidade_metaboxes', 5 );