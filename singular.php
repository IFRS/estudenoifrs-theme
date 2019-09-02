<?php get_header(); ?>

<?php the_post(); ?>

<div class="content">
    <section class="container">
        <div class="row">
            <div class="col-12">
                <article class="post">
                    <h2 class="post__title"><?php the_title(); ?></h2>
                    <div class="post__content">
                        <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('full', array('class' => 'post__thumb'));
                            }
                        ?>
                        <?php the_content(); ?>
                    </div>
                </article>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
