<?php 
    get_header();
?>
        <section class="hero" style="background: linear-gradient(to bottom, rgba(0,0,0,0.8),rgba(0,0,0,0.8)), url(<?php echo get_theme_file_uri('/images/boy.jpg');?>) center no-repeat; background-size: cover">
            <div class="text">
                <h1>FUNTASTIC ZOO</h1>
                <p>Come and join us to the world of animals</p>
                <a href="#" class="btn">Learn more</a>
            </div>
        </section>

        <?php 
            $homePagePost = new WP_Query(array(
                'posts_per_page'=>4
            ));
        ?>

        <section class="blogSection">
            <div class="container-blog">
                <div class="blog-header">
                    <h1>Latest Blog</h1>
                    <!-- <p>Some </p> -->
                </div>
                <div class="blog-main">
                    <?php
                    while($homePagePost->have_posts()){
                        $homePagePost->the_post();
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
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>

        <?php
        $today=date('Ymd');
        $homePageEvents = new WP_Query(array(
            'post_type'=>'event',
            'posts_per_page'=> 3,
            'meta_key'=>'event_date',
            'orderby'=>'meta_value',
            'order'=>'ASC',
            'meta_query'=> array(
                array(
                    'key'=>'event_date',
                    'compare'=>'>=',
                    'value'=>$today,
                    'type'=>'DATE'
                )
            )
        ));
        ?>

        <section class="eventSection" style="background: url(<?php echo get_theme_file_uri('/images/orange_flamingos.jpg');?>); background-size: cover">
            <div class="eventLeftBox">
                <div class="eventLeftContent">
                    <h1>Our Upcoming Events</h1>
                    <p>Come and join our upcoming events. Visit our place and feel the worldwild in perfectly save environment</p>
                </div>
            </div>
            <div class="eventsInHome">
                <ul>
                    <?php 
                    while($homePageEvents->have_posts()){
                        $homePageEvents->the_post();
                        $eventDate=new DateTime(get_field('event_date'));
                        ?>
                        <li>
                            <div class="timeEvent">
                                <h2>
                                <?php echo $eventDate->format('d');?>
                                <br />
                                <span><?php echo $eventDate->format('M');?></span>
                                <!-- <br />
                                <?php echo $eventDate->format('Y');?> -->
                                </h2>
                            </div>
                            <div class="detailEvent">
                                <h3><?php the_title();?></h3>
                                <p><?php 
                                    if(has_excerpt()){
                                        the_excerpt();
                                    }else{
                                        echo wp_trim_words(get_the_content(), 15);
                                    }
                                ?></p>
                                <a href="<?php the_permalink();?>">View Details</a>
                            </div>
                            <div style="clear: both;"></div>
                        </li>

                        <?php
                    }

                    wp_reset_postdata();
                    ?>
                    
                </ul>
            </div>
        </section>
<?php get_footer(); ?>
        