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
                    <?php $niveis = wp_get_post_terms(get_the_ID(), 'nivel', array('orderby' => 'term_id')); ?>
                    <?php foreach ($niveis as $nivel) : ?>
                        <a href="<?php echo get_term_link($nivel->term_id); ?>"><?php echo $nivel->name; ?></a>
                        <?php echo ($nivel !== end($niveis)) ? '<strong> / </strong>' : ''; ?>
                    <?php endforeach; ?>
                </p>
            </div>
            <div class="curso-info curso-info--unidade">
                <?php $unidades_count = count((array) get_the_terms( get_the_ID(), 'unidade')); ?>
                <h4 class="curso-info__title"><?php echo _n('Unidade', 'Unidades', $unidades_count, 'ifrs-portal-theme'); ?></h4>
                <p class="curso-info__text"><?php the_terms( get_the_ID(), 'unidade', '', ', ' ); ?></p>
            </div>
            <div class="curso-info curso-info--turno">
                <?php $turnos_count = count((array) get_the_terms( get_the_ID(), 'turno')); ?>
                <h4 class="curso-info__title"><?php echo _n('Turno', 'Turnos', $turnos_count, 'ifrs-portal-theme'); ?></h4>
                <p class="curso-info__text"><?php the_terms( get_the_ID(), 'turno', '', ', ' ); ?></p>
            </div>
            <div class="curso-info curso-info--cargahoraria">
                <h4 class="curso-info__title"><?php _e('Dura&ccedil;&atilde;o', 'ifrs-portal-theme'); echo ($ead) ? '*' : ''; ?></h4>
                <p class="curso-info__text"><?php echo esc_html(get_post_meta( get_the_ID(), '_curso_duracao', true )); ?> <span class="curso-info__text--lower">(<?php echo esc_html(get_post_meta( get_the_ID(), '_curso_carga_horaria', true )); ?>h)</span></p>
            </div>
            <?php $nota_mec = get_post_meta( get_the_ID(), '_curso_nota', true ); ?>
            <?php if (!empty($nota_mec)) : ?>
                <div class="curso-info curso-info--nota">
                    <h4 class="curso-info__title"><?php _e('Avalia&ccedil;&atilde;o do Curso', 'ifrs-portal-theme'); ?></h4>
                    <p class="curso-info__text"><?php echo esc_html($nota_mec); ?></p>
                </div>
            <?php endif; ?>
            <?php
                $nome = get_post_meta( get_the_ID(), '_curso_coordenador_nome', true );
                $lattes = get_post_meta( get_the_ID(), '_curso_coordenador_lattes', true );
                $email = get_post_meta( get_the_ID(), '_curso_coordenador_email', true );
            ?>
            <div class="curso-coordenador">
                <h3 class="curso-coordenador__title"><?php _e('Coordena&ccedil;&atilde;o', 'ifrs-portal-theme'); ?></h3>
                <p class="curso-coordenador__nome">
                    <?php if (!empty($lattes)) : ?>
                        <a href="<?php echo esc_url($lattes); ?>"><?php echo esc_html($nome); ?></a>
                    <?php else : ?>
                        <?php echo esc_html($nome); ?>
                    <?php endif; ?>
                </p>
                <span class="curso-coordenador__email"><a href="mailto:<?php echo esc_html($email); ?>" target="_blank" rel="noopener noreferrer"><?php echo str_replace(array('@', '.'), array('@<wbr>', '.<wbr>'), esc_html($email)); ?></a></span>
            </div>
        </aside>
        <hr class="curso__separator">
        <div class="curso__content">
            <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('full', array('class' => 'curso__thumb'));
                }
            ?>
            <?php
                add_action('the_content', function($content) {
                    $niveis = get_the_terms(get_the_ID(), 'nivel');
                    $prerequisitos = '';

                    foreach ($niveis as $nivel) {
                        $prerequisitos .= term_description($nivel->term_id, 'nivel');
                    }

                    if (!empty($prerequisitos)) {
                        return $content . '<h3>' . __('Pré-requisitos', 'ifrs-portal-theme') . '</h3>' . $prerequisitos;
                    }
                    return $content;
                }, 1);
            ?>
            <?php the_content(); ?>
            <?php if ($ead) : ?>
                <small class="text-secondary"><strong>*</strong>&nbsp;Esse curso possui parte de sua carga hor&aacute;ria a dist&acirc;ncia.</small>
            <?php endif; ?>
        </div>
    </section>
    <div class="destaque">
        <section class="container">
            <div class="row">
                <?php $arquivos_principais = rwmb_meta( '_curso_arquivos_principais' ); ?>
                <?php if (!empty($arquivos_principais)) : ?>
                    <div class="col-12 col-md-6">
                        <div class="curso-arquivos">
                            <h3 class="curso-arquivos__title"><?php _e('Grade e Corpo Docente', 'ifrs-portal-theme'); ?></h3>
                            <ul class="curso-arquivos__list">
                                <?php foreach ($arquivos_principais as $arquivo) : ?>
                                    <li>
                                        <a href="<?php echo esc_url($arquivo['url']); ?>"><?php echo $arquivo['title']; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                <?php $arquivos = rwmb_meta( '_curso_arquivos' ); ?>
                <?php if (!empty($arquivos)) : ?>
                    <div class="col-12 col-md-6">
                        <div class="curso-arquivos">
                            <h3 class="curso-arquivos__title"><?php _e('Arquivos', 'ifrs-portal-theme'); ?></h3>
                            <ul class="curso-arquivos__list">
                                <?php foreach ($arquivos as $arquivo) : ?>
                                    <li>
                                        <a href="<?php echo esc_url($arquivo['url']); ?>"><?php echo $arquivo['title']; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</article>

<?php get_footer(); ?>
