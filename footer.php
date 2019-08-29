</main>

<a href="#fim-conteudo" id="fim-conteudo" class="sr-only">Fim do conte&uacute;do</a>

<!-- Rodapé -->
<a href="#inicio-rodape" id="inicio-rodape" class="sr-only">In&iacute;cio do rodap&eacute;</a>

<footer>
    <div class="container">
        <div class="footer">
            <div class="footer-logo">
                <a href="https://ifrs.edu.br/" data-toggle="tooltip" data-placement="top" title="Portal do IFRS" class="footer-logo__link">
                    <img class="m-auto img-fluid" data-src="<?php echo get_stylesheet_directory_uri(); ?>/img/footer-marca.png" alt="Marca do IFRS"/>
                </a>
            </div>
            <?php
                if (has_nav_menu('main')) {
                    wp_nav_menu( array(
                        'theme_location'    => 'main',
                        'depth'             => 2,
                        'container'         => 'nav',
                        'container_class'   => 'site-map',
                        'container_id'      => false,
                        'menu_id'           => false,
                        'menu_class'        => 'site-map__menu',
                        'fallback_cb'       => false
                    ));
                }
            ?>
            <address class="endereco">
                <h2 class="endereco__title">Endere&ccedil;o</h2>
                <p>Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul</p>
                <p>
                    Rua General Os&oacute;rio, 348 | Bairro Centro
                    <br>
                    Bento Gon&ccedil;alves/RS | CEP: 95700-086
                </p>
                <p>Telefone: (54) 3449-3300</p>
            </address>
        </div>
        <div class="creditos">
            <!-- Wordpress -->
            <a href="http://br.wordpress.org/" target="_blank" rel="noopener noreferrer">Desenvolvido com Wordpress<span class="sr-only"> (abre uma nova p&aacute;gina)</span></a>
            &mdash;
            <!-- Código-fonte -->
            <a href="https://github.com/IFRS/ps-theme/" target="_blank" rel="noopener noreferrer">C&oacute;digo-fonte deste tema sob a licen&ccedil;a GPLv3<span class="sr-only"> (abre uma nova p&aacute;gina)</span></a>
            &mdash;
            <!-- Creative Commons -->
            <a href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank" rel="license noopener noreferrer"><img data-src="<?php echo get_stylesheet_directory_uri(); ?>/img/cc-by-nc-nd.png" alt="M&iacute;dia licenciada sob a Licen&ccedil;a Creative Commons Atribui&ccedil;&atilde;o-N&atilde;oComercial-SemDeriva&ccedil;&otilde;es 4.0 Internacional (abre uma nova p&aacute;gina)" /></a>
        </div>
    </div>
</footer>

<a href="#fim-rodape" id="fim-rodape" class="sr-only">Fim do rodap&eacute;</a>

<?php wp_footer(); ?>

</body>
</html>
