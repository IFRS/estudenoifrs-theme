<?php the_post(); ?>

<div class="row">
    <div class="col-12 col-lg-9">
        <h2 class="curso__title"><?php the_title(); ?></h2>
        <div class="curso__content">
            <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('full', array('class' => 'curso__thumb'));
                }
            ?>
            <?php
                add_action('the_content', function($content) {
                    $niveis = get_the_terms(get_the_ID(), 'curso_nivel');
                    $prerequisitos = '';

                    foreach ($niveis as $nivel) {
                        $prerequisitos .= term_description($nivel->term_id, 'curso_nivel');
                    }

                    if (!empty($prerequisitos)) {
                        return $content . '<h3>' . __('Pré-requisitos', 'ifrs-portal-theme') . '</h3>' . $prerequisitos;
                    }
                    return $content;
                }, 1);
            ?>
            <?php the_content(); ?>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col">
                <div class="curso-arquivos">
                    <div class="card bg-light">
                        <div class="card-header">
                            <h3 class="curso-arquivos__title"><?php _e('Grade e Corpo Docente', 'ifrs-portal-theme'); ?></h3>
                        </div>
                        <div class="list-group list-group-flush" role="list">
                            <?php
                                $ppc = rwmb_meta( '_curso_ppc', array('limit' => 1) );
                                $ppc = reset($ppc);
                            ?>
                            <?php if ($ppc) : ?>
                                <a href="<?php echo esc_url($ppc['url']); ?>" class="list-group-item list-group-item-action" role="listitem"><?php _e('Projeto Pedagógico do Curso (PPC)', 'ifrs-portal-theme'); ?></a>
                            <?php endif; ?>

                            <?php
                                $matriz_curricular = rwmb_meta( '_curso_matriz_curricular', array('limit' => 1) );
                                $matriz_curricular = reset($matriz_curricular);
                            ?>
                            <?php if ($matriz_curricular) : ?>
                                <a href="<?php echo esc_url($matriz_curricular['url']); ?>" class="list-group-item list-group-item-action" role="listitem"><?php _e('Matriz Curricular', 'ifrs-portal-theme'); ?></a>
                            <?php endif; ?>

                            <?php
                                $representacao_grafica = rwmb_meta( '_curso_representacao_grafica', array('limit' => 1) );
                                $representacao_grafica = reset($representacao_grafica);
                            ?>
                            <?php if ($representacao_grafica) : ?>
                                <a href="<?php echo esc_url($representacao_grafica['url']); ?>" class="list-group-item list-group-item-action" role="listitem"><?php _e('Representação Gráfica', 'ifrs-portal-theme'); ?></a>
                            <?php endif; ?>

                            <?php
                                $corpo_docente = rwmb_meta( '_curso_corpo_docente', array('limit' => 1) );
                                $corpo_docente = reset($corpo_docente);
                            ?>
                            <?php if ($corpo_docente) : ?>
                                <a href="<?php echo esc_url($corpo_docente['url']); ?>" class="list-group-item list-group-item-action" role="listitem"><?php _e('Corpo Docente', 'ifrs-portal-theme'); ?></a>
                            <?php endif; ?>

                            <?php
                                $corpo_docente_componentes_curriculares = rwmb_meta( '_curso_corpo_docente_componentes_curriculares', array('limit' => 1) );
                                $corpo_docente_componentes_curriculares = reset($corpo_docente_componentes_curriculares);
                            ?>
                            <?php if ($corpo_docente_componentes_curriculares) : ?>
                                <a href="<?php echo esc_url($corpo_docente_componentes_curriculares['url']); ?>" class="list-group-item list-group-item-action" role="listitem"><?php _e('Corpo Docente X Componentes Curriculares', 'ifrs-portal-theme'); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $arquivos = rwmb_meta( '_curso_arquivos' ); ?>
            <?php if (!empty($arquivos)) : ?>
            <div class="col-12 col-md-6">
                <div class="curso-arquivos">
                    <div class="card bg-light">
                        <div class="card-header">
                            <h3 class="curso-arquivos__title"><?php _e('Demais Arquivos', 'ifrs-portal-theme'); ?></h3>
                        </div>
                        <div class="list-group list-group-flush" role="list">
                            <?php foreach ($arquivos as $arquivo) : ?>
                                <a href="<?php echo esc_url($arquivo['url']); ?>" class="list-group-item list-group-item-action" role="listitem"><?php echo $arquivo['title']; ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

    </div>
    <div class="col-12 col-lg-3">
        <div class="row">
            <div class="col">
                <div class="curso-aside">
                    <h3 class="curso-aside__title"><?php _e('Informa&ccedil;&otilde;es', 'ifrs-portal-theme'); ?></h3>
                    <div class="curso-aside__content">
                        <div class="curso-info">
                            <svg xmlns="http://www.w3.org/2000/svg" class="curso-info__icon" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"/>
                                <path d="M16 16v2a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h2v-2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-2" />
                            </svg>
                            <h4 class="curso-info__title"><?php _e('Modalidade', 'ifrs-portal-theme'); ?></h4>
                            <p class="curso-info__text"><?php the_terms( get_the_ID(), 'curso_modalidade', '', ', ' ); ?></p>
                        </div>
                        <div class="curso-info">
                            <svg xmlns="http://www.w3.org/2000/svg" class="curso-info__icon" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"/>
                                <line x1="3" y1="21" x2="21" y2="21" />
                                <line x1="9" y1="8" x2="10" y2="8" />
                                <line x1="9" y1="12" x2="10" y2="12" />
                                <line x1="9" y1="16" x2="10" y2="16" />
                                <line x1="14" y1="8" x2="15" y2="8" />
                                <line x1="14" y1="12" x2="15" y2="12" />
                                <line x1="14" y1="16" x2="15" y2="16" />
                                <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" />
                            </svg>
                            <h4 class="curso-info__title"><?php _e('Unidade', 'ifrs-portal-theme'); ?></h4>
                            <p class="curso-info__text"><?php the_terms( get_the_ID(), 'curso_unidade', '', ', ' ); ?></p>
                        </div>
                        <div class="curso-info">
                            <svg xmlns="http://www.w3.org/2000/svg" class="curso-info__icon" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"/>
                                <rect x="3" y="15" width="6" height="6" rx="2" />
                                <rect x="15" y="15" width="6" height="6" rx="2" />
                                <rect x="9" y="3" width="6" height="6" rx="2" />
                                <path d="M6 15v-1a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v1" />
                                <line x1="12" y1="9" x2="12" y2="12" />
                            </svg>
                            <h4 class="curso-info__title"><?php _e('Nível', 'ifrs-portal-theme'); ?></h4>
                            <p class="curso-info__text">
                                <?php $niveis = wp_get_post_terms(get_the_ID(), 'curso_nivel', array('orderby' => 'term_id')); ?>
                                <?php foreach ($niveis as $nivel) : ?>
                                    <a href="<?php echo get_term_link($nivel->term_id); ?>"><?php echo $nivel->name; ?></a>
                                    <?php echo ($nivel !== end($niveis)) ? '<strong> / </strong>' : ''; ?>
                                <?php endforeach; ?>
                            </p>
                        </div>
                        <div class="curso-info">
                            <svg xmlns="http://www.w3.org/2000/svg" class="curso-info__icon" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"/>
                                <circle cx="12" cy="12" r="4" />
                                <path d="M3 12h1M12 3v1M20 12h1M12 20v1M5.6 5.6l.7 .7M18.4 5.6l-.7 .7M17.7 17.7l.7 .7M6.3 17.7l-.7 .7" />
                            </svg>
                            <h4 class="curso-info__title"><?php _e('Turnos', 'ifrs-portal-theme'); ?></h4>
                            <p class="curso-info__text"><?php the_terms( get_the_ID(), 'curso_turno', '', ', ' ); ?></p>
                        </div>
                        <div class="curso-info">
                            <svg xmlns="http://www.w3.org/2000/svg" class="curso-info__icon" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"/>
                                <rect x="4" y="5" width="16" height="16" rx="2" />
                                <line x1="16" y1="3" x2="16" y2="7" />
                                <line x1="8" y1="3" x2="8" y2="7" />
                                <line x1="4" y1="11" x2="20" y2="11" />
                                <rect x="8" y="15" width="2" height="2" />
                            </svg>
                            <h4 class="curso-info__title"><?php _e('Dura&ccedil;&atilde;o', 'ifrs-portal-theme'); ?></h4>
                            <p class="curso-info__text"><?php echo esc_html(get_post_meta( get_the_ID(), '_curso_duracao', true )); ?> <span class="curso-info__text--lower">(<?php echo esc_html(get_post_meta( get_the_ID(), '_curso_carga_horaria', true )); ?>h)</span></p>
                        </div>
                        <?php $nota_mec = get_post_meta( get_the_ID(), '_curso_nota', true ); ?>
                        <?php if (!empty($nota_mec)) : ?>
                            <div class="curso-info">
                                <svg xmlns="http://www.w3.org/2000/svg" class="curso-info__icon" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <path d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
                                </svg>
                                <h4 class="curso-info__title"><?php _e('Avalia&ccedil;&atilde;o do Curso', 'ifrs-portal-theme'); ?></h4>
                                <p class="curso-info__text"><?php echo esc_html($nota_mec); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="curso-aside">
                    <h3 class="curso-aside__title"><?php _e('Coordena&ccedil;&atilde;o', 'ifrs-portal-theme'); ?></h3>
                    <div class="curso-aside__content">
                        <div class="curso-coordenador">
                            <p class="curso-coordenador__nome">
                                <?php $lattes = get_post_meta( get_the_ID(), '_curso_coordenador_lattes', true ); ?>
                                <?php if (!empty($lattes)) : ?>
                                    <a href="<?php echo esc_url($lattes); ?>"><?php echo esc_html(get_post_meta( get_the_ID(), '_curso_coordenador_nome', true )); ?></a>
                                <?php else : ?>
                                    <?php echo esc_html(get_post_meta( get_the_ID(), '_curso_coordenador_nome', true )); ?>
                                <?php endif; ?>
                            </p>
                            <span class="curso-coordenador__email"><a href="mailto:<?php echo esc_html(get_post_meta( get_the_ID(), '_curso_coordenador_email', true )); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html(get_post_meta( get_the_ID(), '_curso_coordenador_email', true )); ?></a></span>
                            <p class="curso-coordenador__titulacao"><?php echo esc_html(get_post_meta( get_the_ID(), '_curso_coordenador_titulacao', true )); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
