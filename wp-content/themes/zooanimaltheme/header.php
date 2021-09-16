<!doctype html>

<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <header>
            <div class="container">
                <nav>
                    <div class="menu-icons">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </div>
                    <a href="<?php echo site_url();?>" class="logo">
                        <img src="<?php echo get_theme_file_uri('/images/logo.png');?>" alt="logo"/>
                    </a>
                    <ul class="nav-list">
                        <li <?php if(get_post_type()=='event') echo 'class="current-menu-item"';?>> <a href="<?php echo site_url('/events') ?>">Events</a></li>
                        <li <?php if(get_post_type()=='captivity') echo 'class="current-menu-item"';?>> 
                            <a href="<?php echo site_url('/captivities')?>">Captivities</a>
                        </li>
                        <li>
                            <a>
                                <div <?php if(is_page('about-us') or is_page('vission-and-mission') or is_page('our-history') or is_page('teams')) echo 'class="current-menu-item"'?>>
                                    Our Zoo<i class="fa fa-angle-down" aria-hidden="true"></i>
                                </div>
                            </a>
                            <ul class="sub-menu">
                                <li <?php if(is_page('about-us')) echo 'class="current-menu-item"';?>>
                                    <a href="<?php echo site_url('/about-us');?>">About Us</a>
                                </li>
                                <li <?php if(is_page('teams')) echo 'class="current-menu-item"';?>> 
                                    <a href="<?php echo site_url('/teams');?>">Teams</a>
                                </li>
                                <li <?php if(is_page('vission-and-mission')) echo 'class="current-menu-item"'?>>
                                    <a href="<?php echo site_url('/vission-and-mission');?>">Vission and Mission</a>
                                </li>
                                <li <?php if(is_page('our-history')) echo 'class="current-menu-item"'?>>
                                    <a href="<?php echo site_url('/our-history');?>">Our History</a>
                                </li>
                            </ul>
                        </li>
                        <li <?php if(get_post_type()=='post') echo 'class="current-menu-item"'?>>
                            <a href="<?php echo site_url('/blog')?>">Blog</a>
                        </li>
                        <?php
                            if(is_user_logged_in()){
                                ?>
                                <li <?php if(is_page('tickets')) echo 'class="current-menu-item"'?>>
                                    <a href="<?php echo site_url('/tickets')?>">Tickets</a>
                                </li>
                                <?php
                            }
                        ?>
                        <ul style="margin: auto 0 auto auto;">
                            
                            <li class="move-right btn-i">
                                <a href="<?php echo site_url('/search');?>"><i class="fa fa-search" aria-hidden="true"></i></a>
                            </li>
                            <?php 
                                if(is_user_logged_in()){
                                    ?>
                                    <li class="move-right btn">
                                        <a href="<?php echo wp_logout_url(); ?>?>">Log Out</a>
                                    </li>
                                    <?php
                                }else{
                                    ?>
                                    <li class="move-right btn">
                                        <a href="<?php echo wp_login_url(); ?>">Log In</a>
                                    </li>
                                    <?php
                                }
                            ?>
                        </ul>
                        
                    </ul>
                </nav>
            </div>
        </header>