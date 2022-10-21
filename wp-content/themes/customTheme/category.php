<?php
	get_header();
?>
<main class="container align-middle  my-4">
    <div class="row">
        <div class="col-sm-9">
            <div class="sidebar">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class=" pb-4">
                    <h1 class="fw-semibold text-capitalize">
                        <?php the_title(); ?>
                    </h1>
                    <?php echo get_the_date(); ?>
                </div>


                <?php the_content(); ?>

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
                    <a href="#">
                        <img src="https://cdn.pixabay.com/photo/2016/06/20/13/44/paper-1468883_960_720.jpg"
                            class="card-img-top" alt="...">
                        <span>10/10/2022</span>
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
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