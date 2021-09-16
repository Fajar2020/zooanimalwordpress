<?php 
    get_header(); 
    //check the ticket available;
    $postTickets = new WP_Query(array(
        'post_type'=>'ticket',
        'posts_per_page'=> -1,
        'meta_query' => array(
            array(
                'key'=>'event_id',
                'compare'=>'=',
                'value'=>get_the_ID()
            ),
            array(
                'key'=>'ticket_status',
                'compare'=>'=',
                'value'=>2
            )
        )
    ));

    $sumBoughtTicket=0;
    while($postTickets->have_posts()){
        $postTickets->the_post();
        $sumBoughtTicket=$sumBoughtTicket+get_field('total_tickets');
    }

    wp_reset_postdata();

    while(have_posts()){
        the_post();
        pageBanner();
        $eventDate=new DateTime(get_field('event_date'));
        ?>
        <section>
            <div class="container">
                <div class="page-content">
                    <a class="page-container-a">Come and join our event on <strong><?php echo $eventDate->format('F j, Y')?></strong></a>
                    <div style="text-align:center">
                        <img src="<?php echo get_field('image_thumbnail')['url']; ?>" class="img-responsive" />
                    </div>
                    <p><?php the_content(); ?></p>
                    <br />
                    <p>Available Seat :
                    <?php
                    if(get_field('seat_number')){
                        echo ' '.(get_field('seat_number')-$sumBoughtTicket);
                    }else{
                        echo ' '.get_field('any_seat_number');
                    }
                    echo '</p>';

                    // setlocale (LC_MONETARY, 'id_ID');
                    
                    if(get_field('child_ticket_price') && get_field('price_for_adult')){
                        echo '<p>
                        Ticket price for adult : <strong>'.get_field('price_for_adult').'</strong><br />
                        Ticket price for children below 5 years old: <strong>'.get_field('child_ticket_price').'</strong>
                        </p>';
                    }else if(get_field('child_ticket_price') || get_field('price_for_adult')){
                        echo '<p>Ticket price for adults and children: <strong>';
                        if(get_field('child_ticket_price')){
                            echo get_field('child_ticket_price');
                        }else{
                            echo get_field('price_for_adult');
                        }
                        echo '</strong></p>';
                    }else{
                        echo '<p>Ticket price: <strong>'.get_field('free_ticket').'</strong></p>';

                    }

                    if(is_user_logged_in()){
                        if(get_field('child_ticket_price') || get_field('price_for_adult')){
                            ?>
                            <form>
                            <div class="input-ticket-div" data-eventid="<?php the_ID();?>" data-adult="<?php echo get_field('price_for_adult');?>" data-child="<?php echo get_field('child_ticket_price');?>">
                                <input type="number" class="input-ticket adult-ticket" pattern="[0-9]"  oninput="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="How many tickets for adults?"/>
                                <input type="number" class="input-ticket child-ticket" pattern="[0-9]"  oninput="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="How many tickets for children?"/>
                                <a class="btn btn-booking check-price" >Check price</a>    
                            </div>
                            </form>
                            <p>Total Price: <span class="price-place"></span></p>
                            <a class="btn btn-booking book-ticket" >Booking</a>
                            <p class="bookingResult"></p>
                            <?php
                        }
                    }else{
                        ?>
                        <a href="<?php echo wp_login_url(); ?>" class="btn btn-booking" >Please Login first for booking</a>
                        
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