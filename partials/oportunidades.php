<section class="container">
    <div class="row">
        <div class="col-12">
            <?php
                $formas = get_terms(array(
                    'taxonomy' => 'forma',
                    'hide_empty' => false,
                ));
                array_unshift($formas, 0);
            ?>
            <ul class="nav nav-pills justify-content-center my-3" role="tablist">
                <?php foreach ($formas as $forma) : ?>
                    <?php if ($forma) : ?>
                        <li class="nav-item mx-3 mb-3">
                            <button class="nav-link btn btn-forma" type="button" data-toggle="pill" data-target="#tab-forma-<?php echo $forma->term_id; ?>" role="tab" aria-controls="collapse-forma-<?php echo $forma->term_id; ?>" aria-selected="false"><?php echo $forma->name; ?></button>
                        </li>
                    <?php else : ?>
                        <li class="nav-item mx-3">
                            <button class="nav-link btn btn-forma active" type="button" data-toggle="pill" data-target="#tab-forma-todas" role="tab" aria-controls="collapse-forma-todas" aria-selected="true">Tudo</button>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>

<div class="content">
    <section class="container">
        <div class="row">
            <div class="col-12">
                <div class="tab-content">
                    <?php foreach ($formas as $forma) : ?>
                        <?php
                            $tax_query = array();
                            if ($forma) {
                                $tax_query[] = array(
                                    'taxonomy' => 'forma',
                                    'terms' => $forma->term_id,
                                );
                            }
                            $args = array(
                                'post_type' => 'oportunidade',
                                'nopaging' => true,
                                'posts_per_page' => -1,
                                'tax_query' => $tax_query,
                                'meta_key' => '_oportunidade_inscricao_termino',
                                'orderby' => 'meta_value_num',
                                'order' => 'ASC',
                            );

                            $oportunidades = new WP_Query($args);
                        ?>
                        <div class="tab-pane fade<?php echo (!$forma ? ' active show' : ''); ?>" id="tab-forma-<?php echo ($forma ? $forma->term_id : 'todas'); ?>">
                            <?php if ($oportunidades->have_posts()) : ?>
                                <div class="oportunidades">
                                    <?php while ($oportunidades->have_posts()) : $oportunidades->the_post(); ?>
                                        <?php
                                            $today = new Datetime("now - 1 day");
                                            if (get_post_meta( get_the_ID(), '_oportunidade_inscricao_termino', true ) < $today->format('U')) {
                                                continue;
                                            }
                                        ?>
                                        <?php echo get_template_part('partials/oportunidade'); ?>
                                    <?php endwhile; ?>
                                </div>
                            <?php else : ?>
                                <div class="alert alert-info" role="alert">
                                    N&atilde;o existem oportunidades para essa forma de ingresso no momento. Fique atento para novas publica&ccedil;&otilde;es.
                                </div>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</div>
