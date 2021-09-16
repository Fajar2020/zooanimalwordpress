<?php 
    get_header(); 
    while(have_posts()){
        the_post();
        pageBanner(array(
            'subtitle'=>'Created by '.get_the_author()
        ));
        ?>
        <section>
            <div class="container">
                <div class="page-content">
                    <div style="text-align:center">
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-responsive" />
                    </div>
                    <p><?php the_content(); ?></p>
                </div>
                
            </div>
        </section>
        <?php
    }
?>
        
<?php get_footer(); ?>