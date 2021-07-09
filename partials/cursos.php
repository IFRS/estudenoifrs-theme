<section class="container">
    <div class="row">
        <div class="col-12 col-lg-9" class="cursos">
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
            <?php if (have_posts()) : ?>
                <div class="cursos__content">
                <?php while(have_posts()) : the_post(); ?>
                    <?php echo get_template_part('partials/curso-item'); ?>
                <?php endwhile; ?>
                </div>
            <?php else : ?>
                <?php if (is_search()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <p><?php _e('N&atilde;o foram encontrados Cursos com os termos buscados.', 'ifrs-portal-theme'); ?></p>
                    </div>
                <?php else : ?>
                    <div class="alert alert-warning" role="alert">
                        <strong><?php _e('Ops!'); ?></strong>&nbsp;<?php _e('N&atilde;o foram encontrados Cursos publicados.', 'ifrs-portal-theme'); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="col-12 col-lg-3">
            <?php echo get_template_part('partials/curso-filter'); ?>
        </div>
    </div>
</section>
