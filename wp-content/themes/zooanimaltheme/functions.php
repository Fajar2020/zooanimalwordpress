<?php

//add some rest api adjustment for search result
require get_theme_file_path('/inc/search-route.php');
require get_theme_file_path('/inc/booking-route.php');

function pageBanner($args=NULL){
    if(!$args['title']){
        $args['title'] = get_the_title();
    }

    if(!$args['subtitle']){
        $args['subtitle']=get_field('page_banner_subtitle');
    }

    if(!$args['photo']){
        if(get_field('page_background_image')){
            $args['photo']=get_field('page_background_image')['url'];
        }else if(get_field('image_thumbnail')['url']){
            $args['photo']=get_field('image_thumbnail')['url'];
        }else{
            $args['photo']=get_theme_file_uri('/images/boy.jpg');
        }
    }
    ?>
        <section class="page-image" style="background: linear-gradient(to bottom, rgba(0,0,0,0.8),rgba(0,0,0,0.8)), url(<?php echo $args['photo'];?>) center no-repeat; background-size: cover; background-position:center">
            <div class="page-text">
                <h1><?php echo $args['title']; ?></h1>
                <p><?php echo $args['subtitle']; ?></p>
            </div>
        </section>
    <?php
}


function zoo_files() {
    wp_enqueue_script('menu-open-close-js', get_theme_file_uri('/js/menu_open_close.js'), NULL, '1.0', true);
    // wp_enqueue_script('jquery');
    
    if(is_page(77)){
        wp_enqueue_script('search-js', get_theme_file_uri('/js/search.js'), array('jquery'), microtime(), true);
    }

    if ( (is_single() AND 'event' == get_post_type()) || is_page(107)){
        wp_enqueue_script('booking-js', get_theme_file_uri('/js/booking.js'), array('jquery'), microtime(), true);

    }

    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('zoo_main_styles', get_stylesheet_uri(), false, microtime());
    wp_enqueue_style('page_styles', get_theme_file_uri('/css/page.css'), false, microtime());
    wp_enqueue_style('event_styles', get_theme_file_uri('/css/event.css'), false, microtime());
    wp_enqueue_style('captivity_styles', get_theme_file_uri('/css/captivity.css'), false, microtime());
    wp_enqueue_style('animal_styles', get_theme_file_uri('/css/animal.css'), false, microtime());
    wp_enqueue_style('search_styles', get_theme_file_uri('/css/search.css'), false, microtime());
    wp_enqueue_style('booking_styles', get_theme_file_uri('/css/booking.css'), false, microtime());


    wp_enqueue_script('zoo-info-js', get_theme_file_uri('/js/test.js'), NULL, '1.0', true);
    wp_localize_script('zoo-info-js', 'zooData', array(
        'root_url'=>get_site_url(),
        'nonce'=> wp_create_nonce('wp_rest')
    ));
}

add_action('wp_enqueue_scripts', 'zoo_files');

function zoo_features(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'zoo_features');

function zooanimal_adjust_queries($query){
    if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()){
        $today=date('Ymd');
        // $query->set('posts_per_page', 1);
        $query->set('meta_key','event_date');
        $query->set('orderby','meta_value');
        $query->set('order','ASC');
        $query->set('meta_query',array(
            array(
                'key'=>'event_date',
                'compare'=>'>=',
                'value'=>$today,
                'type'=>'DATE'
            )
        ));
        
    }

    // if ( is_single() AND 'captivity' == get_post_type() AND $query->is_main_query()) {
    //     $query->set('posts_per_page', -1);
    //     $query->set('orderby','title');
    //     $query->set('order','ASC');
    //     $query->set('meta_query',array(
    //         array(
    //             'key'=>'animal_related_to',
    //             'compare'=>'LIKE',
    //             'value'=>'"'.get_the_ID().'"'
    //         )
    //     ));
        
    // }

}
add_action('pre_get_posts','zooanimal_adjust_queries');

add_filter('login_headerurl','ourHeaderUrl');
function ourHeaderUrl(){
    return esc_url(site_url('/'));
}

function my_login_title() { return get_option('blogname'); }
add_filter('login_headertitle', 'my_login_title');

// function admin_remove_logo() {
// 	global $wp_admin_bar;
// 	$wp_admin_bar->remove_menu( 'wp-logo' );
// }
// add_action( 'wp_before_admin_bar_render', 'admin_remove_logo', 0 );

add_action('login_head', 'change_my_login_page');

function change_my_login_page(){
    echo '
    <style>
        body{
            background: linear-gradient(to bottom, rgba(0,0,0,0.8),rgba(0,0,0,0.8)), url('.get_theme_file_uri('/images/boy.jpg').') center no-repeat;
            background-size: cover;
            
        }

        .wp-core-ui .button, .wp-core-ui .button-secondary{
            color: #006400;
        }

        .login #backtoblog a, .login #nav a {
            color: #fff;
        }

        .login #backtoblog a:hover, .login #nav a:hover{
            color: #006400;
        }

        .wp-core-ui .button-primary {
            background: #006400;
            border-color: #006400;
            color: #fff;
            text-decoration: none;
            text-shadow: none;
        }

        .wp-core-ui .button-primary:hover {
            background: #008000;
            border-color: #008000;
        }

        .login #login_error, .login .message, .login .success {
            border-left: 4px solid #006400;
            padding: 12px;
            margin-left: 0;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }

        .login form .input,.login input[type=text],.login form input[type=checkbox] {
            background: #fff;
            border: 1px solid #006400;
            padding: 5px;
        }

        .login form .input:hover,.login form .input:focus,.login input[type=text]:hover,.login input[type=text]:focus,.login form input[type=checkbox]:hover,.login form input[type=checkbox]:focus {
            background: #fff;
            outline: none;
        }

        body.login div#login form#loginform p.submit input#wp-submit {
            border-radius: 0;
            background: #006400;
            outline: none;
            border: none;
            padding: 0 25px;
            text-align: center;
            font-size: 13px;
        }
        

        .login h1 a {
            background-image: url('.get_theme_file_uri('/images/logo.png').');
            background-size: 200px;
            background-position: center top;
            background-repeat: no-repeat;
            color: #444;
            font-size: 20px;
            font-weight: 400;
            line-height: 1.3;
            margin: 0 auto;
            padding: 0;
            text-decoration: none;
            width: 200px;
            text-indent: -9999px;
            outline: 0;
            display: block;
        }

        .login label {
            font-size: 17px;
            line-height: 1.5;
            display: inline-block;
            margin-bottom: 3px;
        }

        .wp-core-ui .button-primary {
            background: #006400;
            border-color: #006400;
            color: #fff;
            text-decoration: none;
            text-shadow: none;
        }
    </style>
    ';

}

//Redirect subscriber accounts out of admin and unto homepage
add_action('admin_init','redirectSubsToFrontend');

function redirectSubsToFrontend(){
    $ourCurrentUser = wp_get_current_user();
    if(count($ourCurrentUser->roles)==1 AND $ourCurrentUser->roles[0]=='subscriber'){
        wp_redirect(site_url('/'));
        exit;
    }
}

add_action('wp_loaded','noSubsAdminBar');

function noSubsAdminBar(){
    $ourCurrentUser = wp_get_current_user();
    if(count($ourCurrentUser->roles)==1 AND $ourCurrentUser->roles[0]=='subscriber'){
        show_admin_bar(false);
    }
}
