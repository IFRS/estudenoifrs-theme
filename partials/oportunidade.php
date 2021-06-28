<?php $forma_ingresso = get_the_terms(get_the_ID(), 'forma'); ?>
<div class="oportunidade oportunidade--<?php echo $forma_ingresso[0]->slug; ?><?php echo (is_singular('oportunidade')) ? ' oportunidade--open' : ''; ?>" data-flip-key="oportunidade-<?php the_ID(); ?>">
    <div class="oportunidade__header">
        <p class="oportunidade__forma"><?php echo $forma_ingresso[0]->name; ?></p>
        <?php if (!is_singular('oportunidade')) : ?>
            <button class="btn oportunidade__btn-toggle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Expandir">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="square" stroke-linejoin="arcs" stroke-width="3" viewBox="0 0 24 24">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
            </button>
        <?php endif; ?>
    </div>
    <h3 class="oportunidade__title"><?php the_title(); ?></h3>
    <?php
        $isencao_inicio = get_post_meta( get_the_ID(), '_oportunidade_isencao_inicio', true );
        $isencao_termino = get_post_meta( get_the_ID(), '_oportunidade_isencao_termino', true );

        $isencao_inicio = ($isencao_inicio ? gmdate('d/m/y', $isencao_inicio) : false);
        $isencao_termino = ($isencao_termino ? gmdate('d/m/y', $isencao_termino) : false);

        $inscricao_inicio = gmdate('d/m/y', get_post_meta( get_the_ID(), '_oportunidade_inscricao_inicio', true ));
        $inscricao_termino = gmdate('d/m/y', get_post_meta( get_the_ID(), '_oportunidade_inscricao_termino', true ));

        $hoje = gmdate('d/m/y', time());
    ?>
    <?php if ($isencao_inicio && $isencao_termino) : ?>
        <p class="oportunidade__meta oportunidade__meta--isencao<?php echo ($isencao_termino < $hoje) ? ' text-muted text-decoration-line-through' : ''; ?>">Isen&ccedil;&atilde;o da Taxa de Inscri&ccedil;&atilde;o de <strong><?php echo $isencao_inicio; ?></strong> at&eacute; <strong class="<?php echo ($isencao_termino == $hoje) ? 'text-danger' : ''; ?>"><?php echo $isencao_termino; ?></strong></p>
    <?php else : ?>
        <p class="oportunidade__meta oportunidade__meta--gratis">Inscri&ccedil;&atilde;o <strong>gratuita</strong></p>
    <?php endif; ?>
    <p class="oportunidade__meta oportunidade__meta--inscricao">Inscri&ccedil;&otilde;es de <strong><?php echo $inscricao_inicio; ?></strong> at&eacute; <strong class="<?php echo ($inscricao_termino == $hoje) ? 'text-danger' : ''; ?>"><?php echo $inscricao_termino; ?></strong></p>

    <hr class="oportunidade__separador">

    <?php $requisitos = get_post_meta( get_the_ID(), '_oportunidade_requisitos', true ); ?>
    <?php if (!empty($requisitos)) : ?>
        <div class="oportunidade__requisitos">
            <h4 class="oportunidade__subtitle">Requisitos m&iacute;nimos para o ingresso</h4>
            <?php echo wpautop($requisitos); ?>
        </div>
        <hr class="oportunidade__separador">
    <?php endif; ?>

    <?php $unidades = wp_get_post_terms(get_the_ID(), 'unidade', array('fields' => 'ids')); ?>
    <?php if ($unidades) : ?>
        <div class="oportunidade__unidades">
            <h4 class="oportunidade__subtitle"><?php echo _n( 'Unidade', 'Unidades', count($unidades) ); ?> de Oferta</h4>
            <?php echo get_the_term_list(get_the_ID(), 'unidade', '<ul class="oportunidade__campi-list"><li class="oportunidade__campus">', '</li><li class="oportunidade__campus">', '</li></ul>'); ?>
        </div>
    <?php endif; ?>

    <a href="<?php echo esc_url(get_post_meta( get_the_ID(), '_oportunidade_url', true )); ?>" class="oportunidade__info-link">
        Mais informa&ccedil;&otilde;es
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <g fill="none" fill-rule="evenodd">
                <path d="M18 14v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8c0-1.1.9-2 2-2h5M15 3h6v6M10 14L20.2 3.8"/>
            </g>
        </svg>
    </a>
</div>
