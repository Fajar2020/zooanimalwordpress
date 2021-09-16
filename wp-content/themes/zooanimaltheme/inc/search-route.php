<?php

add_action('rest_api_init', 'zooRegisterSearch');

function zooRegisterSearch(){
    register_rest_route('zooanimal/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback'=>'zooAnimalSearchResults'
    ));
}

function zooAnimalSearchResults($data){
    $searchData = new WP_Query(array(
        'post_type'=> array('post', 'page', 'captivity', 'animal', 'event'),
        's'=>sanitize_text_field($data['term'])
    ));

    $searchResult = array(
        'page'=> array(),
        'post'=>array(),
        'captivity'=> array(),
        'animal'=> array(),
        'event'=> array()
    );

    while($searchData->have_posts()){
        $searchData->the_post();

        if(get_post_type()=='page'){
            array_push($searchResult['page'], array(
                'title'=>get_the_title(),
                'permalink'=>get_the_permalink()
            ));
        }

        if(get_post_type()=='post'){
            array_push($searchResult['post'], array(
                'title'=>get_the_title(),
                'permalink'=>get_the_permalink(),
                'thumbnail'=>get_the_post_thumbnail_url()
            ));
        }

        if(get_post_type()=='captivity'){
            array_push($searchResult['captivity'], array(
                'title'=>get_the_title(),
                'permalink'=>get_the_permalink(),
                'id'=>get_the_id()
            ));
        }

        if(get_post_type()=='animal'){
            array_push($searchResult['animal'], array(
                'title'=>get_the_title(),
                'permalink'=>get_the_permalink(),
                'thumbnail'=>get_field('image_thumbnail')['url']
            ));
        }

        if(get_post_type()=='event'){
            $description;
            if(has_excerpt()){
                $description= get_the_excerpt();
            }else{
                $description=wp_trim_words(get_the_content(), 15);
            }
            $eventDate=new DateTime(get_field('event_date'));
            array_push($searchResult['event'], array(
                'title'=>get_the_title(),
                'permalink'=>get_the_permalink(),
                'month'=>$eventDate->format('M'),
                'day'=>$eventDate->format('d'),
                'description'=>$description
            ));

        }
    }

    // //Find all animal inside captivity
    if($searchResult['captivity']){
        $captivityMetaQuery = array('relation'=>'OR');

        foreach($searchResult['captivity'] as $item){
            array_push($captivityMetaQuery, array(
                'key'=>'animal_related_to',
                'compare'=>'LIKE',
                'value'=>'"'.$item['id'].'"'
            ));
        }

        $captivityRelationshipQuery = new WP_Query(array(
            'post_type'=> 'animal',
            'meta_query'=> $captivityMetaQuery
        ));

        while($captivityRelationshipQuery->have_posts()){
            $captivityRelationshipQuery->the_post();

            array_push($searchResult['animal'], array(
                'title'=>get_the_title(),
                'permalink'=>get_the_permalink(),
                'thumbnail'=>get_field('image_thumbnail')['url']
            ));
            
        }

        $searchResult['animal']=array_values(array_unique($searchResult['animal'],SORT_REGULAR));
    }
    return $searchResult;
}