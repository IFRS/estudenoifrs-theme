<?php get_header(); ?>

<section class="container">
    <?php if (is_search()) : ?>
        <div class="row">
            <div class="col-12">
                <h2 class="search__title">Resultados da busca por &quot;<?php the_search_query(); ?>&quot;</h2>
            </div>
        </div>

        <?php if (!have_posts()) : ?>
            <div class="alert alert-warning" role="alert">
                <strong>Ah, que pena!</strong> N&atilde;o temos nenhum resultado para a palavra &quot;<?php the_search_query(); ?>&quot;, tente alguma palavra semelhante ou acesse as <a href="<?php echo get_post_type_archive_link( 'pergunta' ); ?>" class="alert-link">Perguntas Frequentes</a>.
            </div>
        <?php else: ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="row">
                    <div class="col-12">
                        <article class="search__entry">
                            <h3 class="search__entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="search__entry-summary">
                                <?php the_excerpt(); ?>
                            </div>
                        </article>
                    </div>
                </div>
                <hr>
            <?php endwhile; ?>
            <?php echo ifrs_ingresso_pagination(); ?>
        <?php endif; ?>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">
            <strong>Erro!</strong> Template n&atilde;o encontrado. Tente voltar para a <a href="<?php echo esc_url(home_url()); ?>">p&aacute;gina inicial</a>.
        </div>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
