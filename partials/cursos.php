<?php
    $is_filter = !empty($_POST['modalidade'])
        || is_tax('modalidade')
        || !empty($_POST['unidade'])
        || is_tax('unidade')
        || !empty($_POST['nivel'])
        || is_tax('nivel')
        || !empty($_POST['turno'])
        || is_tax('turno')
        || !empty($_POST['s'])
        || is_search();

    $unidades = get_terms(array(
        'taxonomy'   => 'unidade',
        'hide_empty' => false,
        'slug'       => !empty($_POST['unidade']) ? (array) $_POST['unidade'] : array(),
        'orderby'    => 'name',
        'order'      => 'ASC',
    ));

    $tax_query = array();

    if (!empty($_POST['modalidade'])) {
        $tax_query[] = array(
            'taxonomy' => 'modalidade',
            'field' => 'slug',
            'terms' => (array) $_POST['modalidade'],
        );
    }

    if (!empty($_POST['nivel'])) {
        $tax_query[] = array(
            'taxonomy' => 'nivel',
            'field' => 'slug',
            'terms' => (array) $_POST['nivel'],
        );
    }

    if (!empty($_POST['turno'])) {
        $tax_query[] = array(
            'taxonomy' => 'turno',
            'field' => 'slug',
            'terms' => (array) $_POST['turno'],
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

    foreach ($unidades as $key => $unidade) {
        $tax_query_local = $tax_query;
        $tax_query_local[] = array(
            'taxonomy' => 'unidade',
            'terms' => $unidade->term_id,
        );
        $main_query['tax_query'] = $tax_query_local;

        $unidade->cursos = new WP_Query($main_query);
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
        Conhe&ccedil;a nossos <span><?php _e('Cursos', 'ifrs-portal-theme'); ?></span>
        <?php
            if (is_tax('modalidade') && !isset($_POST['modalidade'])) {
                printf(__('<br><small>na modalidade %s</small>', 'ifrs-portal-theme'), single_term_title('', false));
            }

            if (is_tax('unidade') && !isset($_POST['unidade'])) {
                printf(__('<br><small>ofertados no %s</small>', 'ifrs-portal-theme'), single_term_title('', false));
            }

            if (is_tax('nivel') && !isset($_POST['nivel'])) {
                printf(__('<br><small>do nível %s</small>', 'ifrs-portal-theme'), single_term_title('', false));
            }

            if (is_tax('turno') && !isset($_POST['turno'])) {
                printf(__('<br><small>ofertados no turno da %s</small>', 'ifrs-portal-theme'), single_term_title('', false));
            }

            if (is_search() && get_search_query()) {
                printf(__('<br><small>(resultados com o termo &ldquo;%s&rdquo;)</small>', 'ifrs-portal-theme'), get_search_query());
            }
        ?>
    </h2>
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
            ?>
            <div class="cursos__unidade">
                <h3 class="cursos__unidade-title"><?php echo $unidade->name; ?>&nbsp;<span class="cursos__unidade-numero"><?php echo $unidade->cursos->found_posts; ?></span><span class="visually-hidden">&nbsp;Cursos</span></h3>
                <?php if ($unidade->cursos->have_posts()) : ?>
                    <div class="cursos__list">
                        <?php while ($unidade->cursos->have_posts()) : $unidade->cursos->the_post(); ?>
                            <?php echo get_template_part('partials/curso-item'); ?>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <div class="alert alert-info" role="alert">
                        N&atilde;o existem Cursos cadastrados em <?php echo $unidade->name; ?> no momento.
                    </div>
                <?php endif; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endforeach; ?>
        <?php if ($unidades_shown === 0) : ?>
            <div class="alert alert-danger">N&atilde;o foram encontrados Cursos com os crit&eacute;rios utilizados na busca.</div>
        <?php endif; ?>
    </div>
</section>
