<section class="container">
    <?php if (is_tax('unidade')) : ?>
        <h2 class="text-center mb-3"><?php single_term_title( '', true ); ?></h2>
    <?php endif; ?>
    <?php
        $formas = get_terms(array(
            'taxonomy' => 'forma',
            'hide_empty' => false,
        ));
        array_unshift($formas, new stdClass());
    ?>
    <ul class="nav nav-pills justify-content-center mt-3 mb-1 mx-auto forma-list" role="tablist">
        <?php foreach ($formas as &$forma) : ?>
            <?php
                $today = new Datetime("now - 1 day");

                $tax_query = array();

                if (!empty($forma->term_id)) {
                    $tax_query[] = array(
                        'taxonomy' => 'forma',
                        'terms' => $forma->term_id,
                    );
                }

                if (is_tax('unidade')) {
                    $tax_query[] = array(
                        'taxonomy' => 'unidade',
                        'terms' => get_queried_object()->term_id,
                    );
                }

                $args = array(
                    'post_type' => 'oportunidade',
                    'nopaging' => true,
                    'posts_per_page' => -1,
                    'tax_query' => $tax_query,
                    'meta_key' => '_oportunidade_inscricao_termino',
                    'meta_compare' => '>=',
                    'meta_value' => $today->format('U'),
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC',
                );

                $forma->oportunidades = new WP_Query($args);
            ?>
            <?php if (!empty($forma->term_id)) : ?>
                <li class="nav-item mx-1 my-1">
                    <button class="nav-link" type="button" data-bs-toggle="pill" data-bs-target="#<?php echo $forma->slug; ?>" role="tab" aria-controls="<?php echo $forma->slug; ?>" aria-selected="false"><?php echo $forma->name; ?>&nbsp;&nbsp;<span class="badge"><?php echo $forma->oportunidades->post_count; ?></span></button>
                </li>
            <?php else : ?>
                <li class="nav-item mx-1 my-1">
                    <button class="nav-link active" type="button" data-bs-toggle="pill" data-bs-target="#tudo" role="tab" aria-controls="tudo" aria-selected="true">Tudo&nbsp;&nbsp;<span class="badge"><?php echo $forma->oportunidades->post_count; ?></span></button>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php unset($forma); ?>
    </ul>
</section>

<div class="content">
    <section class="container">
        <div class="filter-unidade">
            <form action="<?php echo esc_url(home_url('/')); ?>" method="GET" class="filter-unidade__form row row-cols-sm-auto g-3 align-items-center">
                <?php $select_id = uniqid(); ?>
                <div class="col-12 m-0">
                    <div class="input-group">
                        <label class="visually-hidden" for="select-<?php echo $select_id; ?>">Unidade</label>
                        <select name="unidade[]" id="select-<?php echo $select_id; ?>" class="form-select flex-grow-0 w-auto">
                            <?php
                                $unidades = get_terms(array(
                                    'taxonomy' => 'unidade',
                                    'hide_empty' => false,
                                ));
                            ?>
                            <option hidden selected disabled>Unidade</option>
                            <?php foreach ($unidades as $unidade) : ?>
                                <?php $unidade_check = (is_tax('unidade') && get_queried_object()->term_id == $unidade->term_id); ?>
                                <option value="<?php echo $unidade->slug; ?>"<?php echo $unidade_check ? ' selected' : ''; ?>><?php echo $unidade->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-sm">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-content mb-3" aria-live="polite">
            <?php foreach ($formas as $forma) : ?>
                <div class="tab-pane fade<?php echo (empty($forma->term_id) ? ' active show' : ''); ?>" id="<?php echo (!empty($forma->term_id) ? $forma->slug : 'tudo'); ?>" role="tabpanel">
                    <?php if (!empty($forma->description)) : ?>
                        <div class="forma-description">
                            <?php echo wpautop($forma->description); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($forma->oportunidades->have_posts()) : ?>
                        <div class="oportunidades">
                            <?php while ($forma->oportunidades->have_posts()) : $forma->oportunidades->the_post(); ?>
                                <?php echo get_template_part('partials/oportunidade'); ?>
                            <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-info" role="alert">
                            N&atilde;o existem oportunidades<?php echo (is_tax('unidade')) ? ' nessa <strong>unidade</strong> ' : ' '; ?>para essa <strong>forma de ingresso</strong> no momento. Fique atento para novas publica&ccedil;&otilde;es.
                        </div>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>
