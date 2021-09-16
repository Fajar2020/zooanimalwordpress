<?php 
    get_header(); 
    pageBanner();

    $relatedAnimals = new WP_Query(array(
        'posts_per_page'=> -1,
		'post_type'=>'animal',
		'orderby'=>'title',
		'order'=>'ASC',
		'meta_query' => array(
		    array(
				'key'=>'animal_related_to',
				'compare' => 'LIKE',
				'value'=> '"'.get_the_ID().'"'
			)
		)
    ));
    
    ?>
    
    <section class="captivitySection">
        <div class="captivity-container">
            <?php 
                while($relatedAnimals->have_posts()){
                    $relatedAnimals->the_post();
                    ?>
                    <div class="captivity-card">
                        
                        <div class="captivity-img">
                            <img src="<?php echo get_field('image_thumbnail')['url'];?>" />
                        </div>
                        <div class="captivity-content">
                            <div>
                                <h2><?php the_title();?></h2>
                                <p>
                                    <?php
                                        if(has_excerpt()){
                                            the_excerpt();
                                        }else{
                                            echo wp_trim_words(get_the_content(), 15);
                                        }
                                    ?>
                                </p>
                                <a href="<?php the_permalink(); ?>">View Details</a>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            ?>
            
        </div>
    </section>
    
<?php get_footer(); ?>