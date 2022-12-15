<?php get_header(); ?>

<?php $ead = !empty(get_post_meta( get_the_ID(), '_curso_ead', true )); ?>

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
            <div class="curso-info curso-info--turno">
                <?php $turnos =  wp_get_post_terms(get_the_ID(), 'turno', array('orderby' => 'term_order')); ?>
                <h4 class="curso-info__title"><?php echo _n('Turno', 'Turnos', count($turnos), 'ifrs-portal-theme'); ?></h4>
                <p class="curso-info__text">
                    <?php foreach ($turnos as $turno) : ?>
                        <a href="<?php echo get_term_link($turno); ?>"><?php echo $turno->name; ?></a><?php echo ($turno !== end($turnos)) ? ',&nbsp;' : ''; ?>
                    <?php endforeach; ?>
                </p>
            </div>
            <div class="curso-info curso-info--cargahoraria">
                <h4 class="curso-info__title"><?php _e('Dura&ccedil;&atilde;o', 'ifrs-portal-theme'); echo ($ead) ? '*' : ''; ?></h4>
                <p class="curso-info__text">
                    <?php
                        $duracao = get_post_meta( get_the_ID(), '_curso_duracao', true );
                        $cargahoraria = get_post_meta( get_the_ID(), '_curso_carga_horaria', true );
                    ?>
                    <?php if ($duracao) : ?>
                        <?php echo esc_html($duracao); ?> <span class="curso-info__text--lower">(<?php echo esc_html($cargahoraria); ?>h)</span>
                    <?php else : ?>
                        <span class="curso-info__text--lower">(<?php echo esc_html($cargahoraria); ?>h)</span>
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
        </aside>
        <hr class="curso__separator">
        <div class="curso__content">
            <?php if (has_post_thumbnail()) the_post_thumbnail('full', array('class' => 'img-fluid curso__thumb')); ?>
            <?php the_content(); ?>
            <?php if ($ead) : ?>
                <small class="text-secondary"><strong>*</strong>&nbsp;Esse curso possui parte de sua carga hor&aacute;ria a dist&acirc;ncia.</small>
            <?php endif; ?>
        </div>
    </section>
</article>

<?php get_footer(); ?>
