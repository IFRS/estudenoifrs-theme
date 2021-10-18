<?php
add_action( 'init', function() {
    $labels = array(
        'name'                  => _x( 'Cursos', 'Post Type General Name', 'ifrs-ingresso-theme' ),
        'singular_name'         => _x( 'Curso', 'Post Type Singular Name', 'ifrs-ingresso-theme' ),
        'menu_name'             => __( 'Cursos', 'ifrs-ingresso-theme' ),
        'name_admin_bar'        => __( 'Curso', 'ifrs-ingresso-theme' ),
        'archives'              => __( 'Arquivo de Cursos', 'ifrs-ingresso-theme' ),
        'attributes'            => __( 'Atributos de Curso', 'ifrs-ingresso-theme' ),
        'parent_item_colon'     => __( 'Curso Pai:', 'ifrs-ingresso-theme' ),
        'all_items'             => __( 'Todos os Cursos', 'ifrs-ingresso-theme' ),
        'add_new_item'          => __( 'Adicionar Novo Curso', 'ifrs-ingresso-theme' ),
        'add_new'               => __( 'Adicionar Novo', 'ifrs-ingresso-theme' ),
        'new_item'              => __( 'Novo Curso', 'ifrs-ingresso-theme' ),
        'edit_item'             => __( 'Editar Curso', 'ifrs-ingresso-theme' ),
        'update_item'           => __( 'Atualizar Curso', 'ifrs-ingresso-theme' ),
        'view_item'             => __( 'Ver Curso', 'ifrs-ingresso-theme' ),
        'view_items'            => __( 'Ver Cursos', 'ifrs-ingresso-theme' ),
        'search_items'          => __( 'Buscar Curso', 'ifrs-ingresso-theme' ),
        'not_found'             => __( 'Não encontrado', 'ifrs-ingresso-theme' ),
        'not_found_in_trash'    => __( 'Não encontrado na Lixeira', 'ifrs-ingresso-theme' ),
        'featured_image'        => __( 'Marca do Curso', 'ifrs-ingresso-theme' ),
        'set_featured_image'    => __( 'Escolher imagem', 'ifrs-ingresso-theme' ),
        'remove_featured_image' => __( 'Remover imagem', 'ifrs-ingresso-theme' ),
        'use_featured_image'    => __( 'Usar como imagem', 'ifrs-ingresso-theme' ),
        'insert_into_item'      => __( 'Inserir no Curso', 'ifrs-ingresso-theme' ),
        'uploaded_to_this_item' => __( 'Enviado para esse Curso', 'ifrs-ingresso-theme' ),
        'items_list'            => __( 'Lista de Cursos', 'ifrs-ingresso-theme' ),
        'items_list_navigation' => __( 'Lista de navegação de Cursos', 'ifrs-ingresso-theme' ),
        'filter_items_list'     => __( 'Filtrar lista de Cursos', 'ifrs-ingresso-theme' ),
    );
    $capabilities = array(
        // meta caps (don't assign these to roles)
        'edit_post'              => 'edit_curso',
        'read_post'              => 'read_curso',
        'delete_post'            => 'delete_curso',

        // primitive/meta caps
        'create_posts'           => 'create_cursos',

        // primitive caps used outside of map_meta_cap()
        'edit_posts'             => 'edit_cursos',
        'edit_others_posts'      => 'edit_cursos',
        'publish_posts'          => 'publish_cursos',
        'read_private_posts'     => 'read',

        // primitive caps used inside of map_meta_cap()
        'read'                   => 'read',
        'delete_posts'           => 'delete_cursos',
        'delete_private_posts'   => 'delete_cursos',
        'delete_published_posts' => 'delete_cursos',
        'delete_others_posts'    => 'delete_cursos',
        'edit_private_posts'     => 'edit_cursos',
        'edit_published_posts'   => 'edit_cursos',
    );
    $args = array(
        'label'               => __( 'Curso', 'ifrs-ingresso-theme' ),
        'description'         => __( 'Cursos', 'ifrs-ingresso-theme' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'          => array( 'unidade', 'modalidade', 'nivel', 'turno' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 25,
        'menu_icon'           => 'dashicons-welcome-learn-more',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capabilities'        => $capabilities,
        'show_in_rest'        => true,
        'rest_base'           => 'cursos',
        'rewrite'             => array( 'slug' => 'cursos' ),
    );
    register_post_type( 'curso', $args );
}, 1 );

/**
 * Definição das metaboxes
 */
add_action( 'rwmb_meta_boxes', function($metaboxes) {
    $prefix = '_curso_';

    /**
     * Informações do Curso
     */
    $metaboxes[] = array(
        'title'      => __( 'Informações do Curso', 'ifrs-ingresso-theme' ),
        'post_types' => 'curso',
        'fields'     => array(
            array(
                'id'         => $prefix . 'carga_horaria',
                'name'       => __( 'Carga Horária', 'ifrs-ingresso-theme' ),
                'desc'       => __( 'em horas (somente números).', 'ifrs-ingresso-theme' ),
                'type'       => 'text',
                'size'       => 10,
                'attributes' => array(
                    'required' => 'required',
                    'pattern'  => '\d*',
                ),
            ),
            array(
                'id'         => $prefix . 'duracao',
                'name'       => __( 'Duração', 'ifrs-ingresso-theme' ),
                'desc'       => __( '2 meses, 4 semestres, 3 anos, etc.', 'ifrs-ingresso-theme' ),
                'type'       => 'text',
                'size'       => 50,
                'attributes' => array(
                    'required' => 'required',
                ),
            ),
            array(
                'id'         => $prefix . 'ead',
                'name'       => __( 'Possui carga horária EaD?', 'ifrs-ingresso-theme' ),
                'desc'       => __( 'Marque caso o Curso possua parte da carga horária a distância.', 'ifrs-ingresso-theme' ),
                'type'       => 'switch',
            ),
            array(
                'id'   => $prefix . 'nota',
                'name' => __( 'Avaliação do Curso', 'ifrs-ingresso-theme' ),
                'desc' => __( 'Nota recebida pela última avaliação do Curso, se houver.', 'ifrs-ingresso-theme' ),
                'size' => 5,
                'type' => 'number',
                'step' => '1',
                'min'  => '1',
                'max'  => '5',
            ),
        ),
    );

    /**
     * Arquivos do Curso
     */
    $metaboxes[] = array(
        'title'      => __( 'Arquivos do Curso', 'ifrs-ingresso-theme' ),
        'post_types' => 'curso',
        'fields'     => array(
            array(
                'id'   => $prefix . 'arquivos_principais',
                'name' => __( 'Grade e Corpo Docente', 'ifrs-ingresso-theme' ),
                'desc' => __( 'PPC (Projeto Pedagógico do Curso), Matriz Curricular Vigente, Representação Gráfica, Corpo Docente e Corpo Docente X Componentes Curriculares.', 'ifrs-ingresso-theme' ),
                'type' => 'file_advanced',
            ),
            array(
                'id'   => $prefix . 'arquivos',
                'name' => __( 'Outros Arquivos', 'ifrs-ingresso-theme' ),
                'desc' => __( 'Demais informações como "Ato autorizativo e/ou de reconhecimento do MEC", "Resolução de aprovação e/ou alteração do Curso", etc.', 'ifrs-ingresso-theme' ),
                'type' => 'file_advanced',
            ),
        ),
    );

    /**
     * Taxonomy Unidade
     */
    $metaboxes[] = array(
        'title'      => __( 'Unidade', 'ifrs-ingresso-theme' ),
        'post_types' => 'curso',
        'context'    => 'side',
        'priority'   => 'low',
        'fields'     => array(
            array(
                'id'                => $prefix . 'unidade_taxonomy',
                'desc'              => __( 'Escolha as Unidades de oferta do Curso.', 'ifrs-ingresso-theme' ),
                'type'              => 'taxonomy',
                'taxonomy'          => 'unidade',
                'add_new'           => false,
                'remove_default'    => true,
                'field_type'        => 'checkbox_list',
            ),
        ),
    );

    /**
     * Taxonomy Modalidade
     */
    $metaboxes[] = array(
        'title'      => __( 'Modalidade', 'ifrs-ingresso-theme' ),
        'post_types' => 'curso',
        'context'    => 'side',
        'priority'   => 'low',
        'fields'     => array(
            array(
                'id'                => $prefix . 'modalidade_taxonomy',
                'desc'              => __( 'Escolha a Modalidade do Curso.', 'ifrs-ingresso-theme' ),
                'type'              => 'taxonomy',
                'taxonomy'          => 'modalidade',
                'add_new'           => false,
                'remove_default'    => true,
                'field_type'        => 'radio_list',
            ),
        ),
    );

    /**
     * Taxonomy Nível
     */
    $metaboxes[] = array(
        'title'      => __( 'Nível', 'ifrs-ingresso-theme' ),
        'post_types' => 'curso',
        'context'    => 'side',
        'priority'   => 'low',
        'fields'     => array(
            array(
                'id'                => $prefix . 'nivel_taxonomy',
                'desc'              => __( 'Escolha o Nível do Curso.', 'ifrs-ingresso-theme' ),
                'type'              => 'taxonomy',
                'taxonomy'          => 'nivel',
                'placeholder'       => __( 'Selecione um Nível', 'ifrs-ingresso-theme' ),
                'add_new'           => false,
                'remove_default'    => true,
                'field_type'        => 'select_tree',
            ),
        ),
    );

    /**
     * Taxonomy Turno
     */
    $metaboxes[] = array(
        'title'      => __( 'Turnos', 'ifrs-ingresso-theme' ),
        'post_types' => 'curso',
        'context'    => 'side',
        'priority'   => 'low',
        'fields'     => array(
            array(
                'id'                => $prefix . 'turno_taxonomy',
                'desc'              => __( 'Escolha os Turnos do Curso.', 'ifrs-ingresso-theme' ),
                'type'              => 'taxonomy',
                'taxonomy'          => 'turno',
                'add_new'           => false,
                'remove_default'    => true,
                'field_type'        => 'checkbox_list',
            ),
        ),
    );

    /**
     * Coordenador do Curso
     */
    $metaboxes[] = array(
        'title'      => __( 'Coordenador do Curso', 'ifrs-ingresso-theme' ),
        'post_types' => 'curso',
        'context'    => 'side',
        'priority'   => 'low',
        'fields'     => array(
            array(
                'id'         => $prefix . 'coordenador_nome',
                'name'       => __( 'Nome', 'ifrs-ingresso-theme' ),
                'type'       => 'text',
            ),
            array(
                'id'         => $prefix . 'coordenador_email',
                'name'       => __( 'E-mail', 'ifrs-ingresso-theme' ),
                'type'       => 'email',
            ),
            array(
                'id'   => $prefix . 'coordenador_lattes',
                'name' => __( 'Currículo Lattes', 'ifrs-ingresso-theme' ),
                'desc' => __( 'URL da página do Currículo Lattes.', 'ifrs-ingresso-theme' ),
                'type' => 'url',
            )
        ),
    );

    return $metaboxes;
} );

// Options
add_action( 'cmb2_admin_init', function() {
	$options = new_cmb2_box( array(
		'id'           => 'ingresso_cursos_option_metabox',
		'title'        => esc_html__( 'Opções para Cursos', 'ifrs-ingresso-theme' ),
		'object_types' => array( 'options-page' ),
		'option_key'      => 'cursos_options',
		// 'icon_url'        => 'dashicons-palmtree',
		'menu_title'      => esc_html__( 'Opções', 'ifrs-ingresso-theme' ),
		'parent_slug'     => 'edit.php?post_type=curso',
		'capability'      => 'manage_cursos',
		// 'position'        => 1,
		// 'admin_menu_hook' => 'network_admin_menu',
		// 'display_cb'      => false,
		// 'save_button'     => esc_html__( 'Salvar Opções', 'ifrs-ingresso-theme' ),
	) );

	$options->add_field( array(
		'name' => __( 'Descrição', 'ifrs-ingresso-theme' ),
		'desc' => __( 'Descrição antes da lista de Cursos.', 'ifrs-ingresso-theme' ),
		'id'   => 'desc',
		'type' => 'wysiwyg',
	) );

} );
function cursos_get_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		return cmb2_get_option( 'cursos_options', $key, $default );
	}

	$opts = get_option( 'cursos_options', $default );

	$val = $default;

	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}

	return $val;
}

/* Custom Query */
add_action( 'pre_get_posts', function( $query ) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_post_type_archive('curso') || $query->is_tax('modalidade') || $query->is_tax('nivel') || $query->is_tax('turno')) {
            $query->set('posts_per_page', -1);
            $query->set('nopaging', true);
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
        }
    }
} );

/* Disable Gutenberg */
add_filter('use_block_editor_for_post_type', function($current_status, $post_type) {
    if ($post_type === 'curso') return false;
    return $current_status;
}, 10, 2);
