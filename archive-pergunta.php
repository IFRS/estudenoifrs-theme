<?php get_header(); ?>

<section class="faq">
    <article class="container">
        <h2 class="faq__title">Perguntas Frequentes</h2>
        <?php if (have_posts()) : ?>
            <?php $faq_id = uniqid('faq__perguntas'); ?>
            <div class="faq__perguntas accordion accordion-flush" id="<?php echo $faq_id; ?>">
            <?php while (have_posts()) : the_post(); ?>
                <div class="accordion-item faq__item">
                    <h3 class="faq__item-title accordion-header" id="heading-<?php the_ID(); ?>">
                        <a href="<?php the_permalink(); ?>" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-<?php the_ID(); ?>" aria-expanded="false" aria-controls="collapse-<?php the_ID(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>

                    <div id="collapse-<?php the_ID(); ?>" class="faq__item-content accordion-collapse collapse" aria-labelledby="heading-<?php the_ID(); ?>" data-bs-parent="#<?php echo $faq_id; ?>">
                        <div class="accordion-body">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div class="alert alert-warning" role="alert">
                <strong>Ops!</strong> Ainda n&atilde;o existem perguntas cadastradas.
            </div>
        <?php endif; ?>
    </article>
</section>

<?php get_footer(); ?>
