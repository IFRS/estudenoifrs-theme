<?php get_header(); ?>

<article class="curso">
    <section class="container">
        <h2 class="curso__title"><?php the_title(); ?></h2>
        <aside class="curso__meta">
            <div class="curso-info curso-info--modalidade">
                <h4 class="curso-info__title"><?php _e('Modalidade', 'ifrs-portal-theme'); ?></h4>
                <p class="curso-info__text"><?php the_terms( get_the_ID(), 'modalidade', '', ', ' ); ?></p>
            </div>
            <div class="curso-info curso-info--nivel">
                <h4 class="curso-info__title"><?php _e('Nível', 'ifrs-portal-theme'); ?></h4>
                <p class="curso-info__text">
                    <?php $niveis = wp_get_post_terms(get_the_ID(), 'nivel', array('orderby' => 'term_order')); ?>
                    <?php foreach ($niveis as $nivel) : ?>
                        <a href="<?php echo get_term_link($nivel); ?>"><?php echo $nivel->name; ?></a>
                        <?php echo ($nivel !== end($niveis)) ? '<strong> / </strong>' : ''; ?>
                    <?php endforeach; ?>
                </p>
            </div>
            <div class="curso-info curso-info--unidade">
                <?php $unidades_count = count(wp_get_post_terms(get_the_ID(), 'unidade', array('fields' => 'ids'))); ?>
                <h4 class="curso-info__title"><?php echo _n('Unidade', 'Unidades', $unidades_count, 'ifrs-portal-theme'); ?></h4>
                <p class="curso-info__text"><?php the_terms( get_the_ID(), 'unidade', '', ', ' ); ?></p>
            </div>
            <div class="curso-info curso-info--cargahoraria">
                <h4 class="curso-info__title"><?php _e('Dura&ccedil;&atilde;o', 'ifrs-portal-theme'); ?></h4>
                <p class="curso-info__text">
                    <?php
                        $duracao = get_post_meta( get_the_ID(), '_curso_duracao', true );
                        $cargahoraria = get_post_meta( get_the_ID(), '_curso_carga_horaria', true );
                    ?>
                    <?php if ($duracao) : ?>
                        <?php echo esc_html($duracao); ?> <span class="curso-info__text--lower">(<?php echo esc_html($cargahoraria); ?>h)</span>
                    <?php else : ?>
                        <span class="curso-info__text--lower"><?php echo esc_html($cargahoraria); ?>h</span>
                    <?php endif; ?>
                </p>
            </div>
            <?php $nota_mec = get_post_meta( get_the_ID(), '_curso_nota', true ); ?>
            <?php if (!empty($nota_mec)) : ?>
                <div class="curso-info curso-info--nota">
                    <h4 class="curso-info__title"><?php _e('Avalia&ccedil;&atilde;o do Curso', 'ifrs-portal-theme'); ?></h4>
                    <p class="curso-info__text"><?php echo esc_html($nota_mec); ?></p>
                </div>
            <?php endif; ?>
            <?php $ead = !empty(get_post_meta( get_the_ID(), '_curso_ead', true )); ?>
            <?php if ($ead) : ?>
                <div class="curso-info curso-info--ead">
                    <!-- <h4 class="curso-info__title"><?php _e('EaD', 'ifrs-portal-theme'); ?></h4> -->
                    <p class="curso-info__text"><?php _e('Esse curso possui parte de sua carga hor&aacute;ria a dist&acirc;ncia.', 'ifrs-portal-theme'); ?></p>
                </div>
            <?php endif; ?>
            <?php $estagio = !empty(get_post_meta( get_the_ID(), '_curso_estagio', true )); ?>
            <?php if ($ead) : ?>
                <div class="curso-info curso-info--estagio">
                    <p class="curso-info__text"><?php _e('Esse curso possui est&aacute;gio obrigat&oacute;rio.', 'ifrs-portal-theme'); ?></p>
                </div>
            <?php endif; ?>
            <?php
                $turnos = array(
                    'Segunda-feira' => get_post_meta( get_the_ID(), '_curso_segunda_feira', true ),
                    'Terça-feira' => get_post_meta( get_the_ID(), '_curso_terca_feira', true ),
                    'Quarta-feira' => get_post_meta( get_the_ID(), '_curso_quarta_feira', true ),
                    'Quinta-feira' => get_post_meta( get_the_ID(), '_curso_quinta_feira', true ),
                    'Sexta-feira' => get_post_meta( get_the_ID(), '_curso_sexta_feira', true ),
                    'Sábado' => get_post_meta( get_the_ID(), '_curso_sabado', true ),
                    'Domingo' => get_post_meta( get_the_ID(), '_curso_domingo', true ),
                );
                $has_turno = array_reduce($turnos, function($carry, $item) {
                    if (!$carry && !empty($item)) $carry = true;
                    return $carry;
                }, false);
            ?>
            <?php if ($has_turno) : ?>
            <div class="curso-info curso-info--turnos">
                <h4 class="curso-info__title"><?php echo _n('Turno', 'Turnos', count($turnos), 'ifrs-portal-theme'); ?></h4>
                <ul class="curso-info__list">
                    <?php foreach ($turnos as $dia => $turno) : ?>
                        <?php if ($turno) : ?>
                            <li><?php echo $dia; ?>:&nbsp;<strong><?php echo get_term($turno)->name; ?></strong></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </aside>

        <hr class="curso__separator">

        <div class="curso__content">
            <?php if (has_post_thumbnail()) the_post_thumbnail('full', array('class' => 'img-fluid curso__thumb')); ?>
            <?php the_content(); ?>
        </div>
    </section>
</article>

<?php get_footer(); ?>
