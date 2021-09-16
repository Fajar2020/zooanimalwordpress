<?php 
    get_header(); 
    while(have_posts()){
        the_post();
        pageBanner(array(
            'photo'=>'https://cloud.addictivetips.com/wp-content/uploads/2019/02/advanced-background-check-1-search.jpg'
        ));
        ?>
        <section>
            <div class="container">
                <div class="page-content">
                    <label class="label-search">Perform a New Search:</label>
                    <div class="search-row">
                        <input class="search-input" placeholder="what you are looking for?" >
                        <div class="btn search-btn">Search <i class="fa fa-search" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
?>

<section>
    
    <div class="container">
        <div class="page-content answer-section">
            
        </div>
    </div>
</section>

        
<?php get_footer(); ?>