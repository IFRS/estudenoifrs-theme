<?php
    $unidade_queried = $_POST['unidade'] ?? (is_tax('unidade') ? get_queried_object()->slug : null);
    $modalidade_queried = $_POST['modalidade'] ?? (is_tax('modalidade') ? get_queried_object()->slug : null);
    $nivel_queried = $_POST['nivel'] ?? (is_tax('nivel') ? get_queried_object()->slug : null);
    $turno_queried = $_POST['turno'] ?? (is_tax('turno') ? get_queried_object()->slug : null);

    $is_filter = !empty($unidade_queried)
        || is_tax('unidade')
        || !empty($modalidade_queried)
        || is_tax('modalidade')
        || !empty($nivel_queried)
        || is_tax('nivel')
        || !empty($turno_queried)
        || is_tax('turno')
        || !empty($_POST['s'])
        || is_search();


    $unidades_query = array(
        'taxonomy'   => 'unidade',
        'hide_empty' => false,
        'orderby'    => 'name',
        'order'      => 'ASC',
    );

    if (!empty($unidade_queried)) {
        $unidades_query['slug'] = (array) $unidade_queried;
    } elseif (is_tax( 'unidade' )) {
        $unidades_query['include'] = array(get_queried_object()->term_id);
    }

    $unidades = get_terms($unidades_query);

    $niveis_query = array(
        'taxonomy'   => 'nivel',
        'hide_empty' => false,
        'orderby'    => 'term_order',
    );

    if (!empty($nivel_queried)) {
        $niveis_query['slug'] = (array) $nivel_queried;
    }

    $niveis = get_terms($niveis_query);
    $niveis = array_reverse($niveis); // Inverte a ordem dos níveis para a remoção das duplicadas ser mais eficiente.

    $tax_query = array();

    if (!empty($modalidade_queried)) {
        $tax_query[] = array(
            'taxonomy' => 'modalidade',
            'field' => 'slug',
            'terms' => (array) $modalidade_queried,
        );
    }

    if (!empty($turno_queried)) {
        $tax_query[] = array(
            'taxonomy' => 'turno',
            'field' => 'slug',
            'terms' => (array) $turno_queried,
        );
    }

    if (!$is_filter && (is_tax( 'modalidade' ) || is_tax( 'nivel' ) || is_tax( 'turno' ))) {
        $tax_query[] = array(
            'taxonomy' => get_queried_object()->taxonomy,
            'terms' => get_queried_object()->term_id,
        );
    }

    $main_query = array(
        'post_type' => 'curso',
        'nopaging' => true,
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    );

    if (!empty($_POST['s'])) {
        $main_query['s'] = sanitize_text_field($_POST['s']);
    }

    function my_query_orderby($orderby_statement) {
        $orderby_statement = " wp_term.term_order DESC, ".$orderby_statement;
        return $orderby_statement;
    }

    foreach ($unidades as $unidade) {
        $unidade->cursos = new WP_Query();

        foreach ($niveis as $nivel) {
            $tax_query_local = array();
            $tax_query_local[] = array(
                'taxonomy' => 'unidade',
                'terms' => $unidade->term_id,
            );
            $tax_query_local[] = array(
                'taxonomy' => 'nivel',
                'terms' => $nivel->term_id,
                'include_children' => false,
            );

            $main_query['tax_query'] = array_merge($tax_query, $tax_query_local);

            /* Remove as duplicatas de trás para frente já que os níveis estão invertidos. */
            $previous_posts = array();
            foreach ((array) $unidade->cursos->posts as $previous_query_post) {
                $previous_posts[] = $previous_query_post->ID;
            }

            /* Se o curso já aparece no nível filho, não precisa ser incluído no nível pai. */
            if (!empty($previous_posts)) $main_query['post__not_in'] = $previous_posts;

            $query = new WP_Query($main_query);

            $unidade->cursos->posts = array_merge($query->posts, (array) $unidade->cursos->posts);
            $unidade->cursos->post_count = $unidade->cursos->post_count + $query->post_count;
            $unidade->cursos->found_posts = $unidade->cursos->found_posts + $query->found_posts;
        }
    }

    if ($is_filter) {
        usort($unidades, function($a, $b) {
            if ($a->cursos->found_posts === $b->cursos->found_posts) return 0;
            return ($a->cursos->found_posts > $b->cursos->found_posts) ? -1 : 1;
        });
    }

?>
<section class="container">
    <h2 class="hero__title">
        Conhe&ccedil;a nossos <span><?php _e('Cursos', 'ifrs-estude-theme'); ?></span>
        <?php
            if (is_tax('modalidade') && !isset($_POST['modalidade'])) {
                printf(__('<br><small>na modalidade &#34;%s&#34;</small>', 'ifrs-estude-theme'), get_the_archive_title());
            }

            if (is_tax('unidade') && !isset($_POST['unidade'])) {
                printf(__('<br><small>ofertados em &#34;%s&#34;</small>', 'ifrs-estude-theme'), single_term_title('', false));
            }

            if (is_tax('nivel') && !isset($_POST['nivel'])) {
                printf(__('<br><small>do nível &#34;%s&#34;</small>', 'ifrs-estude-theme'), single_term_title('', false));
            }

            if (is_tax('turno') && !isset($_POST['turno'])) {
                printf(__('<br><small>ofertados no turno &#34;%s&#34;</small>', 'ifrs-estude-theme'), single_term_title('', false));
            }

            if (is_search() && get_search_query()) {
                printf(__('<br><small>(resultados com o termo &ldquo;%s&rdquo;)</small>', 'ifrs-estude-theme'), get_search_query());
            }
        ?>
    </h2>
    <?php $desc = cursos_get_option('desc'); ?>
    <?php if (!empty($desc)) : ?>
        <div class="hero__text">
            <?php echo apply_filters( 'the_content', cursos_get_option('desc') ); ?>
        </div>
    <?php endif; ?>
</section>

<section class="cursos">
    <div class="container">
        <?php echo get_template_part('partials/curso-filter', null, array('is_filter' => $is_filter)); ?>

        <?php $unidades_shown = 0; ?>
        <?php foreach ($unidades as $key => $unidade) : ?>
            <?php
                if ($is_filter && $unidade->cursos->found_posts === 0) {
                    continue;
                }

                $unidades_shown++;

                $collapse_id = uniqid('collapse-');
            ?>
            <div class="cursos__unidade">
                <h3 class="cursos__unidade-title">
                    <a href="#<?php echo $collapse_id; ?>" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="<?php echo $collapse_id; ?>">
                        <span class="visually-hidden">Cursos em&nbsp;</span><?php echo $unidade->name; ?>
                    </a>
                </h3>
                <div class="cursos__list collapse show" id="<?php echo $collapse_id; ?>">
                    <?php if ($unidade->cursos->have_posts()) : ?>
                        <?php while ($unidade->cursos->have_posts()) : $unidade->cursos->the_post(); ?>
                            <?php echo get_template_part('partials/curso-item'); ?>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <div class="alert alert-info w-100" role="alert">
                            N&atilde;o existem Cursos cadastrados em <em><?php echo $unidade->name; ?></em> at&eacute; o momento.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endforeach; ?>
        <?php if ($unidades_shown === 0) : ?>
            <div class="alert alert-warning">N&atilde;o foram encontrados Cursos com os crit&eacute;rios utilizados na busca.</div>
        <?php endif; ?>
    </div>
</section>
