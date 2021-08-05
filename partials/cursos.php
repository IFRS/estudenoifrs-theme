<?php
    $unidades = get_terms(array(
        'taxonomy' => 'unidade',
        'hide_empty' => false,
    ));

    $unidade_random = array_rand($unidades);

    $tax_query = array();

    if (!empty($_POST['modalidade'])) {
        $tax_query[] = array(
            'taxonomy' => 'modalidade',
            'field' => 'slug',
            'terms' => sanitize_text_field($_POST['modalidade']),
        );
    }

    if (!empty($_POST['nivel'])) {
        $tax_query[] = array(
            'taxonomy' => 'nivel',
            'field' => 'slug',
            'terms' => sanitize_text_field($_POST['nivel']),
        );
    }

    if (!empty($_POST['turno'])) {
        $tax_query[] = array(
            'taxonomy' => 'turno',
            'field' => 'slug',
            'terms' => sanitize_text_field($_POST['turno']),
        );
    }

    $main_query = array(
        'post_type' => 'curso',
        'nopaging' => true,
        'posts_per_page' => -1,
    );

    if (!empty($_POST['q'])) {
        $main_query['s'] = sanitize_text_field($_POST['q']);
    }
?>
<section class="container">
    <h2 class="cursos__title">
        <?php
            _e('Cursos', 'ifrs-portal-theme');

            if (is_tax('modalidade') && !isset($_POST['modalidade'])) {
                printf(__(' na modalidade %s', 'ifrs-portal-theme'), single_term_title('', false));
            }

            if (is_tax('unidade') && !isset($_POST['unidade'])) {
                printf(__(' ofertados no Campus %s', 'ifrs-portal-theme'), single_term_title('', false));
            }

            if (is_tax('nivel') && !isset($_POST['nivel'])) {
                printf(__(' do nível %s', 'ifrs-portal-theme'), single_term_title('', false));
            }

            if (is_tax('turno') && !isset($_POST['turno'])) {
                printf(__(' ofertados no turno da %s', 'ifrs-portal-theme'), single_term_title('', false));
            }

            if (is_search() && get_search_query()) {
                printf(__('<small>(Resultados com o termo &ldquo;%s&rdquo;)</small>', 'ifrs-portal-theme'), get_search_query());
            }
        ?>
    </h2>
</section>

<div class="content">
    <section class="container">
        <?php echo get_template_part('partials/curso-filter'); ?>

        <ul class="nav nav-pills justify-content-center my-3 mx-auto" role="tablist">
            <?php foreach ($unidades as $key => $unidade) : ?>
                <li class="nav-item mx-1 my-1">
                    <button class="nav-link<?php echo ($key === $unidade_random) ? ' active' : ''; ?>" type="button" data-bs-toggle="pill" data-bs-target="#<?php echo $unidade->slug; ?>" role="tab" aria-controls="<?php echo $unidade->slug; ?>" aria-selected="false"><?php echo $unidade->name; ?></button>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="tab-content mb-3" aria-live="polite">
            <?php foreach ($unidades as $key => $unidade) : ?>
                <?php
                    $tax_query_local = $tax_query;
                    $tax_query_local[] = array(
                        'taxonomy' => 'unidade',
                        'terms' => $unidade->term_id,
                    );
                    $main_query['tax_query'] = $tax_query_local;

                    $cursos = new WP_Query($main_query);
                ?>
                <div class="tab-pane fade<?php echo ($key === $unidade_random) ? ' active show' : ''; ?>" id="<?php echo $unidade->slug; ?>" role="tabpanel">
                    <?php if ($cursos->have_posts()) : ?>
                        <div class="cursos__list">
                            <?php while ($cursos->have_posts()) : $cursos->the_post(); ?>
                                <?php echo get_template_part('partials/curso-item'); ?>
                            <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-info" role="alert">
                            N&atilde;o existem Cursos cadastrados no momento. Fique atento para novas publica&ccedil;&otilde;es.
                        </div>
                    <?php endif; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endforeach; ?>
        </div>
    </section>
</div>
