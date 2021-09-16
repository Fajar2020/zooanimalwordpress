<?php 
    get_header(); 
    while(have_posts()){
        the_post();
        pageBanner();
        ?>
        <section>
            <div class="container">
                <div class="page-content">
                    <?php
                        $parentID= wp_get_post_parent_id(get_the_ID());
                        
                        $hasChild= get_pages(array(
                            'child_of'=>get_the_ID()
                        ));

                        if($parentID){
                            ?>
                                <a class="page-container-a" href="<?php echo get_the_permalink($parentID);?>">Visit <?php echo get_the_title($parentID); ?></a>
                            <?php
                        }
                        if(get_the_post_thumbnail_url()){
                            ?>
                            <div style="text-align:center">
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-responsive" />
                            </div>
                            <?php
                        }

                        echo '<p>'.the_content().'</p>';
                        if($hasChild){
                            ?>
                            <h1>Visit Related Informations:</h1>
                            <ul>
                                <?php
                                wp_list_pages(array(
									'title_li' => NULL,
									'child_of' => get_the_ID(),
									'sort_column' => 'menu_order'
								));
                                ?>
                            </ul>
                            <?php
                        }
                    ?>
                    
                </div>
                
            </div>
        </section>
        <?php
    }
?>
        
<?php get_footer(); ?>