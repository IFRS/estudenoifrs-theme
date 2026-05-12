<div class="container position-relative">
    <nav class="barra-acessibilidade">
        <ul class="barra-acessibilidade__menu">
            <li class="barra-acessibilidade__item"><a class="visually-hidden-focusable" href="#inicio-conteudo" accesskey="1">Ir para o conte&uacute;do [<span class="visually-hidden">Atalho&nbsp;</span>1]</a></li>
            <li class="barra-acessibilidade__item"><a class="visually-hidden-focusable" href="#inicio-menu" accesskey="2">Ir para o menu [<span class="visually-hidden">Atalho&nbsp;</span>2]</a></li>
            <li class="barra-acessibilidade__item"><a class="visually-hidden-focusable" href="#inicio-busca" accesskey="3">Ir para a busca [<span class="visually-hidden">Atalho&nbsp;</span>3]</a></li>
            <li class="barra-acessibilidade__item"><a class="visually-hidden-focusable" href="#inicio-rodape" accesskey="4">Ir para o rodap&eacute; [<span class="visually-hidden">Atalho&nbsp;</span>4]</a></li>
        </ul>

        <ul class="barra-acessibilidade__menu">
            <?php if (get_page_by_path('acessibilidade')) : ?>
                <li class="barra-acessibilidade__item"><a class="visually-hidden-focusable" href="<?php echo get_permalink(get_page_by_path('acessibilidade')); ?>">Acessibilidade</a></li>
            <?php endif; ?>

            <?php if (!empty(get_the_privacy_policy_link())) : ?>
                <li class="barra-acessibilidade__item"><?php echo get_the_privacy_policy_link(); ?></li>
            <?php endif; ?>

            <li class="barra-acessibilidade__item"><a class="visually-hidden-focusable" href="#mapa-site">Mapa do Site</a></li>
        </ul>
    </nav>
</div>
