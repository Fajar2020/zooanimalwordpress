<?php

add_action('rest_api_init', 'zooTicketRoutes');

function zooTicketRoutes(){
    register_rest_route('zooanimal/v1', 'manageTicket', array(
        'methods'=>'POST',
        'callback'=>'createTicket'
    ));

    register_rest_route('zooanimal/v1', 'manageTicket', array(
        'methods'=>'PUT',
        'callback'=>'updateTicket'
    ));
}

//ticket_status Code:
// 1=order
// 2=pay
// 3=cancel

function createTicket($data){
    if(is_user_logged_in()){
        $eventID= sanitize_text_field($data['eventID']);
        $adultTicket = sanitize_text_field($data['adultTicket']);
        $childTicket = sanitize_text_field($data['childTicket']);
        $totTicket=$adultTicket+$childTicket;

        if(get_post_type($eventID) == 'event'){
            //check the ticket available;
            $postTickets = new WP_Query(array(
                'post_type'=>'ticket',
                'posts_per_page'=> -1,
                'meta_query' => array(
                    array(
                        'key'=>'event_id',
                        'compare'=>'=',
                        'value'=>$eventID
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

            $eventPost = get_post($eventID);
            $my_posts = new WP_Query( array(
                'p'         => $eventID, // ID of a page, post, or custom type
                'post_type' => 'event'
            ));
    
            while($my_posts->have_posts()){
                $my_posts->the_post();

                if((get_field('seat_number')-$sumBoughtTicket)<($adultTicket+$childTicket)){
                    return 0;
                }else{
                    $totalPrice = $adultTicket*get_field('price_for_adult')+$childTicket*get_field('child_ticket_price');
                    return wp_insert_post(array(
                        'post_type'=>'ticket',
                        'post_status'=>'publish',
                        'meta_input'=> array(
                            'event_id'=>$eventID,
                            'adult_ticket_order'=>$adultTicket,
                            'child_ticket_order'=>$childTicket,
                            'total_price'=>$totalPrice,
                            'ticket_status'=>1,
                            'total_tickets'=>$totTicket,
                            'user_id'=>get_current_user_id(),
                            'event_date'=>get_field('event_date')
                        )
                    ));
                }
                
            }
        }else{
            die('invalid event');
        }
    }else{
        die('not login');
    }
}

function updateTicket($data){
    if(is_user_logged_in()){
        $ticketID=sanitize_text_field($data['ticketID']);
        if(get_post_type($ticketID) == 'ticket'){
            $my_post = array(
                'ID'=> $ticketID,
                'meta_input'=> array(
                    'ticket_status'=>3
                )
            );

            return wp_update_post($my_post);
        }else{
            die('no ticket exists');
        }
    }else{
        die('not login');
    }
}