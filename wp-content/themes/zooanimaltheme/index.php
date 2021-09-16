<?php 
    get_header(); 
    pageBanner(array(
        'title'=>'WELCOME TO OUR BLOG',
        'subtitle'=>'Do not miss our funstastic stories...',
        'photo'=>'https://cdn.hipwallpaper.com/m/61/40/R4VnDZ.jpg'
    ));
    
        ?>
        <section class="blogSection">
            <div class="container-blog">
                <div class="blog-main">
                    <?php 
                    while(have_posts()){
                        the_post();
                    ?>
                    <div class="singleBlog">
                        <img class="cover" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="image" />
                        <div class="blogContent">
                            <h3><?php the_title();?></h3>
                            <!-- <p><?php if(has_excerpt()){
                                echo get_the_excerpt();
                            }else{
                                echo wp_trim_words(get_the_content(), 15);
                            }?></p> -->
                            <a href="<?php the_permalink();?>" class="btn-blog">Read More</a>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>

                <?php
                echo paginate_links();
                ?>
            </div>
        </section>
<?php get_footer(); ?>