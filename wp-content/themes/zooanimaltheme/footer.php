<?php

    $footerCaptivities = new WP_Query(array(
        'post_type'=>'captivity',
    ));

?>

<footer>
            <div class="inner-footer">
                <div class="footer-items">
                    <img src="<?php echo get_theme_file_uri('/images/logo.png');?>" alt="logo"/>
                </div>
                <div class="footer-items">
                    <a href="<?php echo site_url('/captivities')?>"><h2>Captivities</h2></a>
                    <div class="border"></div>
                    <ul>
                        <?php 
                        while($footerCaptivities->have_posts()){
                            $footerCaptivities->the_post();
                            ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </ul>
                </div>
                <div class="footer-items">
                    <h2>Contact Us</h2>
                    <div class="border"></div>
                    <ul>
                        <li>
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            Jl. Kuncen somewhere in East Java
                        </li>
                        <li>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            0351 365980
                        </li>
                        <li>
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            info@zoofuntastic.com
                        </li>
                    </ul>
                    <div class="social-media">
                        <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-youtube" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                Copyright &copy; Funtastic Zoo 2020. All rights reserved.
            </div>
        </footer>
        <?php wp_footer();?>
    </body>
</html>