<?php 
    get_header(); 
    while(have_posts()){
        the_post();
        pageBanner(array(
            'subtitle'=>'Thing you should know about '.get_the_title()
        ));

        $relatedCaptivity = get_field('animal_related_to');
        ?>
        <section class="singleAnimalSection">
            <div class="single-animal-container">
                <?php 
                foreach($relatedCaptivity as $captivity){
                    ?>
                    <a class="page-container-a single-container-a" href="<?php echo get_the_permalink($captivity)?>">Visit other animals from <?php echo get_the_title($captivity);?></a>
                    <?php
                }
                ?>
                
                <div class="single-animal-card">
                    <div class="single-animal-img">
                        <img src="<?php echo get_field('image_thumbnail')['url'];?>" >
                    </div>
                    <div class="single-animal-content">
                        <h2><?php the_title();?></h2>
                        <p><?php the_content();?></p>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
?>
        
<?php get_footer(); ?>