<?php
    $unidades = get_terms(array(
        'taxonomy' => 'unidade',
        'hide_empty' => false,
    ));
?>
<h2 class="cursos__title">
    <?php
        _e('Cursos', 'ifrs-portal-theme');

        if (is_tax('curso_modalidade') && !isset($_POST['curso_modalidade'])) {
            printf(__(' na modalidade %s', 'ifrs-portal-theme'), single_term_title('', false));
        }

        if (is_tax('curso_unidade') && !isset($_POST['curso_unidade'])) {
            printf(__(' ofertados no Campus %s', 'ifrs-portal-theme'), single_term_title('', false));
        }

        if (is_tax('curso_nivel') && !isset($_POST['curso_nivel'])) {
            printf(__(' do nível %s', 'ifrs-portal-theme'), single_term_title('', false));
        }

        if (is_tax('curso_turno') && !isset($_POST['curso_turno'])) {
            printf(__(' ofertados no turno da %s', 'ifrs-portal-theme'), single_term_title('', false));
        }

        if (is_search() && get_search_query()) {
            printf(__('<small>(Resultados com o termo &ldquo;%s&rdquo;)</small>', 'ifrs-portal-theme'), get_search_query());
        }
    ?>
</h2>

<div class="content">
    <section class="container">
        <?php echo get_template_part('partials/curso-filter'); ?>

        <ul class="nav nav-pills justify-content-center my-3 mx-auto" role="tablist">
            <?php foreach ($unidades as $unidade) : ?>
                <?php if (!empty($unidade->term_id)) : ?>
                    <li class="nav-item mx-1 my-1">
                        <button class="nav-link" type="button" data-bs-toggle="pill" data-bs-target="#<?php echo $unidade->slug; ?>" role="tab" aria-controls="<?php echo $unidade->slug; ?>" aria-selected="false"><?php echo $unidade->name; ?></button>
                    </li>
                <?php else : ?>
                    <li class="nav-item mx-1 my-1">
                        <button class="nav-link active" type="button" data-bs-toggle="pill" data-bs-target="#tudo" role="tab" aria-controls="tudo" aria-selected="true">Tudo</button>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>

        <div class="tab-content mb-3" aria-live="polite">
            <?php foreach ($unidades as $unidade) : ?>
                <?php
                    $cursos = new WP_Query(array(
                        'post_type' => 'curso',
                        'nopaging' => true,
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'unidade',
                                'terms' => $unidade->term_id,
                            ),
                        ),
                    ));
                ?>
                <div class="tab-pane fade" id="<?php echo $unidade->slug; ?>" role="tabpanel">
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
