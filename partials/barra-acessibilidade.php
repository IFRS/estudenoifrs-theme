<nav class="barra-acessibilidade">
    <ul class="barra-acessibilidade__menu d-none d-md-block">
        <li><a href="#inicio-conteudo" accesskey="1">Ir para o conte&uacute;do [1]</a></li>
        <li><a href="#inicio-menu" accesskey="2">Ir para o menu [2]</a></li>
        <li><a href="#inicio-busca" accesskey="3">Ir para a busca [3]</a></li>
        <li><a href="#inicio-rodape" accesskey="4">Ir para o rodap&eacute; [4]</a></li>
    </ul>

    <ul class="barra-acessibilidade__menu">
        <li><a href="<?php echo get_permalink(get_page_by_path('acessibilidade')); ?>">Acessibilidade</a></li>
        <?php if (!empty(get_the_privacy_policy_link())) : ?>
            <li><?php echo get_the_privacy_policy_link(); ?></li>
        <?php endif; ?>
        <li><a href="#mapa-site">Mapa do Site</a></li>
    </ul>
</nav>
