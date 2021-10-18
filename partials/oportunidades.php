<?php
    $tipos = get_terms(array(
        'taxonomy'   => 'tipo',
        'hide_empty' => false,
        'orderby'    => 'term_order',
    ));
    array_unshift($tipos, new stdClass());
?>
<section class="container">
    <h2 class="hero__title">Inscri&ccedil;&otilde;es <span>Abertas</span></h2>
    <ul class="nav nav-pills justify-content-center my-3 mx-auto tipo-list" role="tablist">
        <?php foreach ($tipos as &$tipo) : ?>
            <?php
                $today = new Datetime('today midnight');

                $tax_query = array();
                $meta_query = array();

                if (!empty($tipo->term_id)) {
                    $tax_query[] = array(
                        'taxonomy' => 'tipo',
                        'terms' => $tipo->term_id,
                    );
                }

                if (!empty($_POST['curso_unidade']) || !empty($_POST['curso_nivel'])) {
                    $curso_tax_query = array();

                    if (!empty($_POST['curso_unidade'])) {
                        $curso_tax_query[] = array(
                            'taxonomy' => 'unidade',
                            'field'    => 'slug',
                            'terms'    => (array) $_POST['curso_unidade'],
                        );
                    }

                    if (!empty($_POST['curso_nivel'])) {
                        $curso_tax_query[] = array(
                            'taxonomy' => 'nivel',
                            'field'    => 'slug',
                            'terms'    => (array) $_POST['curso_nivel'],
                        );
                    }

                    $cursos = new WP_Query(array(
                        'post_type' => 'curso',
                        'nopaging' => true,
                        'posts_per_page' => -1,
                        'fields' => 'ids',
                        'tax_query' => $curso_tax_query,
                    ));
                }

                if (isset($cursos)) {
                    $meta_query[] = array(
                        'key'     => '_oportunidade_cursos',
                        'value'   => !empty($cursos->posts) ? $cursos->posts : 0,
                        'compare' => 'IN',
                    );
                }

                $meta_query[] = array(
                    'key' => '_oportunidade_inscricao_termino',
                    'value' => $today->format('U'),
                    'compare' => '>=',
                    'type' => 'NUMERIC',
                );

                $args = array(
                    'post_type' => 'oportunidade',
                    'nopaging' => true,
                    'posts_per_page' => -1,
                    'tax_query' => $tax_query,
                    'meta_query' => $meta_query,
                    'meta_key' => '_oportunidade_inscricao_termino',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC',
                );

                $tipo->oportunidades = new WP_Query($args);
            ?>
            <?php if (!empty($tipo->term_id)) : ?>
                <li class="nav-item mx-1 my-1">
                    <button class="nav-link" type="button" data-bs-toggle="pill" data-bs-target="#<?php echo $tipo->slug; ?>" role="tab" aria-controls="<?php echo $tipo->slug; ?>" aria-selected="false"><?php echo $tipo->name; ?>&nbsp;&nbsp;<span class="badge"><?php echo ($tipo->oportunidades->post_count > 0) ? $tipo->oportunidades->post_count : 'em breve'; ?></span></button>
                </li>
            <?php else : ?>
                <li class="nav-item mx-1 my-1">
                    <button class="nav-link active" type="button" data-bs-toggle="pill" data-bs-target="#tudo" role="tab" aria-controls="tudo" aria-selected="true">Tudo&nbsp;&nbsp;<span class="badge"><?php echo $tipo->oportunidades->post_count; ?></span></button>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php unset($tipo); ?>
    </ul>
</section>

<section class="oportunidades">
    <div class="container">
        <?php get_template_part('partials/oportunidades-filter'); ?>
        <div class="tab-content mb-3" aria-live="polite">
            <?php foreach ($tipos as $tipo) : ?>
                <div class="tab-pane fade<?php echo (empty($tipo->term_id) ? ' active show' : ''); ?>" id="<?php echo (!empty($tipo->term_id) ? $tipo->slug : 'tudo'); ?>" role="tabpanel">
                    <?php if (!empty($tipo->description)) : ?>
                        <div class="tipo-description">
                            <?php echo wpautop($tipo->description); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($tipo->oportunidades->have_posts()) : ?>
                        <div class="oportunidades__list">
                            <?php while ($tipo->oportunidades->have_posts()) : $tipo->oportunidades->the_post(); ?>
                                <?php echo get_template_part('partials/oportunidade'); ?>
                            <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-info" role="alert">
                            N&atilde;o existem inscri&ccedil;&otilde;es abertas desse <strong>tipo</strong> no momento, fique atento para novas publica&ccedil;&otilde;es.
                            <br>
                            Enquanto isso, confira o nosso <a href="<?php echo get_post_type_archive_link( 'curso' ); ?>" class="alert-link">Guia de Cursos</a>.
                        </div>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
