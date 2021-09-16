<?php 
    get_header(); 
    pageBanner(array(
        'title'=>'OUR EVENTS',
        'subtitle'=>'Check out our upcoming events...',
        'photo'=>'https://bandung.pojoksatu.id/wp-content/uploads/2019/12/IMG-20191223-WA0054-730x355.jpg'
    ));
    
    
        ?>
        <section class="eventSection">
            <a class="page-container-a" style="margin: 0 10%;"href="<?php echo site_url('/last-events');?>">Visit Last Events</a>
            <div class="events">
                <ul>
                    <?php 
                    while(have_posts()){
                        the_post();
                        $eventDate=new DateTime(get_field('event_date'));
                    ?>
                        <li>
                            <div class="timeEvent">
                                <h2>
                                <?php echo $eventDate->format('d');?>
                                <br />
                                <span><?php echo $eventDate->format('M');?></span>
                                </h2>
                            </div>
                            <div class="detailEvent detailEventArchive">
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
                    ?>
                </ul>

                <?php 
                echo paginate_links();
                ?>
            </div>
        </section>
<?php get_footer(); ?>