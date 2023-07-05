<nav class="container barra-acessibilidade">
    <ul class="barra-acessibilidade__menu">
        <li class="barra-acessibilidade__item"><a href="#inicio-conteudo" accesskey="1">Ir para o conte&uacute;do [1]</a></li>
        <li class="barra-acessibilidade__item"><a href="#inicio-menu" accesskey="2">Ir para o menu [2]</a></li>
        <li class="barra-acessibilidade__item"><a href="#inicio-busca" accesskey="3">Ir para a busca [3]</a></li>
        <li class="barra-acessibilidade__item"><a href="#inicio-rodape" accesskey="4">Ir para o rodap&eacute; [4]</a></li>
    </ul>

    <ul class="barra-acessibilidade__menu">
        <?php if (get_page_by_path('acessibilidade')) : ?>
            <li class="barra-acessibilidade__item"><a href="<?php echo get_permalink(get_page_by_path('acessibilidade')); ?>">Acessibilidade</a></li>
        <?php endif; ?>

        <?php if (!empty(get_the_privacy_policy_link())) : ?>
            <li class="barra-acessibilidade__item"><?php echo get_the_privacy_policy_link(); ?></li>
        <?php endif; ?>

        <li class="barra-acessibilidade__item"><a href="#mapa-site">Mapa do Site</a></li>
    </ul>
</nav>
