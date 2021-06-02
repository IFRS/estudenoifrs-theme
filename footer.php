</main>

<a href="#fim-conteudo" id="fim-conteudo" class="visually-hidden">Fim do conte&uacute;do</a>

<!-- Rodapé -->
<a href="#inicio-rodape" id="inicio-rodape" class="visually-hidden">In&iacute;cio do rodap&eacute;</a>

<section class="contato">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <h2 class="contato__title">Tem d&uacute;vidas sobre o ingresso discente no <span class="contato__title-destaque">IFRS</span>?</h2>
                <a href="<?php echo get_post_type_archive_link('pergunta'); ?>" class="contato__faq-link"><img data-src="<?php echo get_stylesheet_directory_uri(); ?>/img/faq.svg" alt="" aria-hidden="true" class="contato__faq-img lazyload">Consulte nossas <strong>Perguntas Frequentes</strong>!</a>
                <p>Se ainda restarem d&uacute;vidas, contate-nos preenchendo o formul&aacute;rio ao lado.</p>
            </div>
            <div class="col-12 col-md-6">
                <?php if ( ! dynamic_sidebar('area-contato') ); ?>
            </div>
        </div>
    </div>
</section>

<section class="social">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-9 col-xl-7">
                <p class="social__text">Acompanhe nossas novidades pelas <strong>Redes Sociais</strong></p>
            </div>
            <div class="col">
                <ul class="menu-social">
                    <li class="menu-social__item"><a href="https://www.facebook.com/IFRSOficial" class="menu-social__link menu-social__link--facebook"><span class="visually-hidden">P&aacute;gina do IFRS no Facebook</span></a></li>
                    <li class="menu-social__item"><a href="https://www.twitter.com/IFRSOficial" class="menu-social__link menu-social__link--twitter"><span class="visually-hidden">Perfil do IFRS no Twitter</span></a></li>
                    <li class="menu-social__item"><a href="https://www.instagram.com/IFRSOficial" class="menu-social__link menu-social__link--instagram"><span class="visually-hidden">Perfil do IFRS no Instagram</span></a></li>
                    <li class="menu-social__item"><a href="https://www.youtube.com/IFRSOficial" class="menu-social__link menu-social__link--youtube"><span class="visually-hidden">Canal do IFRS no Youtube</span></a></li>
                    <li class="menu-social__item"><a href="https://www.linkedin.com/school/ifrs" class="menu-social__link menu-social__link--linkedin"><span class="visually-hidden">P&aacute;gina do IFRS no Linkedin</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row footer">
            <div class="col-12 col-md-5 col-lg-3 order-1">
                <div class="footer-logo">
                    <a href="https://ifrs.edu.br/" data-bs-toggle="tooltip" data-bs-placement="top" title="Portal do IFRS" class="footer-logo__link">
                        <img class="m-auto img-fluid lazyload" data-src="<?php echo get_stylesheet_directory_uri(); ?>/img/footer-marca.png" alt="Marca do IFRS"/>
                    </a>
                </div>
            </div>
            <div class="col order-2 order-md-3 order-lg-2">
                <?php
                    if (has_nav_menu('main')) {
                        wp_nav_menu( array(
                            'theme_location'    => 'main',
                            'depth'             => 2,
                            'container'         => 'nav',
                            'container_class'   => 'site-map',
                            'container_id'      => 'mapa-site',
                            'menu_id'           => false,
                            'menu_class'        => 'site-map__menu',
                            'fallback_cb'       => false
                        ));
                    }
                ?>
            </div>
            <div class="col-12 col-md-7 col-lg-4 col-xl-3 order-3 order-md-2 order-lg-3">
                <address class="endereco">
                    <h2 class="endereco__title">Endere&ccedil;o</h2>
                    <p>Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul</p>
                    <p>
                        Rua General Os&oacute;rio, 348 | Bairro Centro
                        <br>
                        Bento Gon&ccedil;alves/RS | CEP: 95700-086
                    </p>
                    <p>Telefone: <a href="tel:+555434493300">(54) 3449-3300</a></p>
                </address>
            </div>
        </div>
        <div class="creditos">
            <!-- Wordpress -->
            <a href="http://br.wordpress.org/" target="_blank" rel="noopener noreferrer" data-bs-toggle="tooltip" data-bs-placement="top" title="Desenvolvido com Wordpress"><img data-src="<?php echo get_stylesheet_directory_uri(); ?>/img/creditos-wordpress.png" class="lazyload" alt="Desenvolvido com Wordpress (abre uma nova p&aacute;gina)"></a>
            <!-- Código-fonte -->
            <a href="https://github.com/IFRS/ingresso-theme/" target="_blank" rel="noopener noreferrer" data-bs-toggle="tooltip" data-bs-placement="top" title="C&oacute;digo-fonte deste tema sob a licen&ccedil;a GPLv3"><img data-src="<?php echo get_stylesheet_directory_uri(); ?>/img/creditos-git.png" class="lazyload" alt="C&oacute;digo-fonte deste tema sob a licen&ccedil;a GPLv3 (abre uma nova p&aacute;gina)"></a>
            <!-- Creative Commons -->
            <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank" rel="license noopener noreferrer" data-bs-toggle="tooltip" data-bs-placement="top" title="M&iacute;dia licenciada sob a Licen&ccedil;a Creative Commons Atribui&ccedil;&atilde;o-N&atilde;oComercial-CompartilhaIgual 4.0 Internacional"><img data-src="<?php echo get_stylesheet_directory_uri(); ?>/img/creditos-cc-by-nc-sa.png" class="lazyload" alt="M&iacute;dia licenciada sob a Licen&ccedil;a Creative Commons Atribui&ccedil;&atilde;o-N&atilde;oComercial-CompartilhaIgual 4.0 Internacional (abre uma nova p&aacute;gina)" /></a>
        </div>
    </div>
</footer>

<a href="#fim-rodape" id="fim-rodape" class="visually-hidden">Fim do rodap&eacute;</a>

<?php get_template_part('partials/vlibras'); ?>

<?php wp_footer(); ?>

</body>
</html>
