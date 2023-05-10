<?php
add_action( 'init', function() {
    $labels = array(
        'name'                  => _x( 'Cursos', 'Post Type General Name', 'ifrs-estude-theme' ),
        'singular_name'         => _x( 'Curso', 'Post Type Singular Name', 'ifrs-estude-theme' ),
        'menu_name'             => __( 'Cursos', 'ifrs-estude-theme' ),
        'name_admin_bar'        => __( 'Curso', 'ifrs-estude-theme' ),
        'archives'              => __( 'Arquivo de Cursos', 'ifrs-estude-theme' ),
        'attributes'            => __( 'Atributos de Curso', 'ifrs-estude-theme' ),
        'parent_item_colon'     => __( 'Curso Pai:', 'ifrs-estude-theme' ),
        'all_items'             => __( 'Todos os Cursos', 'ifrs-estude-theme' ),
        'add_new_item'          => __( 'Adicionar Novo Curso', 'ifrs-estude-theme' ),
        'add_new'               => __( 'Adicionar Novo', 'ifrs-estude-theme' ),
        'new_item'              => __( 'Novo Curso', 'ifrs-estude-theme' ),
        'edit_item'             => __( 'Editar Curso', 'ifrs-estude-theme' ),
        'update_item'           => __( 'Atualizar Curso', 'ifrs-estude-theme' ),
        'view_item'             => __( 'Ver Curso', 'ifrs-estude-theme' ),
        'view_items'            => __( 'Ver Cursos', 'ifrs-estude-theme' ),
        'search_items'          => __( 'Buscar Curso', 'ifrs-estude-theme' ),
        'not_found'             => __( 'Não encontrado', 'ifrs-estude-theme' ),
        'not_found_in_trash'    => __( 'Não encontrado na Lixeira', 'ifrs-estude-theme' ),
        'featured_image'        => __( 'Marca do Curso', 'ifrs-estude-theme' ),
        'set_featured_image'    => __( 'Escolher imagem', 'ifrs-estude-theme' ),
        'remove_featured_image' => __( 'Remover imagem', 'ifrs-estude-theme' ),
        'use_featured_image'    => __( 'Usar como imagem', 'ifrs-estude-theme' ),
        'insert_into_item'      => __( 'Inserir no Curso', 'ifrs-estude-theme' ),
        'uploaded_to_this_item' => __( 'Enviado para esse Curso', 'ifrs-estude-theme' ),
        'items_list'            => __( 'Lista de Cursos', 'ifrs-estude-theme' ),
        'items_list_navigation' => __( 'Lista de navegação de Cursos', 'ifrs-estude-theme' ),
        'filter_items_list'     => __( 'Filtrar lista de Cursos', 'ifrs-estude-theme' ),
    );

    $args = array(
        'label'               => __( 'Curso', 'ifrs-estude-theme' ),
        'description'         => __( 'Cursos', 'ifrs-estude-theme' ),
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
        'map_meta_cap'        => true,
        'capability_type'     => ['curso', 'cursos'],
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
     * Informações Gerais
     */
    $metaboxes[] = array(
        'title'      => __( 'Informações Gerais', 'ifrs-estude-theme' ),
        'post_types' => 'curso',
        'fields'     => array(
            // Carga Horária
            array(
                'id'         => $prefix . 'carga_horaria',
                'name'       => __( 'Carga Horária', 'ifrs-estude-theme' ),
                'desc'       => __( 'em horas (somente números).', 'ifrs-estude-theme' ),
                'type'       => 'text',
                'size'       => 10,
                'attributes' => array(
                    'required' => 'required',
                    'pattern'  => '\d*',
                ),
            ),
            // Duração
            array(
                'id'   => $prefix . 'duracao',
                'name' => __( 'Duração', 'ifrs-estude-theme' ),
                'desc' => __( '2 meses, 4 semestres, 3 anos, etc.', 'ifrs-estude-theme' ),
                'type' => 'text',
                'size' => 50,
            ),
            // EaD
            array(
                'id'   => $prefix . 'ead',
                'name' => __( 'Possui carga horária EaD?', 'ifrs-estude-theme' ),
                'desc' => __( 'Marque caso o Curso possua parte da carga horária a distância.', 'ifrs-estude-theme' ),
                'type' => 'switch',
            ),
            // Estágio
            array(
                'id'   => $prefix . 'estagio',
                'name' => __( 'Possui estágio obrigatório?', 'ifrs-estude-theme' ),
                'desc' => __( 'Marque caso o Curso possua estágio obrigatório.', 'ifrs-estude-theme' ),
                'type' => 'switch',
            ),
            // Avaliação
            array(
                'id'   => $prefix . 'nota',
                'name' => __( 'Avaliação do Curso', 'ifrs-estude-theme' ),
                'desc' => __( 'Nota recebida pela última avaliação do Curso, se houver.', 'ifrs-estude-theme' ),
                'size' => 5,
                'type' => 'number',
                'step' => '1',
                'min'  => '1',
                'max'  => '5',
            ),
            // Local das Aulas
            array(
                'id'   => $prefix . 'local',
                'name' => __( 'Local das Aulas', 'ifrs-estude-theme' ),
                'desc' => __( 'Indique o local de realização das aulas, caso não for nas dependências da Unidade indicada.', 'ifrs-estude-theme' ),
                'type' => 'textarea',
                'cols' => 50,
                'rows' => 5,
            ),
        ),
    );

    /**
     * Turnos
    */
    $metaboxes[] = array(
        'title'      => __( 'Horários das Aulas', 'ifrs-estude-theme' ),
        'post_types' => 'curso',
        'fields'     => array(
            array(
                'id'   => $prefix . 'desc',
                'desc' => __( 'Preencher os turnos de aula nos dias da semana. Caso não haja detalhamento suficiente, não preencha.', 'ifrs-estude-theme' ),
                'type' => 'heading',
            ),
            // Segunda-feira
            array(
                'id'             => $prefix . 'segunda_feira',
                'name'           => __( 'Segunda-feira', 'ifrs-estude-theme' ),
                'type'           => 'taxonomy_advanced',
                'taxonomy'       => 'turno',
                'add_new'        => false,
                'field_type'     => 'checkbox_list',
                'inline'         => true,
                'remove_default' => true,
            ),
            // Terça-feira
            array(
                'id'             => $prefix . 'terca_feira',
                'name'           => __( 'Terça-feira', 'ifrs-estude-theme' ),
                'type'           => 'taxonomy_advanced',
                'taxonomy'       => 'turno',
                'add_new'        => false,
                'field_type'     => 'checkbox_list',
                'inline'         => true,
                'remove_default' => true,
            ),
            // Quarta-feira
            array(
                'id'             => $prefix . 'quarta_feira',
                'name'           => __( 'Quarta-feira', 'ifrs-estude-theme' ),
                'type'           => 'taxonomy_advanced',
                'taxonomy'       => 'turno',
                'add_new'        => false,
                'field_type'     => 'checkbox_list',
                'inline'         => true,
                'remove_default' => true,
            ),
            // Quinta-feira
            array(
                'id'             => $prefix . 'quinta_feira',
                'name'           => __( 'Quinta-feira', 'ifrs-estude-theme' ),
                'type'           => 'taxonomy_advanced',
                'taxonomy'       => 'turno',
                'add_new'        => false,
                'field_type'     => 'checkbox_list',
                'inline'         => true,
                'remove_default' => true,
            ),
            // Sexta-feira
            array(
                'id'             => $prefix . 'sexta_feira',
                'name'           => __( 'Sexta-feira', 'ifrs-estude-theme' ),
                'type'           => 'taxonomy_advanced',
                'taxonomy'       => 'turno',
                'add_new'        => false,
                'field_type'     => 'checkbox_list',
                'inline'         => true,
                'remove_default' => true,
            ),
            array(
                'type' => 'divider',
            ),
            // Sábado
            array(
                'id'             => $prefix . 'sabado',
                'name'           => __( 'Sábado', 'ifrs-estude-theme' ),
                'type'           => 'taxonomy_advanced',
                'taxonomy'       => 'turno',
                'add_new'        => false,
                'field_type'     => 'checkbox_list',
                'inline'         => true,
                'remove_default' => true,
            ),
            // Domingo
            array(
                'id'             => $prefix . 'domingo',
                'name'           => __( 'Domingo', 'ifrs-estude-theme' ),
                'type'           => 'taxonomy_advanced',
                'taxonomy'       => 'turno',
                'add_new'        => false,
                'field_type'     => 'checkbox_list',
                'inline'         => true,
                'remove_default' => true,
            ),

            // Aviso de Turnos variados
            array(
                'type' => 'divider',
            ),
            array(
                'id'   => $prefix . 'turnos_variados',
                'name' => __( 'Turnos Variados', 'ifrs-estude-theme' ),
                'desc' => __( 'Marque caso o Curso possua turnos que variam ou que sejam não convencionais. Por exemplo, turnos diferentes por semestre de oferta do Curso.', 'ifrs-estude-theme' ),
                'type' => 'switch',
            ),

        ),
    );

    /**
     * Taxonomy Unidade
     */
    $metaboxes[] = array(
        'title'      => __( 'Unidade', 'ifrs-estude-theme' ),
        'post_types' => 'curso',
        'context'    => 'side',
        'priority'   => 'low',
        'fields'     => array(
            array(
                'id'                => $prefix . 'unidade_taxonomy',
                'desc'              => __( 'Escolha as Unidades de oferta do Curso.', 'ifrs-estude-theme' ),
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
        'title'      => __( 'Modalidade', 'ifrs-estude-theme' ),
        'post_types' => 'curso',
        'context'    => 'side',
        'priority'   => 'low',
        'fields'     => array(
            array(
                'id'                => $prefix . 'modalidade_taxonomy',
                'desc'              => __( 'Escolha a Modalidade do Curso.', 'ifrs-estude-theme' ),
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
        'title'      => __( 'Nível', 'ifrs-estude-theme' ),
        'post_types' => 'curso',
        'context'    => 'side',
        'priority'   => 'low',
        'fields'     => array(
            array(
                'id'                => $prefix . 'nivel_taxonomy',
                'desc'              => __( 'Escolha o Nível do Curso.', 'ifrs-estude-theme' ),
                'type'              => 'taxonomy',
                'taxonomy'          => 'nivel',
                'placeholder'       => __( 'Selecione um Nível', 'ifrs-estude-theme' ),
                'add_new'           => false,
                'remove_default'    => true,
                'field_type'        => 'select_tree',
            ),
        ),
    );

    /**
     * URL
     */
    $metaboxes[] = array(
        'title'      => __( 'Endereço para mais informações', 'ifrs-estude-theme' ),
        'post_types' => 'curso',
        'context'    => 'side',
        'priority'   => 'low',
        'fields'     => array(
            array(
                'id'   => $prefix . 'url',
                'name' => __( 'URL', 'ifrs-estude-theme' ),
                'desc' => __( 'Preencha o endereço da página com mais informações do Curso.', 'ifrs-estude-theme' ),
                'type' => 'url',
            ),
        ),
    );

    return $metaboxes;
} );

// Options
add_action( 'cmb2_admin_init', function() {
	$options = new_cmb2_box( array(
		'id'           => 'ingresso_cursos_option_metabox',
		'title'        => esc_html__( 'Opções para Cursos', 'ifrs-estude-theme' ),
		'object_types' => array( 'options-page' ),
		'option_key'   => 'cursos_options',
		'menu_title'   => esc_html__( 'Opções', 'ifrs-estude-theme' ),
		'parent_slug'  => 'edit.php?post_type=curso',
		'capability'   => 'manage_cursos',
	) );

	$options->add_field( array(
		'name' => __( 'Descrição', 'ifrs-estude-theme' ),
		'desc' => __( 'Descrição antes da lista de Cursos.', 'ifrs-estude-theme' ),
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

/* Disable Main Query */
add_filter( 'posts_request', function( $request, $query ) {
    if ($query->is_main_query() && !$query->is_admin && $query->is_post_type_archive('curso')) {
        return false;
    } else {
        return $request;
    }
}, 99, 2 );

/* Disable Gutenberg */
add_filter('use_block_editor_for_post_type', function($current_status, $post_type) {
    if ($post_type === 'curso') return false;
    return $current_status;
}, 10, 2);
