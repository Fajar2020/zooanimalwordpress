<?php 
    get_header(); 
    pageBanner(array(
        'title'=>'CAPTIVITIES',
        'subtitle'=>'We group our animal based on their types...',
        'photo'=>'https://bandung.pojoksatu.id/wp-content/uploads/2019/12/IMG-20191223-WA0054-730x355.jpg'
    ));
        ?>
        <section>
            <div class="container">
                <div class="page-content">
                    <ul>
                    <?php
                        while(have_posts()){
                            the_post();
                            ?>
                            <li>
                                <a class="captive-h3" href="<?php the_permalink();?>"><?php the_title();?></a>
                            </li>

                            <?php
                        }
                    ?>
                    </ul>
                </div>
                <?php echo paginate_links();?>
            </div>
        </section>
<?php get_footer(); ?>