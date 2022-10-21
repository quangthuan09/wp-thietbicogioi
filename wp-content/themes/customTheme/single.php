<?php
	get_header();
?>
<main class="container align-middle  my-4">
    <div class="row">
        <div class="col-sm-9">
            <div class="sidebar">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="border-bottom pb-3 ">
                    <h1 class="fw-semibold text-capitalize">
                        <?php the_title(); ?>
                    </h1>
                    <?php echo get_the_date('d/m/Y H:i'); ?>
                </div>
                <div class="py-3 post-content">
                    <?php the_content(); ?>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="sidebar">
                <?php comments_template(); ?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="sidebar">
                <p class="border-bottom pb-2 fw-bold text-capitalize">Bài Viết Nổi Bật</p>
                <ol class="list-group">
                    <a class="py-2" href="#">
                        <img src="https://cdn.pixabay.com/photo/2016/06/20/13/44/paper-1468883_960_720.jpg"
                            class="card-img-top" alt="...">
                        <span><?php echo get_the_date('d/m/Y H:i'); ?></span>
                        <div class="card-body max-lines">
                            <p class="card-text">
                                <?php the_title(); ?><?php the_title(); ?><?php the_title(); ?><?php the_title(); ?></p>
                        </div>
                    </a><a class="py-2" href="#">
                        <img src="https://cdn.pixabay.com/photo/2016/06/20/13/44/paper-1468883_960_720.jpg"
                            class="card-img-top" alt="...">
                        <span><?php echo get_the_date('d/m/Y H:i'); ?></span>
                        <div class="card-body max-lines">
                            <p class="card-text">
                                <?php the_title(); ?><?php the_title(); ?><?php the_title(); ?><?php the_title(); ?></p>
                        </div>
                    </a><a class="py-2" href="#">
                        <img src="https://cdn.pixabay.com/photo/2016/06/20/13/44/paper-1468883_960_720.jpg"
                            class="card-img-top" alt="...">
                        <span><?php echo get_the_date('d/m/Y H:i'); ?></span>
                        <div class="card-body max-lines">
                            <p class="card-text">
                                <?php the_title(); ?><?php the_title(); ?><?php the_title(); ?><?php the_title(); ?></p>
                        </div>
                    </a><a class="py-2" href="#">
                        <img src="https://cdn.pixabay.com/photo/2016/06/20/13/44/paper-1468883_960_720.jpg"
                            class="card-img-top" alt="...">
                        <span><?php echo get_the_date('d/m/Y H:i'); ?></span>
                        <div class="card-body max-lines">
                            <p class="card-text">
                                <?php the_title(); ?><?php the_title(); ?><?php the_title(); ?><?php the_title(); ?></p>
                        </div>
                    </a>
            </div>
            </ol>
        </div>
    </div>
    </div>
</main>
<?php
	get_footer();
?>