<?php get_header(); ?>

<div class="content">
    <section class="container">
        <div class="row">
            <div class="col-12">
                <article class="faq">
                    <h2 class="faq__title">Perguntas Frequentes</h2>
                    <?php if (have_posts()) : ?>
                        <div class="faq__perguntas" id="faq__perguntas">
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="faq__item">
                                <div id="heading-<?php the_ID(); ?>">
                                    <h3 class="faq__item-title">
                                        <a href="<?php the_permalink(); ?>" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-<?php the_ID(); ?>" aria-expanded="true" aria-controls="collapse-<?php the_ID(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                </div>

                                <div id="collapse-<?php the_ID(); ?>" class="collapse faq__item-content" aria-labelledby="heading-<?php the_ID(); ?>" data-bs-parent="#faq__perguntas">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-warning" role="alert">
                            <p><strong>Ops!</strong> Ainda n&atilde;o existem perguntas cadastradas.</p>
                        </div>
                    <?php endif; ?>
                </article>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
