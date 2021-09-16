<?php 
    get_header(); 
    pageBanner(array(
        'title'=>'OUR PAST EVENTS',
        'subtitle'=>'Check out our past events...',
        'photo'=>'https://bandung.pojoksatu.id/wp-content/uploads/2019/12/IMG-20191223-WA0054-730x355.jpg'
    ));

        $today= date('Ymd');
        $pastEvents = new WP_Query(array(
            'paged' => get_query_var('paged', 1),
            'post_type'=>'event',
            'meta_key'=>'event_date',
            'orderby'=>'meta_value',
            'order'=>'ASC',
            'meta_query' => array(
                array(
                    'key'=>'event_date',
                    'compare' => '<',
                    'value'=> $today,
                    'type'=>'DATE'
                )
            )
        ));
    
        ?>
        <section class="eventSection">
            <a class="page-container-a" style="margin: 0 10%;"href="<?php echo site_url('/events');?>">Visit Our Upcoming Events</a>
            <div class="events">
                <ul>
                    <?php 
                    while($pastEvents->have_posts()){
                        $pastEvents->the_post();
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
                echo paginate_links(array(
                    'total'=>$pastEvents->max_num_pages
                ));

                wp_reset_postdata();
                ?>
            </div>
        </section>
<?php get_footer(); ?>