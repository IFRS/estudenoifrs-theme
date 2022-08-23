<!doctype html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">
    <meta name="author" content="Departamento de Comunicação do IFRS">
    <meta name="keywords" content="ifrs, ingresso, estudar, vestibular">
    <meta name="description" content="Site com informações para ingressar como estudante no IFRS">
    <!-- Favicons -->
    <?php echo get_template_part('partials/favicons'); ?>
    <!-- OpenGraph -->
    <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
    <meta property="og:url" content="<?php echo esc_attr( wp_get_canonical_url() ); ?>">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:type" content="<?php echo (!is_front_page() && !is_home()) ? 'article' : 'website' ?>">
    <meta property="og:title" content="<?php echo esc_attr( get_template_part('partials/title') ); ?>">
    <meta property="og:image" content="<?php has_post_thumbnail() ? esc_attr( the_post_thumbnail_url('full') ) : esc_attr( header_image() ); ?>">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@IF_RS">
    <meta name="twitter:creator" content="@IF_RS">
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo esc_url( wp_get_canonical_url() ); ?>">
    <!-- WP -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <a href="#inicio-conteudo" class="visually-hidden">Pular para o conte&uacute;do</a>

    <?php wp_body_open(); ?>

    <!-- Cabeçalho -->
    <div class="container">
        <?php echo get_template_part('partials/barra-acessibilidade'); ?>
    </div>
    <?php
        $header = '';
        if ( get_header_image() ) {
            $header = 'style="background-image: url(\'' . get_header_image(). '\')"';
        }
    ?>
    <header <?php echo $header; ?>>
        <?php if (!is_front_page()) : ?>
            <h1 class="visually-hidden"><?php bloginfo('name'); ?></h1>
        <?php endif; ?>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo !empty(get_custom_logo()) ? get_custom_logo() : get_stylesheet_directory_uri() . '/img/marca.png'; ?>" alt="<?php bloginfo('name'); ?> - P&aacute;gina Inicial" class="img-fluid"/>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-8">
                    <?php echo get_template_part('partials/menu'); ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Corpo -->
    <a href="#inicio-conteudo" id="inicio-conteudo" class="visually-hidden">In&iacute;cio do conte&uacute;do</a>

    <main role="main">
    <?php ingresso_breadcrumb(); ?>
