<?php

/* from https://stackoverflow.com/questions/3464701/export-list-of-pretty-permalinks-and-post-title */



include "wp-load.php";

$posts = new WP_Query('post_type=any&posts_per_page=-1&post_status=publish');
$posts = $posts->posts;
/*
global $wpdb;
$posts = $wpdb->get_results("
    SELECT ID,post_type,post_title
    FROM {$wpdb->posts}
    WHERE post_status<>'auto-draft' AND post_type NOT IN ('revision','nav_menu_item')
");
*/

header('Content-type:text/plain');
echo "date,lengthofcontent,permalink\n";
foreach($posts as $post) {
    $dateofpost = get_the_date('Y-m-d', $post->ID);
    $textcontent = $post->post_content;
    // print_r($textcontent);
    $lengthofcontent = str_word_count($textcontent);
    switch ($post->post_type) {
        case 'revision':
        case 'nav_menu_item':
            break;
        case 'page':
            $permalink = get_page_link($post->ID);
            break;
        case 'post':
            $permalink = get_permalink($post->ID);
            break;
        case 'attachment':
            $permalink = get_attachment_link($post->ID);
            break;
        default:
            $permalink = get_post_permalink($post->ID);
            break;
    }
    /*echo "\n{$post->post_type}\t{$permalink}\t{$post->post_title}";*/
    echo "{$dateofpost},{$lengthofcontent},{$permalink}\n";
}