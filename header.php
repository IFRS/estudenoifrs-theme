<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Departamento de Comunicação do IFRS">
    <meta name="keywords" content="ifrs, ingresso, estudar, estude, vestibular, técnico, graduação, especialização, mestrado">
    <meta name="description" content="Site com informações para ingressar como estudante no IFRS">
    <!-- WP -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <a href="#inicio-conteudo" class="visually-hidden">Pular para o conte&uacute;do</a>

    <?php wp_body_open(); ?>

    <!-- Cabeçalho -->
    <?php
        $header = '';
        if ( get_header_image() ) {
            $header = 'style="background-image: url(\'' . get_header_image(). '\')"';
        }
    ?>
    <header <?php echo $header; ?>>
        <h1 class="visually-hidden"><?php bloginfo('name'); ?></h1>

        <?php echo get_template_part('partials/barra-acessibilidade'); ?>

        <div class="container">
            <div class="row">
                <div class="col col-lg-4">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo !empty(get_custom_logo()) ? get_custom_logo() : get_parent_theme_file_uri( '/img/marca.png' ); ?>" alt="<?php bloginfo('name'); ?> - P&aacute;gina Inicial" class="img-fluid">
                    </a>
                </div>
                <div class="col-auto col-lg-8 order-first order-lg-last">
                    <?php echo get_template_part('partials/menu'); ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Corpo -->
    <a href="#inicio-conteudo" id="inicio-conteudo" class="visually-hidden">In&iacute;cio do conte&uacute;do</a>

    <main role="main">
    <?php
        if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
            // yoast_breadcrumb( '<section class="migalhas"><nav class="container breadcrumb" aria-label="Você está em:"><i class="fa-solid fa-house me-1"></i>', '</nav></section>' );
            yoast_breadcrumb( '<section class="migalhas"><nav class="container breadcrumb-yoast" aria-label="Caminhos de Navegação">','</nav></section>' );
        } else {
            ingresso_breadcrumb();
        }
    ?>
