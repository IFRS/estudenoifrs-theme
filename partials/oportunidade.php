<?php
    $hoje_meia_noite = new DateTimeImmutable('today midnight');
    $isencao_fim = DateTimeImmutable::createFromFormat('U', rwmb_meta( '_oportunidade_isencao_termino' ));

    $isencao_ja_acabou = $hoje_meia_noite > $isencao_fim;

    $isencao_inicio = rwmb_meta( '_oportunidade_isencao_inicio' );
    $isencao_termino = rwmb_meta( '_oportunidade_isencao_termino' );

    $isencao_inicio = ($isencao_inicio ? gmdate('d/m/y', $isencao_inicio) : false);
    $isencao_termino = ($isencao_termino ? gmdate('d/m/y', $isencao_termino) : false);

    $inscricao_inicio = gmdate('d/m/y', rwmb_meta( '_oportunidade_inscricao_inicio' ));
    $inscricao_termino = gmdate('d/m/y', rwmb_meta( '_oportunidade_inscricao_termino' ));

    $hoje = gmdate('d/m/y', time());

    $taxa = rwmb_meta( '_oportunidade_taxa' );

    $cursos_ids = rwmb_meta( '_oportunidade_cursos' );
    $cursos = array();
    $unidades = array();

    if (!empty($cursos_ids)) {
        $cursos = get_posts( array(
            'post_type'    => 'curso',
            'numberposts'  => -1,
            'orderby'      => 'title',
            'order'        => 'ASC',
            'include'      => $cursos_ids,
        ) );
        foreach ($cursos as $curso) {
            $campi = get_the_terms( $curso, 'unidade' );
            foreach ($campi as $campus) {
                if (!in_array($campus, $unidades)) array_push($unidades, $campus);
            }
        }
    }

    $requisitos = rwmb_meta( '_oportunidade_requisitos' );
?>

<div class="oportunidade<?php echo (is_singular('oportunidade')) ? ' oportunidade--open oportunidade--single' : ''; ?>" data-flip-key="oportunidade-<?php the_ID(); ?>">
    <div class="oportunidade__header">
        <?php if (!empty($cursos)) : ?>
            <button type="button" class="btn btn-link oportunidade__numero-cursos" data-bs-toggle="modal" data-bs-target="#cursos-<?php echo the_ID(); ?>">
                <?php printf('%d %s', count($cursos), _n('Curso', 'Cursos', count($cursos), 'ifrs-estude-theme')); ?>
            </button>
        <?php endif; ?>
        <?php if (!is_singular('oportunidade')) : ?>
            <button class="btn oportunidade__btn-toggle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Expandir">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="square" stroke-linejoin="arcs" stroke-width="3" viewBox="0 0 24 24">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
            </button>
        <?php endif; ?>
    </div>
    <h3 class="oportunidade__title"><?php the_title(); ?></h3>
    <?php if ($taxa) : ?>
        <p class="oportunidade__meta oportunidade__meta--taxa"><i class="fa-solid fa-dollar-sign"></i><span>Possui <strong>Taxa</strong> de Inscri&ccedil;&atilde;o</span></p>
    <?php else : ?>
        <p class="oportunidade__meta oportunidade__meta--taxa"><i class="fa-solid fa-dollar-sign"></i><span>Inscri&ccedil;&atilde;o <strong>gratuita</strong></span></p>
    <?php endif; ?>
    <?php if ($isencao_inicio && $isencao_termino) : ?>
        <p class="oportunidade__meta oportunidade__meta--isencao<?php echo ($isencao_ja_acabou) ? ' text-body-secondary text-decoration-line-through' : ''; ?>"><i class="fa-regular fa-clock"></i><span>Isen&ccedil;&atilde;o da Taxa de Inscri&ccedil;&atilde;o de <strong><?php echo $isencao_inicio; ?></strong> at&eacute; <strong class="<?php echo ($isencao_termino == $hoje) ? 'text-danger' : ''; ?>"><?php echo $isencao_termino; ?></strong></span></p>
    <?php endif; ?>
    <p class="oportunidade__meta oportunidade__meta--inscricao"><i class="fa-regular fa-calendar"></i><span>Inscri&ccedil;&otilde;es de <strong><?php echo $inscricao_inicio; ?></strong> at&eacute; <strong class="<?php echo ($inscricao_termino == $hoje) ? 'text-danger' : ''; ?>"><?php echo $inscricao_termino; ?></strong></span></p>

    <hr class="oportunidade__separador">

    <?php if (!empty($requisitos)) : ?>
        <div class="oportunidade__requisitos">
            <h4 class="oportunidade__subtitle">Requisitos m&iacute;nimos para o ingresso</h4>
            <?php echo apply_filters( 'the_content', $requisitos); ?>
        </div>
        <hr class="oportunidade__separador">
    <?php endif; ?>

    <?php if ($unidades) : ?>
        <div class="oportunidade__unidades">
            <h4 class="oportunidade__subtitle"><i class="fa-solid fa-building-columns me-2"></i><?php echo _n( 'Unidade', 'Unidades', count($unidades), 'ifrs-estude-theme' ); ?> de Oferta</h4>
            <ul class="oportunidade__campi-list">
                <?php foreach ($unidades as $unidade) : ?>
                    <li class="oportunidade__campus">
                        <a href="<?php echo get_term_link( $unidade->term_id, 'unidade' ); ?>" data-bs-toggle="modal" data-bs-target="#modal-unidade-<?php echo $unidade->term_id ?>"><?php echo $unidade->name; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($cursos)) : ?>
        <!-- Modal Cursos -->
        <div class="modal fade" id="cursos-<?php the_ID(); ?>" tabindex="-1" aria-labelledby="cursos-<?php the_ID(); ?>-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cursos-<?php the_ID(); ?>-label"><?php the_title(); ?> - Cursos</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar lista de Cursos"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-unstyled p-0">
                            <?php foreach ($cursos as $curso) : ?>
                                <?php $campi = get_the_terms( $curso, 'unidade' ); ?>
                                <li>
                                    <a href="<?php echo get_permalink($curso->ID); ?>"><?php echo $curso->post_title; ?></a>
                                    <?php if ($campi) : ?>
                                        <small>(<?php foreach ($campi as $campus) echo $campus->name, ($campus !== end($campi)) ? ', ' : ''; ?>)</small>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <a href="<?php echo esc_url(get_post_meta( get_the_ID(), '_oportunidade_url', true )); ?>" class="oportunidade__info-link">
        <i class="fa-solid fa-angle-right me-1"></i>Mais informa&ccedil;&otilde;es<span style="font-size: 0.75em;"><i class="fa-solid fa-arrow-up-right-from-square ms-1"></i></span>
    </a>
</div>

<?php echo get_template_part( 'partials/modal-unidades' ); ?>
