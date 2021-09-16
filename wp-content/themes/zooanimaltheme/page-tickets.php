<?php 
    get_header(); 
    while(have_posts()){
        the_post();
        pageBanner(array(
            'subtitle'=>'Your booking events',
            'photo'=>'https://worm.org/wp-content/uploads/2016/04/tickets_worm-690x460.jpg'
        ));

        $today=date('Ymd');
        $ticketEvents = new WP_Query(array(
            'paged' => get_query_var('paged', 1),
            'post_type'=>'ticket',
            'meta_key'=>'event_date',
            'orderby'=>'meta_value',
            'order'=>'ASC',
            'meta_query'=> array(
                array(
                    'key'=>'event_date',
                    'compare'=>'>=',
                    'value'=>$today,
                    'type'=>'DATE'
                ),
                array(
                    'key'=>'ticket_status',
                    'compare'=>'<=',
                    'value'=>2
                ),
                array(
                    'key'=>'user_id',
                    'compare'=>'=',
                    'value'=>get_current_user_id()
                )
            )
        ));
        ?>
        <section>
            <div class="container">
                <div class="page-content">

                <div class="ticketSection">
                <?php
                while($ticketEvents->have_posts()){
                    $ticketEvents->the_post();
                    $eventDate=new DateTime(get_field('event_date'));
                    ?>
                    <div class="ticketPart">
                        <h3><?php echo get_the_title(get_field('event_id'));?></h3>
                        <p>Conducted on : <strong style="color:red"><?php echo $eventDate->format('F j, Y');?></strong></p>
                        <P>Book Ticket for <?php if(get_field('adult_ticket_order')){
                            echo '<strong>'.get_field('adult_ticket_order').'</strong> adults ';
                        } 
                        if(get_field('child_ticket_order')){
                            echo '<strong>'.get_field('child_ticket_order').'</strong> children';
                        }
                        ?><br />
                        Payment Status: Rp.<?php echo get_field('total_price');?> <strong style="color:#006400"><?php if(get_field('ticket_status')==1){
                            echo 'Booking';
                            echo '<br /><a class="btn btn-cancel book-cancel" data-ticketid="'.get_the_ID().'">Cancel Booking</a>';
                        }else if(get_field('ticket_status')==2){
                            echo 'Have Been Paid';
                        }?>
                        </strong></p>
                        
                    </div>
                    <?php
                }
                echo '</div>';

                echo paginate_links();
                ?>
                    
                    
                </div>
                
            </div>
        </section>
        <?php
    }
?>
        
<?php get_footer(); ?>