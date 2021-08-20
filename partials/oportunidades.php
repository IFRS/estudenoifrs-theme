<?php
    $tipos = get_terms(array(
        'taxonomy' => 'tipo',
        'hide_empty' => false,
    ));
    array_unshift($tipos, new stdClass());
?>
<section class="container">
    <ul class="nav nav-pills justify-content-center mt-3 mb-1 mx-auto tipo-list" role="tablist">
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

                if (!empty($_POST['curso_unidade'])) {
                    $cursos = new WP_Query(array(
                        'post_type' => 'curso',
                        'nopaging' => true,
                        'posts_per_page' => -1,
                        'fields' => 'ids',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'unidade',
                                'field'    => 'slug',
                                'terms'    => (array) $_POST['curso_unidade'],
                            )
                        ),
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
                    <button class="nav-link" type="button" data-bs-toggle="pill" data-bs-target="#<?php echo $tipo->slug; ?>" role="tab" aria-controls="<?php echo $tipo->slug; ?>" aria-selected="false"><?php echo $tipo->name; ?>&nbsp;&nbsp;<span class="badge"><?php echo $tipo->oportunidades->post_count; ?></span></button>
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

<div class="destaque">
    <section class="container">
        <div class="oportunidade-filter">
            <form action="<?php echo esc_url(home_url('/')); ?>" method="POST" class="oportunidade-filter__form row row-cols-sm-auto g-3 align-items-center">
                <?php $select_id = uniqid(); ?>
                <div class="col-12 col-md-11 m-0">
                    <label class="visually-hidden" for="select-<?php echo $select_id; ?>">Unidade</label>
                    <select name="curso_unidade[]" id="select-<?php echo $select_id; ?>" class="form-select flex-grow-0 w-auto">
                        <?php
                            $unidades = get_terms(array(
                                'taxonomy' => 'unidade',
                                'hide_empty' => false,
                            ));
                        ?>
                        <option hidden selected disabled>Unidade</option>
                        <?php foreach ($unidades as $unidade) : ?>
                            <?php $unidade_check = (!empty($_POST['curso_unidade']) && array_search($unidade->slug, $_POST['curso_unidade']) !== false); ?>
                            <option value="<?php echo $unidade->slug; ?>"<?php echo $unidade_check ? ' selected' : ''; ?>><?php echo $unidade->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-md-1 m-0 text-center">
                    <div class="btn-group" role="group" aria-label="Ações">
                        <button type="submit" class="btn">
                            <span class="visually-hidden">Filtrar Oportunidades</span>
                        </button>
                        <a href="<?php echo home_url(); ?>" class="btn oportunidade-filter__reset">
                            <span class="visually-hidden">Limpar Filtros</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-content mb-3" aria-live="polite">
            <?php foreach ($tipos as $tipo) : ?>
                <div class="tab-pane fade<?php echo (empty($tipo->term_id) ? ' active show' : ''); ?>" id="<?php echo (!empty($tipo->term_id) ? $tipo->slug : 'tudo'); ?>" role="tabpanel">
                    <?php if (!empty($tipo->description)) : ?>
                        <div class="tipo-description">
                            <?php echo wpautop($tipo->description); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($tipo->oportunidades->have_posts()) : ?>
                        <div class="oportunidades">
                            <?php while ($tipo->oportunidades->have_posts()) : $tipo->oportunidades->the_post(); ?>
                                <?php echo get_template_part('partials/oportunidade'); ?>
                            <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-info" role="alert">
                            N&atilde;o existem oportunidades<?php echo (is_tax('unidade')) ? ' nessa <strong>unidade</strong> ' : ' '; ?>para esse <strong>tipo</strong> no momento. Fique atento para novas publica&ccedil;&otilde;es.
                        </div>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>
